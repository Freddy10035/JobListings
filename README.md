# LOCAL INSTALLATION

1. Clone the repository to your local machine
2. Make sure you have <b>PHP</b>, <b>composer</b>, and <b>npm</b> installed
3. Run `composer install` to install the required dependencies
4. Rename the `.env.example` file to `.env` and update the database and email settings
5. Run `php artisan key:generate` to generate an app encryption key
6. Run `php artisan migrate` to create the database tables
7. Run `php artisan storage:link` to create a symbolic link for file storage
8. Run `npm install to install` the front-end dependencies
9. Run `npm run dev` to compile the front-end assets
10. Run `php artisan serve` to start the local development server
11. Access the website by navigating to `http://localhost:8000` (assuming your server is running on your local machine)

## Dependencies
+ PHP
+ Composer
+ npm
+ MySQL
+ Laravel framework

## Features
1. Job Listing and Search
2. Job Application
3. Employer job posting and management
4. Admin review, approve and reject job listings as well as applicant details.

# DEPLOYING TO AZURE WEB APP + DATABASE
1. Edit the `database.php` file to include the following:
```php
'mysql' => [
    ...
    'sslmode' => env('DB_SSLMODE', 'prefer'),
    'options' => (env('MYSQL_SSL') && extension_loaded('pdo_mysql')) ? [
        PDO::MYSQL_ATTR_SSL_KEY    => '/ssl/DigiCertGlobalRootCA.crt.pem',
    ] : []
],
```
This enables SSL encryption for the database connection.

2. Create a new web app and a MySQL database in Azure.

3. Link your Laravel project repository with Azure. This will allow you to deploy your code directly to Azure whenever there is a new push to your repository.

4. Azure will automatically generate workflows for your project, which you can customize if needed.

5. SSH into your site folders.

6. Copy the `.env.example` file to a new file called `.env`:
```
cp .env.example .env
```

7. Edit the `.env` file to match the database information in Azure.

8. Set the `APP_ENV` and `APP_DEBUG` variables to `production` and `true`, respectively:
```
APP_ENV=production
APP_DEBUG=true
```

9. Run the following command to run the database migrations on your Azure database:
```
php artisan migrate --env=production --force
```

10. Generate a new key for your application:
```
php artisan key:generate --env=production --force
```

11. Run the following command to create a link for the images:
```
php artisan storage:install
```

12. You can now view your site by visiting the domain provided by Azure.

Note: Before running the above commands, make sure you have installed all the necessary dependencies and packages required to run a Laravel project on Azure.
    
# USING NGINX
Seek more information on how you would configure the application to run on nginx server. 
Contact for more info.
