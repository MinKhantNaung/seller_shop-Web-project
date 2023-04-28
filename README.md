
# Seller Shop

This web app is for posting items with seller name, price, contact and location.


## Start

In DatabaseSeeder.php, I created admin account.


## Admin panel

Middleware --> acc with role 'admin' can go to admin panel. 
## Admin Features

- CRUD (categories)
- CRUD (items) - used jquery/leaflet mappicker, ckeditor
- checkbox (publish or unpublish) feature in items



## User Features

- show only 8 items and 6 categories.
- when click show more, it shows all items, categories
- user can find items by clicking category
- user can also find by search box and choosing category
- user can find by search filter (such as latest or popular, min or max, condition)
- user can also reset filter by clear filter button
- user can see item's details by click items
