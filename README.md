# NoteApp

Laravel-based note-taking app.

![Demo Image](https://i.imgur.com/MKbubtS.png)

## Prerequisites:
- Laravel
- npm
- PHP
- Composer

## Quick Setup:

### Clone this Repo

```bash
git clone https://github.com/asymmetry1/noteApp.git

cd noteApp
```

Rename `.env.example' to '.env'
```bash
cp .env.example .env
```

Run Composer:
```bash
composer install
```

Generate app-key:
```
php artisan key:generate
```

Set Database
```
touch database/database.sqlite
```

in `.env` (Kalo belum di set):
```bash
DB_CONNECTION=sqlite
DB_DATABASE=/absolute/path/to/database/database.sqlite
```

Install dependency:

```bash
npm install
npm run build
npm run dev 
```

Run Migrations:
```bash
php artisan migrate
```

Start Server:
```bash
php artisan serve
```

### Need Fix:

- Add register in login menu.
- dan lain-lain.