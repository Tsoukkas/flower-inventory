# Flower Inventory Management System (Laravel + SQL Server)

This repository contains a Flower Inventory Management System developed using PHP (Laravel framework) and SQL Server. The application allows users to manage flowers and categories through full CRUD functionality and includes search and sorting features. The solution follows the requirements described in the Flower Inventory Assessment. :contentReference[oaicite:0]{index=0}

Repository URL (clone from here):
https://github.com/Tsoukkas/flower-inventory.git


## What this project implements (Assessment Requirements Coverage)

This project is implemented to satisfy the following requirements:

Database Component:
A SQL Server database is designed and implemented for a flower shop. Two entities are created: Category and Flower, with essential properties such as name, type, price, stock, etc. A one-to-many relationship is implemented between Category and Flower (one category can have many flowers). The database is seeded with sample data (at least 2 categories and 4 flowers). Additionally, SQL scripts for database re-creation are included in this repository under `database/sql/`.

Back-End Component:
A Service Layer is implemented to handle CRUD operations. Service classes exist for flower and category operations, including methods for retrieving, adding, updating, and deleting flowers. Proper exception handling is implemented in the service layer and failures are logged. At least one unit test is included for service methods. A design pattern/architecture choice is applied using Service Layer + Interfaces + Dependency Injection bindings registered in the AppServiceProvider.

Front-End Component:
The UI is implemented using Blade templates and includes the required pages: Home page, Details page, Add/Edit page, and Delete confirmation page. Search and sort features are implemented on the Home page. Optional bonus features such as image upload, pagination, and logging are implemented.

Submission Guideline Requirements:
The code is hosted in this GitHub repository and includes SQL scripts for database re-creation. This README provides setup instructions, a description of the implementation, challenges faced, assumptions made, and technologies used. The repository is expected to build and run without errors when configured correctly. :contentReference[oaicite:1]{index=1}


## Technologies Used

PHP 8.0
Laravel (Framework)
SQL Server (Express)
Eloquent ORM
Blade Templates
PHPUnit (Unit Testing)


## Database Design

The system consists of two main entities:

Category:
Fields: id, name, description (nullable), created_at, updated_at

Flower:
Fields: id, category_id (FK), name, type (nullable), price, stock, image_path (nullable), created_at, updated_at

Relationship:
Category hasMany Flowers
Flower belongsTo Category
A foreign key constraint enforces the one-to-many relationship in SQL Server.


## SQL Scripts for Database Re-Creation

In addition to Laravel migrations, SQL scripts are included for database re-creation as required:

`database/sql/01_create_schema.sql`  
Creates the database and tables (schema + constraints)

`database/sql/02_seed_data.sql`  
Inserts sample data (at least 2 categories and 4 flowers)

These scripts can be executed in SQL Server Management Studio (SSMS) in the order shown above.


## Full Setup Instructions (Clone + Install + Configure + Run)

The steps below allow a reviewer to clone the project to a new computer and run it successfully.

Prerequisites:
- PHP 8.0 installed and available in PATH
- Composer installed
- SQL Server installed (SQL Server Express is fine)
- Microsoft ODBC Driver 17 or 18 for SQL Server installed
- Git installed

Optional but recommended:
- SQL Server Management Studio (SSMS) to view/run SQL scripts

Step A: Clone the repository
Open a terminal (PowerShell / CMD) and run:

git clone https://github.com/Tsoukkas/flower-inventory.git
cd flower-inventory

Step B: Install PHP dependencies
Run:

composer install

Step C: Create environment file
Copy `.env.example` to `.env` (in Windows you can do it manually or with a command):

copy .env.example .env

Step D: Configure SQL Server connection in `.env`
Open `.env` and set the following values. For a local SQL Server Express instance, this typical configuration works:

DB_CONNECTION=sqlsrv
DB_HOST=127.0.0.1\SQLEXPRESS
DB_DATABASE=FlowerInventory
DB_USERNAME=your_sql_username
DB_PASSWORD=your_sql_password
DB_TRUST_SERVER_CERTIFICATE=true

