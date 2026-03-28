# Deployment Instructions for Hostinger

To host your **THINK RIGHT FOOTBALL ACADEMY** management system on Hostinger, follow these steps:

## 1. Prepare Files
- Ensure you have pushed all changes to your GitHub repository: `https://github.com/kodenyen/football-academy-management`
- Run `npm run build` locally to generate the production assets.

## 2. Connect GitHub to Hostinger
- Log in to your Hostinger hPanel.
- Go to **Advanced** -> **Git**.
- Enter your repository URL: `https://github.com/kodenyen/football-academy-management`
- Set the branch to `main`.
- Set the installation directory to `/` (root).
- Click **Create**.

## 3. Configuration (.env)
- In the Hostinger File Manager, create/edit the `.env` file.
- Update `APP_ENV` to `production`.
- Update `APP_DEBUG` to `false`.
- Update `APP_URL` to your domain name (e.g., `https://thinkrightacademy.com`).
- Update the Database settings (MySQL) provided by Hostinger:
  ```env
  DB_CONNECTION=mysql
  DB_HOST=127.0.0.1
  DB_PORT=3306
  DB_DATABASE=u123456789_academy
  DB_USERNAME=u123456789_admin
  DB_PASSWORD=your_secure_password
  ```

## 4. Run Migrations on Hostinger
- Use the Hostinger **SSH Console** or **Web Terminal**.
- Run the following commands:
  ```bash
  composer install --no-dev --optimize-autoloader
  php artisan migrate --force
  php artisan db:seed --class=AcademySeeder --force
  ```

## 5. Web Root Configuration (CRITICAL)
- Hostinger serves files from the `public_html` directory.
- Since Laravel's entry point is `public/index.php`, you have two options:
  - **Option A (Recommended)**: Set the **Base Directory** of your domain to `public_html/public` in Hostinger settings.
  - **Option B**: Move all files into the root and the contents of the `public` folder into `public_html`, then update `index.php` paths.

## 6. Optimization
- Run these commands to speed up your site on Hostinger:
  ```bash
  php artisan config:cache
  php artisan route:cache
  php artisan view:cache
  ```

## 7. Storage Link
- Create a symbolic link for images:
  ```bash
  php artisan storage:link
  ```

Your system is now ready for production!
