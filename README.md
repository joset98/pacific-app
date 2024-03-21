<p align="center">
  <a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400">
  </a>
  <a href="https://vuejs.org" target="_blank" rel="noopener noreferrer"><img width="100" src="https://vuejs.org/images/logo.png" alt="Vue logo"></a>
</p>

# Basic Boilerplate for Laravel + Vue

## Introduction

This boilerplate was built in order to save time when starting a project and in turn reduce the amount of errors that usually occur.

The code is made up of the laravel frameworks for the backend and Vue.js for the frontend, note that in the laravel section, SOLID was used, one of the fundamental programming principles for the scalability of a software project, also in Vue.js is built in such a way as to facilitate the installation of external templates or to start all project design from zero.

## Install

GIT:
```bash
git clone https://gitlab.com/program-me/scale-core/basic-boilerplate.git
```

Vue:
```bash
npm install
```

Laravel:
```bash
composer install
```

You will need to create a database and .env file for the project

Laravel:
```bash
composer dump-autoload
php artisan jwt:secret
php artisan key:generate
php artisan migrate:refresh --seed
```

Finally you must run the server for the backend and for the frontend

```bash
php artisan serve
npm run watch
```

## How to use

The files that we will be interested in reviewing at the beginning will be the backend routes, both those of 'web' and those of 'api'.

Routes web:
```php
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Web Router
Route::get('/{any}', function (){
  return view('main');
})->where('any', '.*');

```

Routes api:
```php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
// Controllers
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
// login and logout
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);

// Register
Route::post('/register', [UserController::class, 'store']);

// Other Routers
Route::group(['middleware' => ['jwt.verify']], function () {
  Route::get('/me', [UserController::class, 'getMe']);
});
```

As we can see, our web route simply takes care of displaying a laravel file 'main.blade.php' where all our applications will be.

While in the 'api' file we have all the other routes that take care of the functionality of our application.

This was done in this way because the 'basic boilerplate' is not only designed to be a complete application, but also to function as an api so that it can be used later by some external frontend to it.


Continuing with the tour we can proceed to go to the file 'main.blade.php', where we will find the following code:

```html
<!doctype html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <link rel="icon" type="image/ico" href="{{ url('adminator/images/logo.ico') }}">
    <title>Boilerplate</title>

    <!-- Styles -->
    <link href="{{ asset('adminator/css/themify-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('adminator/css/font-awesome.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('adminator/css/style.css') }}" rel="stylesheet">
  </head>
  <body>
    <div id="app">
      <app />
    </div>

    <!-- Scripts -->
    <script type="text/javascript" src="{{ url('adminator/js/vendor.js') }}"></script>
    <script type="text/javascript" src="{{ url('adminator/js/bundle.js') }}"></script>
    <script type="text/javascript" src="{{ url('js/app.js') }}"></script>
  </body>
</html>
```

We can see that it is a simple HTML code with some css style imports and some js files.

Where all the imported files that are inside the 'adminator' folder belong to a template that is integrated into the project, which if you don't want to use it, simply delete these imports from here.

For what our css / app.css and js / app.js files are, they are vitally important for our frontend to work in Vue since they are in charge of creating and styling our entire application.

It should be noted that all these files can be found in the project's 'public' folder once we run the server.

To finish with this file we have the <app /> component which is a Vue component that is being used within our 'body' which is in charge of manipulating all frontend functionality from showing each of our 'layouts' and Later the views that are within said layouts, as well as components that are in said views all this is possible thanks to 'vue-router' if we go to the following files we can understand much more in depth how our application is constituted in the frontend:

 - resources/js/app.js
 - resources/js/router/index.js
 - resources/js/app.vue

 First let's see our 'app.js' file, which is in charge of all the imports necessary for our project in vue to work.

 ```js
 // In case of not using a template (optional)
 // require('./bootstrap');

 window.Vue = require('vue');
 import Vue from 'vue';

 // Store of vue
 import Store from './store/store';
 Vue.use(Store);

 // Component app
 Vue.component('app', require('./app.vue').default);

 // Inports
 import router from './router';

 // Other Imports
 import './helpers/vue';


 const app = new Vue({
   el: '#app',
   router,
   linkActiveClass: 'active'
 });

 ```

 Here we find all the necessary facilities for our project in Vue to work, importing the fundamental facilities which are 'Store', 'Router' and importing our 'app' component which is the one we use in our 'body' of the file 'main.blade.php'.

 Now if we go to the vue routes file we will find each of those routes with which we will be accessing each of our 'layouts' and 'views'.

 ```js
 import Vue from 'vue';
 import Router from 'vue-router';
 import RouterAdminator from '../adminator/router';

 Vue.use(Router)

 export default new Router({
   mode: 'history',
   routes: [
     //# Routers adminator
       ...RouterAdminator,

     //# Routers customizable
       // {
       //   path: '/',
       //   component: require('../layout/main.vue').default,
       //   children: [
       //     {
       //       path: '/inicio',
       //       name: 'home',
       //       component: require('../views/home.vue').default
       //     },
       //   ]
       // }
   ]
 })
 ```

We can see that here we are only importing the file 'RouterAdminator' and we have other commented routes, this is because we do not want to join the routes that a template uses with the routes that we use in case we create a view made by us or it is From another template that we found integrated.

In case we do not want to use our template as in the 'main.blade.php' file, let's remove these routes from here and uncomment our routes or start creating our own.

It should be noted that if we decide to use the adminator template most of our frontend will be in the folder called adminator found in resources/js/adminator.

Finally, we have the file 'app.vue' which is our component in charge of taking greater control of our parent routes within Vue.

```html
<template>
  <div>
    <router-view></router-view>

    <!-- Dynamic load -->
    <div class="loaderDinamic">
      <div id="loaderDinamic" class="loaderDinamic_children"></div>
    </div>
    <!-- Dynamic load -->
  </div>
</template>

<script>
export default {
  name: 'app',
  async mounted(){
    await this.$store.dispatch('main/isAutenticated', this);
  },
}
</script>

```

From here we have that what is in charge of manipulating our routes, is the component '<router-view> </router-view>' which is typical of Vue.

Now going back to our 'routes / api.php' file we can see the existing routes and a midleware for the project:

```php
// login and logout
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);

// Register
Route::post('/register', [UserController::class, 'store']);

// Other Routers if login
Route::group(['middleware' => ['jwt.verify']], function () {
  Route::get('/me', [UserController::class, 'getMe']);
});
```

If we go to each of the controllers that are in these routes we can see the logic behind them.

Knowing all the aforementioned we will be able to understand much better how the 'basic boilerplate' was made and we will be able to proceed to use it and learn many more details that were not mentioned in this unproductive documentation.

Success in your heart projects @darens <3
