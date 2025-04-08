# vue-todo: Laravel Project with Docker or XAMPP

## Introduction
This project is a simple To-Do list application built with Laravel and Vue.js, containerized using Docker, or set up with XAMPP. The application supports authentication, task management (add, edit, delete), RESTful API, pagination, filtering, and search. The front-end is styled with basic UI components.

## Prerequisites
Before starting, make sure you have the following installed:
- Docker (for Docker setup)
- Docker Compose (for Docker setup)
- OR
- XAMPP (for local setup)
- Git


## Getting Started

### Clone the Repository
```bash
git clone https://github.com/Islam8Bahaa/vue-todo.git
cd vue-todo
```

## Using Docker
### Environment Configuration
1. Copy the example environment file:
```bash
cp .env.example .env
```
2. Update the following variables in the `.env` file:
- `DB_HOST=mysql`
- `DB_PORT=db`
- `DB_DATABASE=vue_todo`
- `DB_USERNAME=root`
- `DB_PASSWORD=root`

### Build and Start the Containers
```bash
docker-compose up --build -d
```

### Install Composer Dependencies
```bash
docker-compose exec app composer install
```

### Install NPM Dependencies
```bash
docker-compose exec app npm install

docker-compose exec app npm run dev
```

### Generate Application Key
```bash
docker-compose exec app php artisan key:generate
```

### Run Migrations
```bash
docker-compose exec app php artisan migrate --seed
```

### Access the Application
```
http://localhost:8081
```

## Using XAMPP

Locate the Project Folder in side the HTDOCS Folder and then start-up the xampp control.exe and then start-up the Apache and Mysql then Click on Admin button form Mysql and Create a new database make it as the same name of `DB_DATABASE=vue_todo`
### Environment Configuration
1. Copy the example environment file:
```bash
cp .env.example .env
```
2. Update the following variables in the `.env` file:
- `DB_HOST=127.0.0.1`
- `DB_PORT=3306`
- `DB_DATABASE=vue_todo`
- `DB_USERNAME=root`
- `DB_PASSWORD=`

### Start XAMPP
- Open XAMPP Control Panel and start Apache and MySQL.

### Install Composer Dependencies
```bash
composer install
```

### Install NPM Dependencies
```bash
npm install
npm run dev
```


### Generate Application Key
```bash
php artisan key:generate
```

### Run Migrations
```bash
php artisan migrate
```

## Stopping the Application
- For Docker: 
```bash
docker-compose down
```
- For XAMPP:
Stop Apache and MySQL from the XAMPP Control Panel.


## Login Or Register

## For Login 
- Enter  test@islam.com and the Password is password.

