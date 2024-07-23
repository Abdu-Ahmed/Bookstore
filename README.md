# Dummy Bookstore MVC / REST API

## Table of Contents
1. [Introduction](#introduction)
2. [Features](#features)
3. [Technologies Used](#technologies-used)
4. [Project Structure](#project-structure)
5. [Installation](#installation)
6. [Usage](#usage)
7. [API Endpoints](#api-endpoints)
8. [Contact](#contact)

## Introduction
This project is a somewhat comprehensive portfolio dummy example of a bookstore web application built using HTML, CSS, JavaScript, PHP, and MySQL. it has almost all the functionality of a real e-commerce website but of course no payment gateaway or anything like that cause y'know "dummy" and all that, The project follows OOP and MVC best practices and includes a RESTful API for interacting with the bookstore's data.

What i want to specifically point out is the no use of back-end frameworks or any kind dependencies because this is my version of the to-do app, which i wanted to test out
what the max i can do with purely vanilla lang knowledge.

## Features
- User authentication system with registration and login/logout
- Cart system with CRUD implemented for cart items
- Order processing system with confirmation and order details and order history pages
- Book listing, specific book detail page and search functionality
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
2. Set up the database using the database file provided and update the configuration file in `config/config.php`.
3. Start your local server and access the project via your browser.

## Usage
1. Access the frontend via `http://localhost/bookstore/public/`.
2. Use the admin dashboard to manage books, users, and orders.
3. Interact with the API using tools like Postman or curl.

OR BETTER YET, CHECK IT OUT LIVE, HERE: https://abdubookstore.wuaze.com/

## API Endpoints
- **GET bookstore/public/api/books**: Fetch a list of books with pagination.
- **GET bookstore/public/api/books/{id}**: Fetch details of a specific book.
- **POST bookstore/public/api/users/register**: Register a new user.
- **POST bookstore/public/api/users/login**: Authenticate a user and receive a token.
- **POST bookstore/public/api/cart/add**: Add a book to the shopping cart.
- **POST bookstore/public/api/orders/place**: Place an order.
// these are just the tip of the iceberg, for all endpoints check app/routes/api.php

## Contact
For any questions or suggestions, feel free to contact me at:
- **Email**: iamabduahmed@gmail.com 
- **Portfolio**: https://abdu-ahmed.github.io/
