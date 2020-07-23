<?php
Auth::routes(['verify' => true]);

Route::get('/', function () {
     return view('welcome');
    });
Route::get('/home', 'HomeController@index')->name('home');

//web
Route::get('productos', 'PageController@index')->name('index');
Route::get('producto/{slug}', 'PageController@product')->name('product');
Route::get('categoria/{slug}', 'PageController@category')->name('category');
Route::get('etiqueta/{slug}', 'PageController@tag')->name('tag');

// administrador del sistema
Route::middleware(['auth'])->group(function(){
    // roles
    Route::post('roles/store', 'RoleController@store')->name('roles.store')
        ->middleware('permission:roles.create');

    Route::get('roles', 'RoleController@index')->name('roles.index')
        ->middleware('permission:roles.index');

    Route::get('roles/create', 'RoleController@create')->name('roles.create')
        ->middleware('permission:roles.create');

    Route::put('roles/{role}', 'RoleController@update')->name('roles.update')
        ->middleware('permission:roles.edit');

    Route::get('roles/{role}', 'RoleController@show')->name('roles.show')
        ->middleware('permission:roles.show');

    Route::delete('roles/{role}', 'RoleController@destroy')->name('roles.destroy')
        ->middleware('permission:roles.destroy');

    Route::get('roles/{role}/edit', 'RoleController@edit')->name('roles.edit')
        ->middleware('permission:roles.edit');
    
     // Products
     Route::post('products/store', 'ProductController@store')->name('products.store')
     ->middleware('permission:products.create');

    Route::get('products', 'ProductController@index')->name('products.index')
        ->middleware('permission:products.index');

    Route::get('products/create', 'ProductController@create')->name('products.create')
        ->middleware('permission:products.create');

    Route::put('products/{product}', 'ProductController@update')->name('products.update')
        ->middleware('permission:products.edit');

    Route::get('products/{product}', 'ProductController@show')->name('products.show')
        ->middleware('permission:products.show');

    Route::delete('products/{product}', 'ProductController@destroy')->name('products.destroy')
        ->middleware('permission:products.destroy');

    Route::get('products/{product}/edit', 'ProductController@edit')->name('products.edit')
        ->middleware('permission:products.edit');

     // Users
    Route::get('users', 'UserController@index')->name('users.index')
        ->middleware('permission:users.index');

    Route::put('users/{user}', 'UserController@update')->name('users.update')
        ->middleware('permission:users.edit');

    Route::get('users/{user}', 'UserController@show')->name('users.show')
        ->middleware('permission:users.show');

    Route::delete('users/{user}', 'UserController@destroy')->name('users.destroy')
        ->middleware('permission:users.destroy');

    Route::get('users/{user}/edit', 'UserController@edit')->name('users.edit')
        ->middleware('permission:users.edit');

    //tags
    Route::post('tags',          'TagController@store')  ->name('tags.store')
            ->middleware('permission:products.create');

    Route::get('tags',           'TagController@index')  ->name('tags.index')
            ->middleware('permission:products.index');

    Route::get('tags/create',    'TagController@create') ->name('tags.create')
            ->middleware('permission:products.create');

    Route::get('tags/{tag}',     'TagController@show')   ->name('tags.show')
            ->middleware('permission:products.show');

    Route::put('tags/{tag}',     'TagController@update') ->name('tags.update')
            ->middleware('permission:products.edit');

    Route::delete('tags/{tag}',  'TagController@destroy')->name('tags.destroy')
            ->middleware('permission:products.destroy');

    Route::get('tags/{tag}/edit','TagController@edit')   ->name('tags.edit')
            ->middleware('permission:products.edit');
            
    //categorias
    Route::post('categories',               'CategoryController@store')  ->name('categories.store')
            ->middleware('permission:products.create');

    Route::get('categories',                'CategoryController@index')  ->name('categories.index')
            ->middleware('permission:products.index');

    Route::get('categories/create',         'CategoryController@create') ->name('categories.create')
            ->middleware('permission:products.create');

    Route::get('categories/{category}',     'CategoryController@show')   ->name('categories.show')
            ->middleware('permission:products.show');

    Route::put('categories/{category}',     'CategoryController@update') ->name('categories.update')
            ->middleware('permission:products.edit');

    Route::delete('categories/{category}',  'CategoryController@destroy')->name('categories.destroy')
            ->middleware('permission:products.destroy');

    Route::get('categories/{category}/edit','CategoryController@edit')   ->name('categories.edit')
            ->middleware('permission:products.edit');
    
});

//rutas de carrito
Route::get('carrito',            'CarShopController@index')  ->name('carshop')
->middleware('verified');
//añadir al carrito
Route::post('add/{product}','CarShopController@add')->name('carrito.add')
->middleware('verified');

Route::post('update','CarShopController@update')->name('carrito.update')
->middleware('verified');

Route::delete('compras/{cartDetail}','CarShopController@destroy')->name('carrito.delete');

// rutas de los pedidos
Route::post('order',             'CarShopController@order')  ->name('carrito.order')
->middleware('verified');

Route::get('pedidos',                       'PedidosController@pedidos')->name('pedidos')
  ->middleware('verified');

Route::get('admin/pedidos',                 'PedidosController@adminPedidos')->name('admin.pedidos')
  ->middleware('verified');

Route::post('cancelar',                     'PedidosController@cancelar')->name('cancelar')
  ->middleware('verified');

Route::post('entregado',                    'PedidosController@entregado')->name('entregado')
  ->middleware('verified');

Route::get('pedido/{cart}',               'PedidosController@pedido') ->name('pedido')
  ->middleware('verified');

Route::get('detalles/{pedido}/user/{user}','PedidosController@detalles')->name('detalles.pedido')
  ->middleware(['verified' , 'permission:products.index' ]);

  // perfil
Route::get('perfil',             'PerfilController@perfil')    ->name('perfil')
->middleware('verified');

Route::get('user/{user}/edit',   'PerfilController@editPerfil')->name('user.edit')
->middleware('verified');

Route::put('user/{user}',        'PerfilController@update')    ->name('user.update')
->middleware('verified');
