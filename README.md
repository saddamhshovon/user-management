# Simple user management system built using PHP

## Installation

1. Clone the project.

2. Install the dependencies.

```bash
composer install
```

3. Copy the .env file

```bash
cp .env.example .env
```

4. Set the credentials in .env

5. There are 2 SQL files in `database` folder. Create a database and run them.

6. Serve the application using the following command
```bash
php -S localhost:8000 .\public\index.php
```

7. Open the link in browser.

8. You can log in using email `admin@example.com` and password: `password`

## Description

**Live Url:** http://user-mgmt.ddns.net/

**System Information:**
There are 3 roles available.
  1. Admin (Can do everything.)
  2. Moderator (Can create & view)
  3. User (Can view only)
Everyone can change their personal information. (System will logout the user if personal information is changed)

The default password is 'password' for all "created" (not registered) user.
