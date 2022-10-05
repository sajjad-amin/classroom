## Installation

1. Clone the project `https://github.com/sajjad-amin/Classroom`

2. Install composer following by this command: `composer install`

3. Copy `.env.example` file to `.env` on the root folder. You can type `copy .env.example .env` or `cp .env.example .env` using terminal in system directory.

4. Open your database ***XAMPP / LAMP / HeidiSQL*** (Whatever you use).
   Create a new database with any database name. `For Example:  system_db`
   Open your `.env` file and change the database name `DB_DATABASE` to whatever you have, username `DB_USERNAME` and password `DB_PASSWORD` field correspond to your configuration. By default, the username is `root` and you can leave the **password field empty**. *(This is for Xampp)*. By default, the username is `root` and password is also `root`. *(This is for Lamp)*.

5. Set SMTP and mail credentials.

6. Now run following commands on terminal:
```
php artisan key:generate
php artisan migrate:fresh --seed
php artisan storage:link
php artisan optimize:clear
```
7. Now run this command `php artisan serve`. Then open browser and go to `http://localhost:8000`

## Demo Login Credentials

| Auth Users     | Email            | Password    |
|:---------------|:-----------------|:------------|
| **Demo Teacher** | `teacher@demo.com` | `demoteacher` |
| **Demo Student**  | `student@demo.com`  | `demostudent`  |
