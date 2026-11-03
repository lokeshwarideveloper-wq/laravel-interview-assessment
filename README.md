<<<<<<< HEAD
# Product Manager

A Laravel 12 product-management application with a public e-commerce storefront, session-based admin registration and login, a dashboard, searchable and filterable product CRUD, category and branch lookups, and publicly accessible product images stored on Laravel's public disk.

## Requirements

- PHP 8.2 or newer with the PDO MySQL and Fileinfo extensions
- Composer
- MySQL 8 or compatible
- Node.js and npm (only needed if you add or build frontend assets; this app uses Bootstrap 5 from a CDN)

## Installation

Run these commands from the project directory:

```powershell
cd C:\Users\Admin\product
composer install
```

Create the MySQL database:

```powershell
mysql -u root -p -e "CREATE DATABASE product_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
```

If your MySQL account uses a different username or password, update `DB_USERNAME` and `DB_PASSWORD` in `.env`. The project is configured for `127.0.0.1:3306` and the `product_db` database.

Generate the application key if `.env` does not already have one, run migrations and seed the category/branch dropdown values, create the public storage link, then start Laravel:

```powershell
php artisan key:generate
php artisan migrate --seed
php artisan storage:link
php artisan serve
```

Open [http://127.0.0.1:8000](http://127.0.0.1:8000) to browse the public storefront. Use **Admin login** to sign in and manage products. For an existing installation, `php artisan key:generate` is only needed if `APP_KEY` is empty.

The database seeder creates or updates a development account: `product@example.com` / `product@123`. Change this password immediately and do not use the demo account in production.

## Public product images

Images are validated as JPG, PNG, or WebP (up to 2 MB) and stored under `storage/app/public/products`. The `public/storage` link exposes them without authentication at URLs such as `http://127.0.0.1:8000/storage/products/example.jpg`. Set `APP_URL` to your public domain before deploying so generated image URLs use that domain.

## Features

- Register, sign in, remember-me, and sign out
- Auth-protected dashboard with product, category, and branch totals
- Product create, read, update, and delete
- Category and branch dropdowns, seeded with example records
- Search by product name or email; filter by category and branch
- Public storefront and product detail pages, accessible without login
- Click a product image to open its public full-size image in a new tab
- Paginated, responsive Bootstrap 5 product table and product detail
- Validated product images with direct, public storage URLs

Run the feature tests with:

```powershell
php artisan test
```
=======
# laravel-interview-assessment
Laravel Interview Task Submission
>>>>>>> a634b0727452434b6ad7789de73b93d896aa5fda
