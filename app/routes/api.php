<?php
return [
    // Books routes
    'GET /bookstore/public/api/books' => 'Books@index',
    'POST /bookstore/public/api/books' => 'Books@store', 
    'GET /bookstore/public/api/books/{id}' => 'BookDetail@detail',
    'DELETE /bookstore/public/api/books/{id}' => 'Books@delete', 
    'GET /bookstore/public/api/books/category/{category}' => 'Books@filterByCategory',
    'GET /bookstore/public/api/books/author/{author}' => 'Books@filterByAuthor',

    // Admin routes
    'GET /bookstore/public/api/admin' => 'Admin@index',
    'POST /bookstore/public/api/admin' => 'Admin@store',
    'PUT /bookstore/public/api/admin/{id}' => 'Admin@update',
    'DELETE /bookstore/public/api/admin/{id}' => 'Admin@delete',

    // User routes
    'POST /bookstore/public/api/register' => 'Auth@register',
    'POST /bookstore/public/api/register/save' => 'Auth@save',
    'POST /bookstore/public/api/login' => 'Auth@login',
    'POST /bookstore/public/api/logout' => 'Auth@logout',

    // Shopping cart routes
    'GET /bookstore/public/api/cart' => 'CartController@index',
    'POST /bookstore/public/api/cart' => 'CartController@add',
    'PUT /bookstore/public/api/cart/{id}' => 'CartController@update',
    'DELETE /bookstore/public/api/cart/{id}' => 'CartController@remove',

    // Order routes
    'POST /bookstore/public/api/orders' => 'OrderController@placeOrder',
    'GET /bookstore/public/api/orders/confirmation/{orderId}' => 'OrderController@orderConfirmation',
    'GET /bookstore/public/api/orders' => 'OrderController@orderHistory',
    'GET /bookstore/public/api/orders/{orderId}' => 'OrderController@orderDetails',
];
