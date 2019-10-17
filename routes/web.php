<?php


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/add/product/view', 'ProductController@addproductview');
Route::post('/add/product/insert', 'ProductController@addproductinsert');
Route::get('/delete/product/{product_id}', 'ProductController@deleteproduct');
Route::get('/edit/product/{product_id}', 'ProductController@editproduct');
Route::post('/edit/product/insert', 'ProductController@editproductinsert');
Route::get('/restore/product/{product_id}', 'ProductController@restoreproduct');
Route::get('/parmanent/delete/product/{product_id}', 'ProductController@parmanentdeleteproduct');
Route::get('/add/category/view', 'CategoryController@addcategoryview');
Route::post('/add/category/insert', 'CategoryController@addcategoryinsert');
Route::get('/contact/message/view', 'HomeController@contactmessageview');
Route::get('/change/category/view/{category_id}', 'HomeController@changecategoryview');
Route::get('/message/view/{message_id}', 'HomeController@messageview');




// FrontendController
Route::get('/','FrontendController@index');
Route::get('/product/details/{product_id}','FrontendController@productdetails');
Route::get('/category/wise/product/{category_id}','FrontendController@categorywiseproduct');
Route::get('/contact','FrontendController@contact');
Route::post('/contact/insert','FrontendController@contactinsert');
Route::get('/add/to/cart/{product_id}','FrontendController@addtocart');
Route::get('/cart','FrontendController@cart');
Route::get('/delete/from/cart/{cart_id}','FrontendController@deletefromcart');
Route::get('/clear/cart','FrontendController@clearcart');
