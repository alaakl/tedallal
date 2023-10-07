# E-Commerce System and Delivery Project

This project is an e-commerce system with integrated delivery management developed using the Laravel framework. It provides a platform for users to browse and purchase products, manage their shopping cart, and track the delivery of their orders.

## Features

- User Registration and Authentication: Users can create accounts, log in, and manage their profiles.

- Product Catalog: Display a wide range of products with details such as name, description, price, and images.

- Product Search and Filtering: Users can search for products by keywords and apply filters to narrow down their options.

- Shopping Cart: Users can add products to their cart, modify quantities, and proceed to checkout.

- Order Management: Users can view and manage their orders, including order status and history.

- Payment Integration: Integration with popular payment gateways to handle secure online transactions.

- Delivery Tracking: Users can track the progress of their orders and view estimated delivery dates.

- Delivery Management: Admin users have access to a dashboard to manage delivery personnel, assign orders for delivery, and track delivery statuses.


## Installation

1. Clone the repository:

   ```bash
   git clone https://github.com/alaakl/tedallal.git

2.Navigate to the project directory:
```bash
cd tedallal
```

3.Install dependencies using Composer:
```bash
composer install
```

4.Create a copy of the .env.example file and rename it to .env. Update the database configuration settings in the .env file with your MySQL credentials.

5.Generate an application key:
```bash
php artisan key:generate
```

6.Run database migrations and seed the database:
```bash
php artisan migrate --seed
```

7.Start the development server:
```bash
php artisan serve
```

8.Open your web browser and access the application at http://localhost:8000.
