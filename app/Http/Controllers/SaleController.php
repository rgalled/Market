<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Category;
use App\Models\Setting;
use App\Models\Image;
use App\Models\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class SaleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
        $this->middleware('auth')->only('purchase');
    }

    public function index()
    {
        $query = Sale::with(['category', 'images', 'purchases']);

        $sales = $query->latest()->get();
        $user = Auth::user();

        return view('sales.index', compact('sales', 'user'));
    }

    public function showUserSales($user)
    {

        $query = Sale::with(['category', 'images', 'purchases']);
        $sales = $query->where('user_id', Auth::id())->latest()->get();
        return view('sales.user', compact('sales'));
    }

    public function purchase($id)
    {
        $sale = Sale::findOrFail($id);

        if ($sale->isSold) {
            return back()->with('error', 'Already sold.');
        }

        if ($sale->user_id === Auth::id()) {
            return back()->with('error', 'You cannot purchase your own product.');
        }

        $sale->update(['isSold' => true]);

        Purchase::create([
            'sale_id' => $sale->id,
            'user_id' => Auth::id(),
            'purchase_date' => now()
        ]);

        return redirect()->route('sales.show', $sale->id)
            ->with('success', 'Product purchased successfully.');
    }

    public function create()
    {
        $categories = Category::all();
        return view('sales.create', compact('categories'));
    }


    public function shop(Request $request)
    {

        $sale = Sale::findOrFail($request->sale);

        if ($sale->isSold) {
            return redirect()->route('sales.index')->with('success', 'This product has already been sold.');
        }

        $sale->update([
            'isSold' => true
        ]);

        return redirect()->route('sales.index')->with('success', 'Product purchased successfully.');
    }

    public function store(Request $request)
    {
        $maxImages = Setting::where('name', 'maxImages')->value('maxImages') ?? 4;
        $request->validate([
            'product' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|gt:0',
            'category_id' => 'required|exists:categories,id',
            'images' => "array|max:$maxImages",
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $sale = Sale::create([
            'product' => $request->product,
            'description' => $request->description,
            'price' => $request->price,
            'category_id' => $request->category_id,
            'user_id' => Auth::id(),
            'isSold' => false,
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('images', 'public');
                Image::create([
                    'sale_id' => $sale->id,
                    'route' => $path,
                ]);
            }
        }

        return redirect()->route('sales.index')->with('success', 'Product created successfully.');
    }

    public function show($id)
    {
        $sale = Sale::with('category', 'user', 'images', 'purchases')->findOrFail($id);

        if (
            $sale->isSold &&
            Auth::id() != $sale->user_id &&
            !$sale->purchases->where('user_id', Auth::id())->count()
        ) {
            return redirect()->route('sales.index')
                ->with('error', 'Not available anymore.');
        }

        return view('sales.show', compact('sale'));
    }

    public function edit($id)
    {
        $sale = Sale::findOrFail($id);
        $categories = Category::all();
        return view('sales.edit', compact('sale', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $sale = Sale::findOrFail($id);
        $maxImages = Setting::where('name', 'maxImages')->value('maxImages') ?? 4;
        $request->validate([
            'product' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'images' => "array|max:$maxImages",
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'isSold' => 'boolean',
        ]);

        $sale->update([
            'product' => $request->product,
            'description' => $request->description,
            'price' => $request->price,
            'category_id' => $request->category_id,
            'isSold' => $request->isSold,
        ]);


        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('images', 'public');
                Image::create([
                    'sale_id' => $sale->id,
                    'route' => $path,
                ]);
            }
        }
       

        return redirect()->route('sales.index')->with('success', 'Product updated.');
    }

    public function destroy($id)
    {
        $sale = Sale::findOrFail($id);
        $sale->delete();
        return redirect()->route('sales.index')->with('success', 'Product deleted.');
    }
}
