<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# Contact CRUD Application

A simple Contact Management system built with Laravel for the backend and HTML, CSS, Bootstrap, and jQuery for the frontend. This project enables users to Create, Read, Update, and Delete contacts efficiently with a clean and responsive UI.

---

## Features

- Add new contacts with name, email, phone, message and image
- View a paginated list of all contacts
- Edit existing contact details with validation
- Delete contacts
- Responsive UI using Bootstrap 5
- Client-side interactivity and form validation with jQuery
- Server-side validation and CRUD operations powered by Laravel

---

## Tech Stack

- Backend: PHP 8+, Laravel Framework
- Frontend: HTML5, CSS3, Bootstrap, jQuery
- Database: MySQL (configured via Laravel migrations)
- Server: Apache/Nginx (local development via Laravel Artisan server)

---

## Installation & Setup


1. **Clone the repo:**

```bash
git clone https://github.com/shubhupawar/gadget.git
cd gadget
```

2. **Install PHP dependencies:**

```bash
composer install
```

3. **Copy environment configuration:**

```bash
cp .env.example .env
```

4. **Update the .env file with your database credentials.**

5. **Generate the application key:**

```bash
php artisan key:generate
```

6. **Run database migrations:**

```bash
php artisan migrate
```

7. **Publish Sanctum configuration and migrate:**

```bash
php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"
php artisan migrate
```

8. **Start the Laravel development server:**

```bash
php artisan serve
```

9. **(Optional) Import Postman collection for API testing:**

`extras/Gadget.postman_collection.json`

10. **(Optional) Import sample database for pre-filled data:**

`extras/gadget.sql`

---

## API Authentication

This project uses **Laravel Sanctum** to secure API endpoints and provide token-based authentication for users.

- Sanctum issues API tokens that can be used to authenticate requests from frontend or third-party clients.
- Users can log in and receive a personal access token, which must be included in the `Authorization` header as a Bearer token for protected API routes.
- This ensures that only authenticated users can perform CRUD operations via API.
- Sanctum also supports SPA authentication out of the box using Laravel’s built-in session cookies.

### How it works in this project

- Login endpoints issue Sanctum tokens upon successful authentication.
- API routes in `routes/api.php` are protected with the `auth:sanctum` middleware.
- Frontend requests made with jQuery or any HTTP client must include the token for authentication.
- Token management (issuing, revoking) is handled through Laravel controllers.

---

## System Environment

- OS: Windows
- Server: WAMP
- Apache Version: 2.4.59
- PHP Version: 8.3.6

---

## Additional Notes

- jQuery is used to asynchronously download CSV files.
- The project UI is responsive and uses Bootstrap 5 for styling.
- The database schema are managed via Laravel migrations.


