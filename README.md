![Tests](https://github.com/parthokar90/inventory/actions/workflows/ci.yml/badge.svg)

# Inventory Management System

A complete **Inventory & POS Management System** built with **Laravel**, designed to manage products, stock, purchases, sales, and warehouse operations in a scalable and efficient way.

This system helps businesses maintain accurate stock records, streamline purchase & sales workflows, and generate real-time reports through a centralized dashboard.
It follows clean MVC architecture and is suitable for real-world production use.

---
## Key Features

### Authentication & Authorization
- Admin, Vendor, and Customer authentication
- Role-based access control (RBAC)
- Secure login & registration system

---

### Product & Inventory Management
Product CRUD (Create, Read, Update, Delete)
Product stock tracking with quantity management
Low stock alert system
Product category & subcategory management
Product price, cost, and selling price control
Product status control (Active / Inactive)

---

### Warehouse & Stock Control
Multi-warehouse support
Warehouse-wise stock tracking
Stock in / stock out management
Transfer stock between warehouses
Real-time inventory updates
---

### Purchase Management
Supplier management system
Purchase order creation
Purchase history tracking
Automatic stock increase on purchase
Invoice generation

---

### Sales & POS System
POS (Point of Sale) system
Quick product selling interface
Cart-based order system
Invoice generation
Sales history tracking

---

### Reports & Analytics
Daily / monthly sales reports
Stock reports
Profit & loss tracking
Low stock report
Export reports (PDF / Excel ready structure)

---

## Tech Stack

- **Backend:** Laravel
- **Frontend:** Blade Template Engine
- **UI Framework:** Bootstrap
- **Database:** MySQL
- **Authentication:** Laravel Auth
- **ORM:** Eloquent ORM
- **Version Control:** Git & GitHub

# ⚙️ Installation & Setup

---

## 1️⃣ Clone the Repository

Clone the project from GitHub to your local machine.

```bash
git@github.com:parthokar90/poss-inventory.git
```

## 2️⃣ Navigate to Project Folder

Move into the project directory.

```bash
cd your-repository-name
```

3️⃣ Install PHP Dependencies
```bash
composer install
```

4️⃣ Install Frontend Dependencies
```bash
npm install
npm run dev
```

5️⃣ Configure Environment File

```bash
cp .env.example .env
```

6️⃣ Run Database Migration & Seeders
```bash
php artisan migrate --seed
```

7️⃣ Start the Development Server
```bash
php artisan serve
```








