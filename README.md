# Dummy Bookstore MVC / REST API

## Table of Contents
1. [Introduction](#introduction)
2. [Features](#features)
3. [Technologies Used](#technologies-used)
4. [Project Structure](#project-structure)
5. [Installation](#installation)
6. [Usage](#usage)
7. [API Endpoints](#api-endpoints)
8. [Contributing](#contributing)
9. [License](#license)
10. [Contact](#contact)

## Introduction
This project is a comprehensive portfolio example of a bookstore web application built using HTML, CSS, JavaScript, PHP, and MySQL. The project follows OOP and MVC best practices and includes a RESTful API for interacting with the bookstore's data.

## Features
- User authentication system with registration and login/logout
- Book listing, specific book detail page and search functionality
- Shopping cart(with CRUD) and order management & details
- RESTful API for book data, user auth, admin panel with all the request method for CRUD operations
- Admin dashboard for managing books, users, and orders

## Technologies Used
- **Frontend**: HTML, CSS (Bootstrap), JavaScript
- **Backend**: PHP (OOP, MVC)
- **Database**: MySQL
- **API**: RESTful architecture

## Project Structure
as you can see from the repo it's set up using the MVC structure and handled as best of my ability using
DRY, OOP principles

## Installation
1. Clone the repository:
2. Set up your database and update the configuration file in `config/config.php`.
3. Start your local server and access the project via your browser.

## Usage
1. Access the frontend via `http://localhost/bookstore(orwhatever your project root is/public/`.
2. Use the admin dashboard to manage books, users, and orders.
3. Interact with the API using tools like Postman or curl.

## API Endpoints
- **GET public/api/books**: Fetch a list of books with pagination.
- **GET public/api/books/{id}**: Fetch details of a specific book.
- **POST public/api/users/register**: Register a new user.
- **POST public/api/users/login**: Authenticate a user and receive a token.
- **POST public/api/cart/add**: Add a book to the shopping cart.
- **POST public/api/orders/place**: Place an order.


## Contact
For any questions or suggestions, feel free to contact me at:
- **Email**: iamabduahmed@gmail.com 
- **Portfolio**: https://abdu-ahmed.github.io/
