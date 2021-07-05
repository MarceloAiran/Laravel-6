<?php

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

// Route::resource('produto', 'ProdutoController')->middleware('auth');
Route::any('products/search', 'ProductController@search')->name('products.search');
Route::resource('products', 'ProductController');

// Route::get('/login', function () {
//     return 'Login';
// })->name('login');

// Route::group([
   
//     'prefix' => 'products',

// ], function () {
//     Route::name(".products")->group(function () {
       
//         Route::delete('/{id}', 'ProductController@destroy')->name('destroy');

//         Route::get('/create', 'ProductController@create')->name('create');
    
//         Route::post('/create', 'ProductController@store')->name('store');
    
//         Route::get('/{id}/edit', 'ProductController@edit')->name('edit');
    
//         Route::put('/{id}/edit', 'ProductController@update')->name('update');
    
//         Route::get('/{id}', 'ProductController@show')->name('show');
    
//         Route::get('/', 'ProductController@index')->name('index');

//     });
// });


// Route::middleware([])->group(function () {

//     Route::prefix('admin')->group(function () {

//         Route::namespace('Admin')->group(function () {

//             Route::name("admin.")->group(function () {
             
//                 Route::get('/dashboard', 'TesteController@teste')->name('dashboard');
        
//                 Route::get('/financeiro', 'TesteController@teste')->name('financeiro');
            
//                 Route::get('/produtos', 'TesteController@teste')->name('products');
        
//                 Route::get('/', function () {
//                     return redirect()->route('admin.dashboard');
//                 });

//             });

//         });
      
//     });
   
// });


Route::group([

    'middleware' => [],

    'prefix' => 'admin',

    'namespace' => 'Admin',

    // 'name' => 'admin.',

], function() {
    
    Route::name('admin.')->group(function () {
                Route::get('/dashboard', 'TesteController@teste')->name('dashboard');
        
                Route::get('/financeiro', 'TesteController@teste')->name('financeiro');
            
                Route::get('/produtos', 'TesteController@teste')->name('products');
        
                Route::get('/', function () {
                    return redirect()->route('admin.dashboard');
                });
    });
});

Route::get('/redirect3', function () {
    return redirect()->route('url.name');
});

Route::get('/name-url', function () {
    return 'Hey hey Heyy';
})->name('url.name');

Route::view('view', 'contato');

Route::redirect('redirect1', 'redirect2');

Route::get('redirect2' , function () {
    return "<h1> teste teste teste </h1>";
});

Route::get('/produtos/{idProduct?}', function ($idProduct = '') {
    return "Produto(s)" {$idProduct};
});

Route::get('/categoria/{flag}', function ($flag) {

    return "Produtos da categoria: {$flag}";

    dd($flag);
});

Route::match(['post'], '/match', function () {
    return 'match';
});

Route::any('/any', function () {
    return 'Any';
});

Route::post('/register', function () {
    return '';
});

Route::get('/empresa', function () {
    return view('site.empresa');
});

Route::get('/', function () {
    return 'welcome';
});

Route::get('/contato', function () {
    return view('contato');
});