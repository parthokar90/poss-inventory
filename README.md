![Tests](https://github.com/parthokar90/poss-inventory/actions/workflows/ci.yml/badge.svg)
# POS Inventory Management System 

A complete **POS & Inventory Management System** built with **Laravel**, designed for small to medium businesses to manage products, stock, sales, purchases, customers, suppliers, and reports efficiently.

---

## Features

### Authentication & Roles

* Secure login & registration
* Role-based access control (Admin, Manager, Staff)

### Product Management

* Product CRUD (Create, Read, Update, Delete)
* Category & Brand management
* Barcode support
* Product cost & selling price

### Inventory Management

* Real-time stock tracking
* Low stock alerts
* Stock adjustment (increase/decrease)
* Warehouse / Store support (optional)

### POS (Point of Sale)

* Fast POS interface
* Barcode scanning
* Cart system
* Discount & tax support
* Multiple payment methods (Cash / Card / Mobile Banking)
* Invoice generation & print support

### Customer & Supplier Management

* Customer CRUD
* Supplier CRUD
* Due tracking (customer & supplier)

### Purchase Management

* Purchase from suppliers
* Purchase history
* Auto stock update on purchase

### Reports

* Daily / Monthly sales report
* Purchase report
* Profit & loss report
* Stock report
* Customer due report

### Settings

* Company profile
* Tax & discount settings
* Invoice settings

---

## Tech Stack

* **Backend:** Laravel (PHP)
* **Frontend:** Blade / Bootstrap
* **Database:** MySQL
* **Authentication:** Laravel Auth

---

## Project Structure

```
pos-inventory/
├── app/
│   ├── Http/Controllers/
│   ├── Models/
│   └── Services/
├── database/
│   ├── migrations/
│   └── seeders/
├── resources/
│   ├── views/
│   └── js/
├── routes/
│   ├── web.php
│   └── api.php
├── public/
└── README.md
```

---

## Installation Guide

### 1️⃣ Clone the Repository

### 2️⃣ Install Dependencies

```bash
composer install
npm install && npm run dev
```

### 3️⃣ Environment Setup

```bash
cp .env.example .env
php artisan key:generate
```

Update `.env` file with your database credentials:

```env
DB_DATABASE=pos_inventory
DB_USERNAME=root
DB_PASSWORD=
```

### 4️⃣ Run Migrations & Seeders

```bash
php artisan migrate --seed
```

### 5️⃣ Storage Link

```bash
php artisan storage:link
```

### 6️⃣ Run the Project

```bash
php artisan serve
```

Visit: `http://127.0.0.1:8000`


##  Testing

```bash
php artisan test
```

---

##  Future Improvements

* Multi-branch support
* Mobile app integration
* REST API for POS devices
* Advanced analytics dashboard

---

##  Contributing

Contributions are welcome!

1. Fork the repository
2. Create a new branch
3. Commit your changes
4. Open a pull request

---

## License

This project is open-source and licensed under the **MIT License**.

---

## Author

**Partho**
Senior Software Developer
Laravel | PHP | MySQL

---

⭐ If you like this project, don’t forget to give it a star!
