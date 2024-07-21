<?php
return [
    '/bookstoreremake/public/' => 'Home@index',
    '/bookstoreremake/public/home' => 'Home@index',
    '/bookstoreremake/public/delete' => 'Home@delete',
    '/bookstoreremake/public/add' => 'Add@index',
    '/bookstoreremake/public/save' => 'Add@save',
    '/bookstoreremake/public/book-detail/{id}' => 'BookDetail@detail',
    '/bookstoreremake/public/books' => 'Books@index',
    '/bookstoreremake/public/category/{category}' => 'Books@filterByCategory',
    '/bookstoreremake/public/author/{author}' => 'Books@filterByAuthor',

    // Admin routes
    '/bookstoreremake/public/admin' => 'Admin@index',
    '/bookstoreremake/public/admin/create' => 'Admin@create',
    '/bookstoreremake/public/admin/update/{id}' => 'Admin@update',
    '/bookstoreremake/public/admin/delete' => 'Admin@delete',
    '/bookstoreremake/public/admin/manageUsers' => 'Admin@manageUsers',
    '/bookstoreremake/public/admin/manageUsers/delete/{id}' => 'Admin@deleteUser',
    '/bookstoreremake/public/admin/manageOrders' => 'Admin@manageOrders',
    '/bookstoreremake/public/admin/manageOrders/view/{id}' => 'Admin@viewOrder',
    '/bookstoreremake/public/admin/manageOrders/updateStatus/{id}' => 'Admin@updateOrderStatus',

    // User routes
    '/bookstoreremake/public/register' => 'Auth@register',
    '/bookstoreremake/public/register/save' => 'Auth@save',
    '/bookstoreremake/public/login' => 'Auth@login',
    '/bookstoreremake/public/logout' => 'Auth@logout',

    // Shopping cart routes
    '/bookstoreremake/public/cart' => 'CartController@index',
    '/bookstoreremake/public/cart/add/{id}' => 'CartController@add',
    '/bookstoreremake/public/cart/update/{id}' => 'CartController@update',
    '/bookstoreremake/public/cart/remove/{id}' => 'CartController@remove',

    // Order routes
    '/bookstoreremake/public/order/place' => 'OrderController@placeOrder',
    '/bookstoreremake/public/order/confirmation/{orderId}' => 'OrderController@orderConfirmation',
    '/bookstoreremake/public/orders' => 'OrderController@orderHistory',
    '/bookstoreremake/public/order/{orderId}' => 'OrderController@orderDetails',

];