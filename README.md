
# SecondHandApp

SecondHandApp is an application for buying and selling second-hand products. Users can create listings to sell items, edit their posts, and remove them when no longer available. They can also browse and purchase products from other users easily and securely.

## Installation  

To get the application up and running, clone the repository with the following command:

```bash
git clone git@github.com:Danielfo684/secondHandApp.git
```

You will need to have **Composer** and **Laravel** installed beforehand.  

## Configuration  

Edit the `.env` file with the following changes:  

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_db_name
DB_USERNAME=your_user
DB_PASSWORD=your_password

MAIL_MAILER=log
MAIL_HOST=127.0.0.1
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"
```

Use an email of your preference.  

## Final Steps  

Generate the application key and migrate the tables with the following commands:  

```bash
php artisan key:generate
php artisan migrate
```

## Project Features  
Create, edit, and delete second-hand product listings


# More info available on the following portfolio:
https://danielfo684.github.io/Portfolio/


# Code and UI:

## Screenshots

### Main Ad
![User List](/documentation/1.png)

### Edit publication
![User Creation](/documentation/2.png)

### More info section
![User Editing](/documentation/3.png)

### Different options for each product
![Admin Panel](/documentation/4.png)

