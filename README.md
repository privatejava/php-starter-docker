# PHP-Nginx-MySQL Dockerized Starter

This project provides a ready-to-use Docker Compose setup for running a PHP application (WordPress-like or custom) with Nginx, MySQL, and phpMyAdmin. It includes a custom PHP build with common extensions for modern PHP apps.

## Features
- **Nginx** as a web server
- **PHP-FPM** with custom extensions (`mysqli`, `pdo_mysql`, `gd`, `zip`, etc.)
- **MySQL** database
- **phpMyAdmin** for easy DB management
- **Custom `php.ini`** for PHP configuration

## Getting Started

### Prerequisites
- [Docker](https://docs.docker.com/get-docker/)
- [Docker Compose](https://docs.docker.com/compose/install/)

### 1. Clone the repository
```bash
git clone <your-repo-url>
cd <project-folder>
```

### 2. Adjust Environment Variables
Copy `sample.env` to `.env` and edit as needed:
```bash
cp sample.env .env
```
Then edit the `.env` file to set your desired versions, ports, and database credentials.

### 3. Start the Stack
```bash
docker compose up -d
```
This will build the custom PHP image and start all services in the background.

### 4. Access Your Application
- **PHP App:** [http://localhost:12000](http://localhost:12000) (or your `APP_PORT`)
- **phpMyAdmin:** [http://localhost:12002](http://localhost:12002) (or your `PHPMYADMIN_PORT`)

### 5. Customizing PHP Configuration
Edit `php.ini` in the project root to change PHP settings. Restart the PHP container after changes:
```bash
docker compose restart php
```

## File Structure
```
docker-compose.yml      # Main Docker Compose file
Dockerfile.php          # Custom PHP build with extra extensions
php.ini                 # Custom PHP configuration
app/                    # Your PHP application code
nginx/default.conf      # Nginx site configuration
```

## Stopping the Stack
```bash
docker compose down
```

## Notes
- The default setup is suitable for local development. For production, update credentials and review security settings.
- You can add more PHP extensions by editing `Dockerfile.php`.

---

Feel free to modify this setup for your needs!
