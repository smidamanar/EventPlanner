# EventPlanner

EventPlanner is a Laravel web application for discovering events, managing event registrations, and administering events and categories.

## Features

- Browse, search, and filter upcoming active events by category and weekday.
- View event details and related events.
- Register for events and manage your registrations.
- Administer events and categories, archive events, and review registrations.
- View an admin dashboard with event, registration, category, and user totals.
- User accounts, profile management, and authentication.

## Tech stack

- PHP 8.2+
- Laravel 12
- SQLite by default (other Laravel-supported database connections can be configured)
- Blade, Tailwind CSS, Alpine.js, and Vite

## Installation

Requirements: PHP 8.2+, Composer, Node.js, and npm.

1. Install PHP dependencies:

   ```sh
   composer install
   ```

2. Install frontend dependencies:

   ```sh
   npm install
   ```

3. Create your local environment file and application key:

   ```sh
   cp .env.example .env
   php artisan key:generate
   ```

4. Configure the database in `.env` if needed, then run migrations and seeders:

   ```sh
   php artisan migrate --seed
   ```

5. Build the frontend assets:

   ```sh
   npm run build
   ```

6. Start the local server:

   ```sh
   php artisan serve
   ```

Open the local URL printed by Artisan in your browser.

## Usage

Browse events from the home page or the events listing. Create an account and sign in to register for events and view your registrations. Administrators can manage events, categories, and registrations from the admin area.

## Running tests

```sh
php artisan test
```

## Screenshots

_Add application screenshots here._

## License

This project is licensed under the [MIT License](LICENSE).
