<?php
return [
    // Books routes
    'GET /bookstoreremake/public/api/books' => 'Books@index',
    'POST /bookstoreremake/public/api/books' => 'Books@store', // Assuming this would replace the 'save' functionality
    'GET /bookstoreremake/public/api/books/{id}' => 'BookDetail@detail',
    'DELETE /bookstoreremake/public/api/books/{id}' => 'Books@delete', // Assuming this replaces 'Home@delete'
    'GET /bookstoreremake/public/api/books/category/{category}' => 'Books@filterByCategory',
    'GET /bookstoreremake/public/api/books/author/{author}' => 'Books@filterByAuthor',

    // Admin routes
    'GET /bookstoreremake/public/api/admin' => 'Admin@index',
    'POST /bookstoreremake/public/api/admin' => 'Admin@store', // Assuming this replaces 'create' and 'save'
    'PUT /bookstoreremake/public/api/admin/{id}' => 'Admin@update',
    'DELETE /bookstoreremake/public/api/admin/{id}' => 'Admin@delete',

    // User routes
    'POST /bookstoreremake/public/api/register' => 'Auth@register',
    'POST /bookstoreremake/public/api/register/save' => 'Auth@save', // Ideally, this should be integrated with 'register'
    'POST /bookstoreremake/public/api/login' => 'Auth@login',
    'POST /bookstoreremake/public/api/logout' => 'Auth@logout',

    // Shopping cart routes
    'GET /bookstoreremake/public/api/cart' => 'CartController@index',
    'POST /bookstoreremake/public/api/cart' => 'CartController@add', // Assuming the item ID is sent in the request body
    'PUT /bookstoreremake/public/api/cart/{id}' => 'CartController@update',
    'DELETE /bookstoreremake/public/api/cart/{id}' => 'CartController@remove',

    // Order routes
    'POST /bookstoreremake/public/api/orders' => 'OrderController@placeOrder',
    'GET /bookstoreremake/public/api/orders/confirmation/{orderId}' => 'OrderController@orderConfirmation',
    'GET /bookstoreremake/public/api/orders' => 'OrderController@orderHistory',
    'GET /bookstoreremake/public/api/orders/{orderId}' => 'OrderController@orderDetails',
];