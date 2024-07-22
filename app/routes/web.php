<?php
return [
    '/bookstore/public/' => 'Home@index',
    '/bookstore/public/home' => 'Home@index',
    '/bookstore/public/delete' => 'Home@delete',
    '/bookstore/public/add' => 'Add@index',
    '/bookstore/public/save' => 'Add@save',
    '/bookstore/public/book-detail/{id}' => 'BookDetail@detail',
    '/bookstore/public/books' => 'Books@index',
    '/bookstore/public/category/{category}' => 'Books@filterByCategory',
    '/bookstore/public/author/{author}' => 'Books@filterByAuthor',

    // Admin routes
    '/bookstore/public/admin' => 'Admin@index',
    '/bookstore/public/admin/create' => 'Admin@create',
    '/bookstore/public/admin/update/{id}' => 'Admin@update',
    '/bookstore/public/admin/delete' => 'Admin@delete',
    '/bookstore/public/admin/manageUsers' => 'Admin@manageUsers',
    '/bookstore/public/admin/manageUsers/delete/{id}' => 'Admin@deleteUser',
    '/bookstore/public/admin/manageOrders' => 'Admin@manageOrders',
    '/bookstore/public/admin/manageOrders/view/{id}' => 'Admin@viewOrder',
    '/bookstore/public/admin/manageOrders/updateStatus/{id}' => 'Admin@updateOrderStatus',

    // User routes
    '/bookstore/public/register' => 'Auth@register',
    '/bookstore/public/register/save' => 'Auth@save',
    '/bookstore/public/login' => 'Auth@login',
    '/bookstore/public/logout' => 'Auth@logout',

    // Shopping cart routes
    '/bookstore/public/cart' => 'CartController@index',
    '/bookstore/public/cart/add/{id}' => 'CartController@add',
    '/bookstore/public/cart/update/{id}' => 'CartController@update',
    '/bookstore/public/cart/remove/{id}' => 'CartController@remove',

    // Order routes
    '/bookstore/public/order/place' => 'OrderController@placeOrder',
    '/bookstore/public/order/confirmation/{orderId}' => 'OrderController@orderConfirmation',
    '/bookstore/public/orders' => 'OrderController@orderHistory',
    '/bookstore/public/order/{orderId}' => 'OrderController@orderDetails',

];
