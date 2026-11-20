# TFA8 Laravel POS Resource Controllers and Authentication

This project extends the TFA7 Laravel POS by refactoring customer and user management into conventional resource controllers and protecting those routes with Laravel Breeze authentication. Public visitors can view the home and about pages, but they must register or log in before managing database records.

## Activity requirements completed

- One `Route::resource()` registration for customers
- One `Route::resource()` registration for users
- Conventional `index`, `create`, `store`, `show`, `edit`, `update`, and `destroy` controller methods
- Laravel Breeze registration, login, logout, password reset, password confirmation, and profile features
- `auth` middleware on every customer and user resource route
- Logged-out visitors redirected to the login page
- Securely hashed passwords and regenerated sessions
- CSRF protection on forms
- Existing TFA7 validation and avatar-upload features retained
- Resource and authentication feature tests
- Database migrations, seeder, and MySQL-compatible export

## Requirements

- PHP 8.2 or later
- Composer 2
- XAMPP PHP extensions: `fileinfo` and `gd`
- Git
- Visual Studio Code

Node.js is only needed if you want to rebuild the provided Tailwind authentication stylesheet. The compiled `public/css/auth.css` file is already included.

## Enable GD in XAMPP

1. Open `C:\xampp\php\php.ini`.
2. Find `;extension=gd`.
3. Remove the semicolon so it reads `extension=gd`.
4. Save the file and reopen the VS Code terminal.
5. Verify it with:

   ```powershell
   php -m | Select-String gd
   ```

## Run the project locally on Windows

1. Extract the ZIP.
2. In VS Code, select **File > Open Folder**.
3. Open the inner `tfa8-laravel-pos` folder containing `artisan` and `composer.json`.
4. Select **Terminal > New Terminal**.
5. Run these commands one at a time:

   ```powershell
   composer install
   Copy-Item .env.example .env
   php artisan key:generate
   New-Item database\database.sqlite -ItemType File -Force
   php artisan migrate:fresh --seed
   php artisan storage:link
   php artisan test
   php artisan serve
   ```

6. Open `http://127.0.0.1:8000`.

If `.env` or the storage link already exists, continue to the next command.

## Demo login

The seeder creates this demonstration account:

- Email: `admin@example.com`
- Password: `password`

Use this only for local assessment. Change or remove predictable demonstration passwords before a real deployment.

You can also create a new account at `/register`.

## Access-control check

1. Log out.
2. Visit `http://127.0.0.1:8000/customers`.
3. Confirm Laravel redirects you to `/login`.
4. Log in with the demo account.
5. Visit `/customers` again and confirm the list opens.
6. Repeat the check for `/users`.

## Resource routes

Both `customers` and `users` expose these protected actions:

| Action | Method and path | Purpose |
| --- | --- | --- |
| `index` | `GET /customers` | List records |
| `create` | `GET /customers/create` | Display the create form |
| `store` | `POST /customers` | Save a new record |
| `show` | `GET /customers/{customer}` | Display one record |
| `edit` | `GET /customers/{customer}/edit` | Display the edit form |
| `update` | `PUT/PATCH /customers/{customer}` | Save changes |
| `destroy` | `DELETE /customers/{customer}` | Delete a record |

The user resource follows the same pattern under `/users`.

## Important security behavior

- Passwords are hashed and never displayed.
- Laravel regenerates the session after login.
- Logout invalidates the session and regenerates its CSRF token.
- Protected resource routes use `auth` middleware.
- Forms contain CSRF tokens.
- The currently logged-in account cannot be deleted from the user-management list.
- Usernames and email addresses must be unique.
- Avatar files must be valid JPEG, PNG, or WebP images no larger than 2 MB.

## Test the project

Run:

```powershell
php artisan test
```

The suite checks authentication, registration, passwords, profiles, resource routes, protected redirects, CRUD forms, database constraints, and avatars.

## Important project files

- `routes/web.php`
- `routes/auth.php`
- `app/Http/Controllers/CustomerController.php`
- `app/Http/Controllers/UserController.php`
- `app/Http/Controllers/Auth/`
- `app/Models/User.php`
- `database/migrations/0001_01_01_000000_create_users_table.php`
- `database/seeders/PosSeeder.php`
- `database/pos_database.sql`
- `resources/views/auth/`
- `resources/views/customers/`
- `resources/views/users/`
- `tests/Feature/ResourceSecurityTest.php`
- `tests/Feature/Auth/`

## Optional frontend rebuild

The authentication stylesheet is already included. To rebuild it after changing Breeze or Tailwind views, install Node.js and run:

```powershell
npm install
npx tailwindcss -i resources/css/app.css -o public/css/auth.css --minify
```

## Upload to GitHub

Follow [GITHUB_UPLOAD_GUIDE.md](GITHUB_UPLOAD_GUIDE.md). Do not upload `.env`, `vendor`, `node_modules`, the SQLite database, or generated avatar files.

## Hosting note

GitHub stores the source code but cannot execute Laravel through GitHub Pages. Use a PHP host that supports Laravel, configure its environment variables and database, then run migrations and `php artisan storage:link` on the host. Disable debug mode and replace the demonstration password before public deployment.
