# GForms

## Overview
**GForms** is a form creation project designed for surveys, allowing users to dynamically create forms based on their needs and share them with others, similar to Google Forms.

## Tech Stack
- **Laravel**: Backend framework
- **Tailwind CSS**: CSS framework
- **AlpineJS**: Lightweight JavaScript framework

## Installation

### Prerequisites
- **PHP**: Version 8.0
- **Node.js**: Version 20 or lower

### Clone the Repository
```bash
git clone https://github.com/maheshmaniya000/hiking-adventure.git
cd hiking-adventure-website
```

### Install Dependencies

Install PHP dependencies:
```bash
composer install
```

Install Node.js dependencies:
```bash
npm install
```

### Set Up Environment Variables

Create a copy of the `.env.example` file:
```bash
cp .env.example .env
```

Generate the application key:
```bash
php artisan key:generate
```

### Configure Database

Edit the `.env` file to set up your database connection:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=gforms
DB_USERNAME=root
DB_PASSWORD=your_password_here
```

### Run Database Migrations and Seeders

Run the following command to create the necessary database tables and populate them with initial data:
```bash
php artisan migrate --seed
```

### Start the Development Server

In one terminal, start the Laravel server:
```bash
php artisan serve
```

In another terminal, compile the frontend assets:

- For development:
  ```bash
  npm run dev
  ```
- To watch for changes:
  ```bash
  npm run watch
  ```
- For production:
  ```bash
  npm run prod
  ```

### Create an Admin User

To create an admin user, run the following command:
```bash
php artisan db:seed --class=CreateAdminSeeder
```

## Conclusion
You are now ready to start using **GForms**! Visit `http://localhost:8000` in your browser to access the platform.
