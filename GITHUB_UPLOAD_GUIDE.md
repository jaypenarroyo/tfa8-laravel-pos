# Upload TFA8 to GitHub Using Visual Studio Code

## Part 1 Extract the project

1. Find `tfa8-laravel-pos.zip` in your Downloads folder.
2. Right-click it and select **Extract All**.
3. Click **Extract**.
4. Open the extracted folders until you see `artisan`, `composer.json`, `app`, `database`, `resources`, and `routes`.

Do not open the ZIP directly. Use the extracted folder containing `artisan`.

## Part 2 Open the correct folder in VS Code

1. Open Visual Studio Code.
2. Click **File > Open Folder**.
3. Select the inner `tfa8-laravel-pos` folder containing `artisan`.
4. Click **Select Folder**.
5. Click **Yes, I trust the authors** if asked.
6. Confirm `artisan` and `composer.json` appear in the Explorer on the left.

If they are missing, use **File > Open Folder** again and select the next folder inside.

## Part 3 Enable profile-picture processing

1. Open `C:\xampp\php\php.ini`.
2. Press **Ctrl+F** and find `;extension=gd`.
3. Change it to `extension=gd`.
4. Save the file.
5. Close and reopen the VS Code terminal.

## Part 4 Install and prepare Laravel

Select **Terminal > New Terminal**, then run these commands one at a time:

```powershell
composer install
Copy-Item .env.example .env
php artisan key:generate
New-Item database\database.sqlite -ItemType File -Force
php artisan migrate:fresh --seed
php artisan storage:link
php artisan test
```

The tests should pass. If `.env`, the database file, or the storage link already exists, continue to the next command.

## Part 5 Run and test authentication

1. Run:

   ```powershell
   php artisan serve
   ```

2. Open `http://127.0.0.1:8000`.
3. Click **Log in**.
4. Use `admin@example.com` and password `password`.
5. Confirm you can open **Customers** and **Users**.
6. Log out.
7. Manually enter `http://127.0.0.1:8000/customers`.
8. Confirm you are redirected to the login page.
9. Register a new account and confirm it is logged in automatically.
10. Press **Ctrl+C** in the terminal to stop the server.

## Part 6 Open Source Control

1. Look at the far-left VS Code toolbar.
2. Click the icon that looks like a branching line with three circles.
3. If it is hidden, select **View > Source Control** from the top menu.
4. Click **Initialize Repository**.

## Part 7 Check files before committing

Review the list under **Changes**. Make sure these are absent:

- `.env`
- `vendor`
- `node_modules`
- `database/database.sqlite`
- `public/storage`
- uploaded avatar files

These should be present:

- `.env.example`
- `composer.json` and `composer.lock`
- `package.json` and `package-lock.json`
- `app/Http/Controllers/Auth`
- `routes/auth.php`
- migrations and seeders
- resource controllers and views
- tests
- `README.md`

Never upload `.env` because it can contain application keys and database passwords.

## Part 8 Create the commit

1. Find the **Message** box at the top of Source Control.
2. Enter:

   ```text
   Complete TFA8 resource controllers and authentication
   ```

3. Click **Commit** or the checkmark icon.
4. Click **Yes** if VS Code asks to stage all changes.

If Git asks for your identity, run:

```powershell
git config --global user.name "Your Name"
git config --global user.email "your-github-email@example.com"
```

Then try the commit again.

## Part 9 Publish to GitHub

1. Click **Publish Branch** or **Publish to GitHub**.
2. Sign in and authorize VS Code if asked.
3. Enter the repository name `tfa8-laravel-pos`.
4. Select **Publish to GitHub public repository** if your instructor needs unrestricted access.
5. Wait for the upload to finish.
6. Click **Open on GitHub**.
7. Copy the repository URL for submission.

The URL should resemble `https://github.com/YOUR-USERNAME/tfa8-laravel-pos`.

## Part 10 Terminal method if Publish Branch is missing

1. Sign in at [GitHub](https://github.com).
2. Click **+ > New repository**.
3. Name it `tfa8-laravel-pos`.
4. Choose **Public**.
5. Do not add a GitHub README, `.gitignore`, or license.
6. Click **Create repository**.
7. In the VS Code terminal, run:

   ```powershell
   git init
   git add .
   git status
   git commit -m "Complete TFA8 resource controllers and authentication"
   git branch -M main
   git remote add origin https://github.com/YOUR-USERNAME/tfa8-laravel-pos.git
   git push -u origin main
   ```

8. Replace `YOUR-USERNAME` with your actual GitHub username.

If `origin already exists` appears, run:

```powershell
git remote set-url origin https://github.com/YOUR-USERNAME/tfa8-laravel-pos.git
git push -u origin main
```

## Part 11 Check the GitHub repository

On GitHub, confirm:

- `routes/web.php` contains both `Route::resource()` registrations.
- `routes/auth.php` is present.
- Customer and user controllers contain all seven resource methods.
- Breeze authentication controllers and views are present.
- Migrations, seeders, SQL export, and tests are present.
- `.env`, `vendor`, `node_modules`, and `database.sqlite` are absent.
- The repository is public or shared with your instructor.

## Part 12 Submit

Submit:

1. The GitHub repository URL.
2. The Laravel-compatible hosted application URL if required.

GitHub Pages cannot run PHP or Laravel, so the hosted application must use a Laravel-compatible PHP service.
