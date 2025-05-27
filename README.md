# Project Title

Seller Shop

## Project Description

This mini project aims to provide a platform for users to discover items for sale. It facilitates the posting of items along with essential details such as seller name, price, and location.

## Admin Features

- Category Management:
  - can create, update and delete categories.
 
- Item Management:
  - can create, update and delete items.

## Frondend Features

1. **Responsive Design**: This mini project is fully responsive in all devices.
2. **User Authentication**: Account with role 'user' will go to Frondend.
3. **Items**: The frontend displays listing of available items, showcasing essential information such as item images, specifications, pricing, and availability. Users can easily browse and search for items based on their preferences and needs.


## Technologies Used 

- Laravel (9)
- jQuery 
- Ajax
- HTML/CSS
- Bootstrap 5
- Fontawesome/ Ckeditor 5
- jQuery leaflet map location picker

## Installation

- If cloning my project is complete or download is complete, open terminal in project directory.
- Install composer dependicies
  - **composer install** (command)
- Install npm dependicies
  - **npm install**
- Create a copy of .env file
  - **cp .env.example .env**
- Generate an app encryption key
  - **php artisan key:generate**
- Create an empty database for my web project
  - created database name must match from .env file
- Start npm 
  - **npm run build**
- link storage
  - **php artisan storage:link**
- Migrate
  - **php artisan migrate**
- Seed Database
  - **php artisan db:seed**
- Start 
  - **php artisan serve**
- type in url with port 
  - localhost:8000

## Usage

- In DatabaseSeeder.php, I created admin account.
- Login as admin,
  - Email - admin@gmail.com
  - Password - password



