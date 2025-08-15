# WALKFUSION-SHOES-AN-ECOMMERCE-PROJECT
Features--

Product Listing: Display products available in the store.

Product Search: Search products by name or category.

User Authentication: Users can register, login, and log out.

Shopping Cart: Add, remove, and update items in the cart.

Checkout: Secure payment process and order confirmation.

Admin Panel: Admin can add, edit, and remove products.

Prerequisites--

XAMPP: A free and open-source cross-platform web server solution stack package.

Download from: XAMPP Official Site

phpMyAdmin: A tool for managing MySQL databases.

A browser: To run and view the web application.


Installation--
1. Clone the Repository

First, clone this repository to your local machine.
2. Set Up XAMPP

Install XAMPP on your machine.

Open the XAMPP Control Panel and start the Apache and MySQL services.

By default, XAMPP uses port 80 for Apache and 3306 for MySQL. If these ports are in use, you may need to change them in the XAMPP configuration.

3. Import Database Using phpMyAdmin

Open phpMyAdmin by visiting http://localhost/phpmyadmin.

Create a new database called ecommerce_db.

Import the provided ecommerce_db.sql file into the newly created database.

Modify the database credentials in the config.php file (located in the root directory of your project) to match your database configuration.

4. Frontend Setup

The frontend files are in the assets folder, containing HTML, CSS, and JavaScript files.

You can customize the design and functionality by modifying the existing HTML, CSS, and JS files.

5. Backend Setup

The backend is powered by PHP and connects to the MySQL database.

The primary business logic resides in the main folder, which contains functions for handling product data, user authentication, and order processing.

6. Running the Application

Place the project folder inside the htdocs folder (located in your XAMPP installation directory).

Open a browser and visit http://localhost/ecommerce-project.

The homepage of the eCommerce website should load, and you can begin interacting with the system.

7. Admin Login

Default Admin Username: admin

Default Admin Password: admin123

Use these credentials to access the admin panel where you can manage products and orders.

Technologies Used

Frontend:

HTML5

CSS3

JavaScript


Backend:

PHP

MySQL

Development Environment:

XAMPP Server

phpMyAdmin (for MySQL management)

#Future Enhancements--

Integration with payment gateways (e.g., Stripe, PayPal).

User reviews and ratings for products.

Search filters by price, category, etc.

Product recommendations based on user behavior.

License

This project is licensed under the MIT License – see the LICENSE file for details.
