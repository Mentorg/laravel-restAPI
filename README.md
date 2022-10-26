
# Laravel REST API

This is a basic CRUD API made with the latest version of Laravel (9.x), a popular framework made on top of PHP. The project makes use of Service Layer-Repository Pattern in order to keep the code clean and organized, custom authentication, and authorization with the help of Spatie's permission package.

## Basic Usage

Follow the steps below in order to start using this application.

#### Create Database

`$ php artisan db:create`

#### Define database schema

`$ php artisan migrate`

#### Populate the database with data

`$php artisan db:seed`

#### Run the application

`php artisan serve`

#### Authentication credentials

Email: `admin@admin.com`\
Password: `password`

## Test Endpoints

Use the following endpoints in order to test the application.

#### Authentication

User Register: **POST** `localhost:8000/api/register`\
User Login: **POST** `localhost:8000/api/login`\
User Logout: **POST** `localhost:8000/api/login`

#### Authorization

List Roles: **GET** `localhost:8000/api/roles`\
Get Role:  **GET** `localhost:8000/api/roles/3`\
Add Role: **POST** `localhost:8000/api/roles`\
Update Role: **PUT** `localhost:8000/api/roles/3`\
Delete Role: **DELETE** `localhost:8000/api/roles/3`\
Search Keyword: **GET** `localhost:8000/api/roles?search=lorem`

#### Articles

List Articles: **GET** `localhost:8000/api/articles`\
Get Article:  **GET** `localhost:8000/api/articles/3`\
Add Article: **POST** `localhost:8000/api/articles`\
Update Article: **PUT** `localhost:8000/api/articles/3`\
Delete Article: **DELETE** `localhost:8000/api/articles/3`\
Search Keyword: **GET** `localhost:8000/api/articles?search=lorem`

#### Users

List Users: **GET** `localhost:8000/api/users`\
Get User:  **GET** `localhost:8000/api/users/3`\
Update User: **PUT** `localhost:8000/api/users/3`\
Delete User: **DELETE** `localhost:8000/api/users/3`\
Search Keyword: **GET** `localhost:8000/api/users?search=lorem`

**Node:** If you're using Postman to test this API, don't forget to add HTTP Header key "Accept" with the value "application/json".
