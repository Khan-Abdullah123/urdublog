<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', ["as"=>"Home", "uses"=>"AjaxController@Home"]);


$router->get('about', ["as"=>"About", "uses"=>"AjaxController@About"]);

$router->get('contact', ["as"=>"Contact", "uses"=>"AjaxController@Contact"]);

$router->get('blog', ["as"=>"Blog", "uses"=>"AjaxController@BlogPage"]);
$router->get('blog/{id}', ["as"=>"Blog", "uses"=>"AjaxController@BlogDetail"]);

$router->get('single', ["as"=>"Single", "uses"=>"AjaxController@single"]);


$router->get('Admin/Login',["as"=>"Login", "uses"=>"AjaxController@Login"]);
$router->post('Admin/LoginUser',["as"=>"LoginUser", "uses"=>"AjaxController@LoginUser"]);
$router->group(['prefix' => 'Admin', 'middleware'=> 'auth'], function () use ($router) {
    $router->get('/Dashboard',["as"=>"Dashboard", "uses"=>"AjaxController@Dashboard"]);

    $router->get('/Blog',["as"=>"Blog", "uses"=>"AjaxController@Blog"]);
    $router->post('/BlogInsert',["as"=>"BlogInsert", "uses"=>"AjaxController@BlogInsert"]);
    $router->get('/BlogFetch',["as"=>"BlogFetch", "uses"=>"AjaxController@BlogFetch"]);
    $router->get('/BlogDelete',["as"=>"BlogDelete", "uses"=>"AjaxController@BlogDelete"]);

    $router->get('/Gallery',["as"=>"Gallery", "uses"=>"AjaxController@Gallery"]);
    $router->post('/GalleryInsert',["as"=>"GalleryInsert", "uses"=>"AjaxController@GalleryInsert"]);
    $router->get('/GalleryFetch',["as"=>"GalleryFetch", "uses"=>"AjaxController@GalleryFetch"]);
    $router->get('/GalleryDelete',["as"=>"GalleryDelete", "uses"=>"AjaxController@GalleryDelete"]);

    $router->get('/Contacts',["as"=>"Contacts", "uses"=>"AjaxController@Contacts"]);
    $router->get('/ContactsFetch',["as"=>"ContactsFetch", "uses"=>"AjaxController@ContactsFetch"]);

});
