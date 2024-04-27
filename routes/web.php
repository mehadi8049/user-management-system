<?php
    
	Router::get('/', 'App\Controllers\LoginController@login_form');
	Router::get('/login', 'App\Controllers\LoginController@login_form');
	Router::post('/login', 'App\Controllers\LoginController@login');
	Router::get('/logout', 'App\Controllers\LoginController@logout');
    
	Router::get('/register', 'App\Controllers\RegisterController@register_form');
	Router::post('/register', 'App\Controllers\RegisterController@store');

	Router::get('/home', 'App\Controllers\HomeController@index');
	Router::get('/profile', 'App\Controllers\HomeController@profile');
    
	Router::get('/users', 'App\Controllers\HomeController@users');
	Router::get('/user-edit', 'App\Controllers\HomeController@user_edit');
	Router::get('/user-delete', 'App\Controllers\HomeController@user_destroy');

	Router::post('/user-update', 'App\Controllers\HomeController@user_update');
	Router::post('/user-change-password', 'App\Controllers\HomeController@user_change_password');

