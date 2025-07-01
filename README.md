# 🛠️ InvenBill – Laravel Backend API

This is the **Laravel-based backend** for the **InvenBill** app – a smart Inventory and Billing System for small businesses, retail shops, and wholesalers. It provides secure, RESTful APIs to support product management, stock tracking, invoice generation, user roles, and admin analytics.

Built using **Laravel 11**, **Sanctum** for authentication, and **MySQL** for data storage.

---

## 🚀 Features

✅ RESTful API (JSON responses)  
✅ Token-based Auth with Laravel Sanctum  
✅ Role-based access (Admin / Staff)  
✅ Product & Stock CRUD  
✅ Invoice creation with PDF generation  
✅ Sales dashboard (daily/monthly stats)  
✅ Export to CSV (products/invoices)  
✅ PDF templates (server-rendered if needed)  
✅ API integrated with Flutter frontend

---

## 📁 Folder Structure Overview

invenbill-backend/
├── app/
│ ├── Http/
│ │ ├── Controllers/ # API controllers (ProductController, InvoiceController, etc.)
│ │ ├── Middleware/
│ ├── Models/ # Product.php, Invoice.php, User.php, etc.
├── database/
│ ├── migrations/ # DB table definitions
│ ├── seeders/ # Optional seed data
├── routes/
│ └── api.php # API routes for mobile app
├── config/
│ └── sanctum.php # Sanctum auth config
├── resources/
│ └── views/invoices/ # Optional invoice blade template

yaml
Copy
Edit

---

## ⚙️ Installation & Setup

### 1. Clone the Repository
```bash
git clone https://github.com/your-username/invenbill-backend.git
cd invenbill-backend
2. Install Dependencies
bash
Copy
Edit
composer install
3. Environment Setup
bash
Copy
Edit
cp .env.example .env
php artisan key:generate
Update .env with your database configuration:

env
Copy
Edit
DB_DATABASE=invenbill
DB_USERNAME=root
DB_PASSWORD=
4. Run Migrations
bash
Copy
Edit
php artisan migrate
5. (Optional) Seed Test Data
bash
Copy
Edit
php artisan db:seed
6. Serve API Locally
bash
Copy
Edit
php artisan serve
Access: http://localhost:8000

🔐 Authentication
Uses Laravel Sanctum for API token-based login.

On successful login, returns an access_token

Token must be included in Authorization: Bearer <token> header in all subsequent API requests

📡 API Endpoints
🔑 Auth
Method	Endpoint	Description
POST	/api/register	Register user
POST	/api/login	Login user & get token
GET	/api/logout	Logout user

📦 Products
Method	Endpoint	Description
GET	/api/products	List products
POST	/api/products	Create new product
PUT	/api/products/{id}	Update product
DELETE	/api/products/{id}	Delete product

📥 Stock Management
Method	Endpoint	Description
POST	/api/stock/in	Add stock
POST	/api/stock/out	Reduce stock (sale/damage)
GET	/api/stock/logs	View stock transactions

🧾 Invoices
Method	Endpoint	Description
POST	/api/invoices	Create new invoice
GET	/api/invoices	List invoices
GET	/api/invoices/{id}	Invoice details
GET	/api/invoices/{id}/pdf	Download PDF

📊 Dashboard
Method	Endpoint	Description
GET	/api/dashboard/stats	Total sales, low stock, etc.

🔓 Roles & Permissions
Role	Access
Admin	Full access to all endpoints + users
Staff	Products, stock, invoices only

Implemented using Laravel middleware:

php
Copy
Edit
Route::middleware(['auth:sanctum', 'role:admin'])->group(...);
📄 PDF & Export
Server generates invoice PDF using Blade templates + dompdf

Optional CSV export for products/invoices available via:

/api/products/export

/api/invoices/export

✅ Environment Variables (Important)
Make sure to configure:

env
Copy
Edit
APP_NAME=InvenBill
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=invenbill
DB_USERNAME=root
DB_PASSWORD=

SANCTUM_STATEFUL_DOMAINS=localhost:8000
SESSION_DOMAIN=localhost
📦 Suggested Database Tables
users (id, name, email, password, role)

products (id, name, barcode, price, qty, image)

stock_logs (id, product_id, type[in/out], qty, reason, date)

invoices (id, customer_name, total, tax, date)

invoice_items (invoice_id, product_id, qty, price, subtotal)

Want the full ERD diagram? Open an issue

📤 Deployment (Optional)
To deploy to production:

bash
Copy
Edit
php artisan config:cache
php artisan route:cache
php artisan migrate --force
Use services like:

Laravel Forge

Shared Hosting with PHP 8+

VPS with Apache/Nginx + MySQL

📫 Contact / Support
Developed by Gursharath (23BCE1825)

Need help? Open an Issue

