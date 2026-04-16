# Shapehugs

Shapehugs is a PHP and MySQL clothing storefront with a responsive public site, animated UI interactions, customer auth, cart persistence, checkout submission, and JSON API endpoints for the catalog and order flow.

## What is included

- Responsive storefront pages for the homepage, collection pages, product detail, cart, and checkout
- Animated navigation, hero carousel, search overlay, cart drawer, quick view modal, and confirmation page
- MySQL-backed APIs for products, categories, authentication, newsletter signups, contact forms, and orders
- A schema file for creating the database tables used by the site

## Setup

1. Import the schema from [database/schema.sql](database/schema.sql) into your MySQL database.
2. Update [db_config.php](db_config.php) if your database name, username, or password differ.
3. Open [index.php](index.php) through a local PHP server.

## API endpoints

- `api/products.php` - list or fetch products, and create products when the products table is available
- `api/categories.php` - return category data with product counts
- `api/content.php` - return hero slides, benefits, and collections
- `api/auth/register.php` - register a customer account
- `api/auth/login.php` - authenticate a customer account
- `api/newsletter.php` - subscribe an email address
- `api/contact.php` - save a contact request
- `api/orders.php` - create an order from the checkout flow

## Notes

- The storefront JS falls back to seeded demo data if the catalog tables are not available yet.
- Cart state is stored in localStorage so the drawer, cart page, and checkout stay in sync.
