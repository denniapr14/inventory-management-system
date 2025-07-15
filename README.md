# Inventory Management API

A RESTful API for inventory management built with Laravel 11 and Sanctum authentication.

# Install dependencies:

bash
composer install
npm install

# Setup environment:
bash
cp .env.example .env
php artisan key:generate
Configure database in .env:

# env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=inventory_management
DB_USERNAME=root
DB_PASSWORD=

$ Run migrations:
bash
php artisan migrate

# Install Sanctum:
bash
php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"

Start development server:
bash
php artisan serve

## Features

- ✅ Sanctum API Authentication
- 🏷️ Product Management
- 📍 Location Management
- 📦 Product-Location Stock Management
- 🔄 Stock Mutation Tracking
- 🔐 Role-based Access Control

## API Documentation

[![Run in Postman](https://run.pstmn.io/button.svg)](https://god.gw.postman.com/run-collection/YOUR_COLLECTION_ID)


### Authentication

| Endpoint       | Method | Description                | Auth Required |
|----------------|--------|----------------------------|---------------|
| `/api/login`   | POST   | Login user                 | No            |
| `/api/register`| POST   | Register new user          | No            |
| `/api/me`      | GET    | Get authenticated user     | Yes           |

### Products

| Endpoint                  | Method | Description                     | Auth Required |
|---------------------------|--------|---------------------------------|---------------|
| `/api/produk`             | GET    | List all products               | Yes           |
| `/api/produk`             | POST   | Create new product              | Yes           |
| `/api/produk/{id}`        | GET    | Get product details             | Yes           |
| `/api/produk/{id}`        | PATCH  | Update product                  | Yes           |
| `/api/produk/{id}`        | DELETE | Delete product                  | Yes           |
| `/api/produk/{id}/mutasi` | GET    | Get product mutation history    | Yes           |

### Locations

| Endpoint               | Method | Description                | Auth Required |
|------------------------|--------|----------------------------|---------------|
| `/api/lokasi`          | GET    | List all locations         | Yes           |
| `/api/lokasi`          | POST   | Create new location        | Yes           |
| `/api/lokasi/{id}`     | GET    | Get location details       | Yes           |
| `/api/lokasi/{id}`     | PATCH  | Update location            | Yes           |
| `/api/lokasi/{id}`     | DELETE | Delete location            | Yes           |

### Product Locations

| Endpoint                     | Method | Description                     | Auth Required |
|------------------------------|--------|---------------------------------|---------------|
| `/api/produk-lokasi`         | GET    | List all product locations      | Yes           |
| `/api/produk-lokasi/{id}`    | GET    | Get product location details    | Yes           |
| `/api/produk-lokasi/{id}`    | PATCH  | Update product stock            | Yes           |

### Mutations

| Endpoint               | Method | Description                | Auth Required |
|------------------------|--------|----------------------------|---------------|
| `/api/mutasi`          | GET    | List all mutations         | Yes           |
| `/api/mutasi`          | POST   | Create new mutation        | Yes           |
| `/api/mutasi/{id}`     | GET    | Get mutation details       | Yes           |
| `/api/mutasi/{id}`     | PATCH  | Update mutation            | Yes           |
| `/api/mutasi/{id}`     | DELETE | Delete mutation            | Yes           |
| `/api/mutasi/history`  | GET    | Get mutation history       | Yes           |

