<?php
return [
    // Books routes
    'GET /bookstoreremake/public/api/books' => 'Books@index',
    'POST /bookstoreremake/public/api/books' => 'Books@store', 
    'GET /bookstoreremake/public/api/books/{id}' => 'BookDetail@detail',
    'DELETE /bookstoreremake/public/api/books/{id}' => 'Books@delete', 
    'GET /bookstoreremake/public/api/books/category/{category}' => 'Books@filterByCategory',
    'GET /bookstoreremake/public/api/books/author/{author}' => 'Books@filterByAuthor',

    // Admin routes
    'GET /bookstoreremake/public/api/admin' => 'Admin@index',
    'POST /bookstoreremake/public/api/admin' => 'Admin@store', 
    'PUT /bookstoreremake/public/api/admin/{id}' => 'Admin@update',
    'DELETE /bookstoreremake/public/api/admin/{id}' => 'Admin@delete',

    // User routes
    'POST /bookstoreremake/public/api/register' => 'Auth@register',
    'POST /bookstoreremake/public/api/register/save' => 'Auth@save', 
    'POST /bookstoreremake/public/api/login' => 'Auth@login',
    'POST /bookstoreremake/public/api/logout' => 'Auth@logout',

    // Shopping cart routes
    'GET /bookstoreremake/public/api/cart' => 'CartController@index',
    'POST /bookstoreremake/public/api/cart' => 'CartController@add',
    'PUT /bookstoreremake/public/api/cart/{id}' => 'CartController@update',
    'DELETE /bookstoreremake/public/api/cart/{id}' => 'CartController@remove',

    // Order routes
    'POST /bookstoreremake/public/api/order/place' => 'OrderController@placeOrder',
    'GET /bookstoreremake/public/api/orders/confirmation/{orderId}' => 'OrderController@orderConfirmation',
    'GET /bookstoreremake/public/api/orders' => 'OrderController@orderHistory',
    'GET /bookstoreremake/public/api/orders/{orderId}' => 'OrderController@orderDetails',
];
