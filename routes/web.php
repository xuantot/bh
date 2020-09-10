<?php

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

//--------------Frontend
//index
Route::get('', 'frontend\HomeController@GetIndex');





//about
Route::get('/about', 'frontend\HomeController@GetAbout');

//contact
Route::get('/contact','frontend\HomeController@GetContact');

//checkout
Route::group(['prefix' => 'checkout'], function () {
    Route::get('', 'frontend\CheckoutController@GetCheckout');
    Route::post('', 'frontend\CheckoutController@PostCheckout');
    Route::get('/complete/{id}', 'frontend\CheckoutController@GetComplete');
});

//product
Route::group(['prefix' => 'product'], function () {
    Route::get('', 'frontend\ProductController@GetShop');
    Route::get('/cart', 'frontend\ProductController@GetCart');
    Route::get('/add-cart', 'frontend\ProductController@AddCart');
    Route::get('/del-cart/{id}', 'frontend\ProductController@DelCart');
    Route::get('/update-cart/{rowId}/{qty}', 'frontend\ProductController@UpdateCart');
    Route::get('/detail/{id}', 'frontend\ProductController@GetDetail');
    Route::get('/update_detail/{id}', 'frontend\ProductController@UpdateDetail');
    
});



//-----------------Backend
//login
Route::get('login', 'backend\LoginController@GetLogin')->middleware('CheckLogout');
Route::post('login', 'backend\LoginController@PostLogin');



//admin
Route::group(['prefix' => 'admin','middleware'=>'CheckLogin'], function () {
    //index
    Route::get('', 'backend\IndexController@GetIndex');
    Route::get('/logout', 'backend\LoginController@GetLogout');
    Route::get('/info', 'backend\IndexController@GetInfo');
    Route::post('/info', 'backend\IndexController@PostInfo');

    //users
    Route::get('/user', 'backend\UsersController@GetUser');
    Route::get('/user/add', 'backend\UsersController@GetAddUser')->middleware('CheckUser');
    Route::post('/user/add', 'backend\UsersController@PostAddUser');
    Route::get('/user/edit/{id}', 'backend\UsersController@GetEditUser')->middleware('CheckUser');
    Route::post('/user/edit/{id}', 'backend\UsersController@PostEditUser');
    Route::get('/user/del/{id}', 'backend\UsersController@DelUser')->middleware('CheckUser');

    //category
    Route::group(['prefix' => 'category'], function () {
        Route::get('', 'backend\CategoryController@GetCategory');
        Route::post('', 'backend\CategoryController@PostCategory');

        Route::get('/edit/{id}', 'backend\CategoryController@GetEditCategory');
        Route::post('/edit/{id}', 'backend\CategoryController@PostEditCategory');

        Route::get('del/{id}','backend\CategoryController@GetDelCategory' );
    });

    //product
    Route::group(['prefix' => 'product'], function () {
        //product
        Route::get('', 'backend\ProductController@GetProduct');
        Route::get('/add', 'backend\ProductController@GetAddProduct');
        Route::post('/add', 'backend\ProductController@PostAddProduct');
        Route::get('/edit/{id}', 'backend\ProductController@GetEditProduct'); 
        Route::post('/edit/{id}', 'backend\ProductController@PostEditProduct');
        Route::get('/del/{id}', 'backend\ProductController@DelProduct'); 

        //attr
        Route::get('/detail-attr', 'backend\ProductController@GetDetailAttr');
        Route::get('/edit-attr/{id}', 'backend\ProductController@GetEditAttr');
        Route::post('/add-attr', 'backend\ProductController@AddAttr');
        Route::post('/edit-attr/{id}', 'backend\ProductController@PostEditAttr');
        Route::get('/del-attr/{id}', 'backend\ProductController@DelAttr');


        //value
        Route::get('/edit-value/{id}', 'backend\ProductController@GetEditValue');
        Route::post('/edit-value/{id}', 'backend\ProductController@PostEditValue');
        Route::post('/add-value', 'backend\ProductController@AddValue');
        Route::get('/del-value/{id}', 'backend\ProductController@DelValue');

        //variant
        Route::get('/add-variant/{id}', 'backend\ProductController@GetAddVariant');
        Route::post('/add-variant/{id}', 'backend\ProductController@PostAddVariant');
        Route::get('/edit-variant/{id}', 'backend\ProductController@GetEditVariant');
        Route::post('/edit-variant/{id}', 'backend\ProductController@PostEditVariant');
        Route::get('/del-variant/{id}', 'backend\ProductController@DelVariant');
    
    });

    //comment
    Route::group(['prefix' => 'comment'], function () {
        Route::get('', 'backend\CommentController@GetComment');
        Route::get('/edit', 'backend\CommentController@GetEditComment');
    });

    //order
    Route::group(['prefix' => 'order'], function () {
        Route::get('', 'backend\OrderController@GetOrder');
        Route::get('/detail/{id}', 'backend\OrderController@GetDetailOrder');
        Route::post('/detail/{id}', 'backend\OrderController@ActiveOrder');
        Route::get('/processed', 'backend\OrderController@GetProcessedOrder');
        //view mail
        Route::get('/view-mail/{id}', 'backend\OrderController@ViewMail');
        Route::post('/view-mail/{id}', 'backend\OrderController@PostViewMail');

       
    });

    
});