Notes:
- The DB_HOST format for SQL Server Express is usually `127.0.0.1\SQLEXPRESS` (instance-based connection).
- If SQL Server uses a different instance name or host, update DB_HOST accordingly.
- Ensure your SQL login exists and has permission to create tables and insert data.

Step E: Generate application key
Run:

php artisan key:generate

Step F: Create database schema and seed data (recommended method)
Use Laravel migrations and seeders:

php artisan migrate
php artisan db:seed

Alternative method (manual via SQL scripts):
If you prefer to recreate the database using SQL scripts, run these in SSMS (in order):
- database/sql/01_create_schema.sql
- database/sql/02_seed_data.sql

Step G: Create the storage symlink for uploaded images (required if using image upload)
Run:

php artisan storage:link

Step H: Run the application
Start the Laravel development server:

php artisan serve

Then open the application in your browser:
http://127.0.0.1:8000

If the app is running, you should be able to:
- See the Home page listing flowers
- Search and sort the list
- View Details for a flower
- Add, Edit, and Delete flowers (with delete confirmation page)
- Upload and display flower images (optional/bonus)


## Feature Details (What the reviewer should test)

Home Page:
Displays a paginated list of flowers. Supports searching by flower name/type and sorting by name/price/stock (ascending or descending).

Details Page:
Displays flower information including its category and optional uploaded image.

Add Page:
Allows creating a flower with category selection, name, type, price, stock, and optional image upload.

Edit Page:
Allows updating an existing flower (including replacing an uploaded image).

Delete Confirmation Page:
Prompts the user to confirm before deleting the flower record.


## Back-End Architecture (Service Layer + Design Pattern)

The project uses a Service Layer pattern:
- Controllers are kept thin and handle HTTP request/response only.
- Business logic and CRUD operations are implemented in services:
  - FlowerService
  - CategoryService

Interfaces are defined:
- FlowerServiceInterface
- CategoryServiceInterface

Bindings are registered in AppServiceProvider via dependency injection, improving testability and maintainability (design/architecture bonus).


## Exception Handling and Logging

Service methods include exception handling using try/catch blocks. When errors occur during create/update/delete operations, they are logged using Laravel’s logging system (storage/logs/laravel.log). This also satisfies the optional bonus logging functionality.


## Image Upload (Bonus Feature)

Image upload is implemented as an optional bonus feature.
Uploaded images are stored in:
storage/app/public/flowers

They are served via:
public/storage (symlink created by `php artisan storage:link`)

On update, old images are removed to prevent unused files.


## Pagination (Bonus Feature)

The Home page uses pagination to display a limited number of flowers per page (example: 10 per page). Pagination links are preserved across search/sort using query strings.


## Unit Testing

At least one unit test is included for a service method (FlowerService create operation). The test verifies that a flower can be created and stored in the database successfully.

Run the tests with:
php artisan test


## Assumptions Made

Authentication/authorization was not required by the assignment, so the application is publicly accessible.
Basic UI design was considered sufficient; no specific frontend framework was required.
Image upload is optional (bonus feature) and not required for core CRUD functionality.
Stock is treated as a non-negative integer.


## Challenges Faced

Configuring SQL Server connectivity with Laravel (ODBC driver and correct host/instance format).
Ensuring images display correctly (storage link required).
Maintaining clean architecture by separating concerns into a service layer.
Keeping database schema consistent between migrations and standalone SQL scripts.


## Verification Checklist (For Reviewer)

The project is correctly set up if:
- `php artisan migrate` runs without errors
- `php artisan db:seed` inserts sample data (2 categories and 4 flowers minimum)
- `php artisan serve` starts the application successfully
- Home page loads and shows flower list
- Search and sort work
- CRUD operations work (Create / Details / Edit / Delete with confirmation)
- Image upload works after `php artisan storage:link`
- `php artisan test` passes at least one unit test


## Author

Anton Tsoukkas
Flower Inventory Assessment