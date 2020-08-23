<?php

//Route::api('v1', function () {  
//});

Route::get('login/{social}', '\App\Http\Controllers\Auth\AuthController@redirectToProvider');
Route::get('login/{social}/callback', '\App\Http\Controllers\Auth\AuthController@handleProviderCallback');
Route::get('config/getConfig', '\App\Http\Controllers\Fontend\HomeController@getConfig');
Route::get('config/getInfo', '\App\Http\Controllers\Fontend\HomeController@getInfo');
Route::get('package/packagepriceexcel', '\App\Http\Controllers\Fontend\PackageController@packagepriceexcel');


Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {
   /* Route::get('/', function () {
        return redirect('admin/login');
    });*/
    /* Authentication Routes provided by Laravel */
    Route::get('/', 'DashboardController@index');
    /* Application Locale switch */
    Route::get('locale/{locale}', ['as' => 'locale.switch', 'uses' => 'LocaleController@switchLocale']);
    /* User / Member / Profile Routes */
    Route::get('members', 'ProfilesController@all');
    Route::get('members/show/{username}', 'ProfilesController@show');
    Route::get('members/order/{email}', 'MembersController@orders');
    Route::get('members/order/{email}/{status}', 'MembersController@orderstatus');
    Route::get('members/package/{email}', 'MembersController@packages');
    Route::get('members/package/{email}/{status}', 'MembersController@packagestatus');

    Route::get('members/banks', 'MembersController@bank');
    Route::get('members/address', 'MembersController@address');


    Route::post('members/address/create', 'MembersController@createaddress');
    Route::get('members/address/edit/{id}', 'MembersController@editaddress');
    Route::post('members/address/update/{id}', 'MembersController@updateaddress');
    Route::get('members/address/delete/{id}', 'MembersController@deleteaddress');

    Route::patch('profiles/{username}', 'ProfilesController@update');
    Route::post('profiles/{username}', 'ProfilesController@create');
    Route::delete('profiles/{username}', 'ProfilesController@delete');
    Route::get('profiles/{username}/create', 'ProfilesController@showCreateForm');

    Route::get('users', 'UsersController@all');
    Route::post('users', 'UsersController@create');
    Route::get('users/{username}', 'UsersController@getUser'); // for ajax request that populates the form
    Route::get('users/{username}/edit', 'UsersController@showUpdateUserForm');
    Route::patch('users/{username}', 'UsersController@update');
    Route::patch('users/{email}/verify', 'UsersController@verify');
    Route::patch('users/{username}/password', 'UsersController@changePassword');
    Route::delete('users/{username}', 'UsersController@delete');


    /* Cate Article routes */
    Route::post('cate/order', 'CateController@orders');
    Route::get('cate/{group}', 'CateController@show');
    Route::get('cate/create/{group}', 'CateController@create');
    Route::post('cate/create/{group}', 'CateController@postcreate');
    Route::get('cate/edit/{group}/{id}', 'CateController@showupdate');
    Route::patch('cate/update/{group}/{id}', 'CateController@update');
    Route::delete('cate/delete/{id}', 'CateController@delete');


    /* Article routes */
    Route::post('articles/order', 'ArticlesController@orders');
    Route::delete('article/files_delete', 'ArticlesController@files_delete');
    Route::get('articles/{group}', 'ArticlesController@show');
    Route::get('articles/create/{group}', 'ArticlesController@create');
    Route::post('articles/create/{group}', 'ArticlesController@postcreate');
    Route::get('articles/{group}/edit/{id}', 'ArticlesController@edit');
    Route::post('articles/{group}/edit/{id}', 'ArticlesController@postupdate');
    Route::delete('articles/delete/{id}', 'ArticlesController@delete');
    Route::get('articles/seach/{group}', 'ArticlesController@seach');


    /* Products routes */
    Route::get('products', 'ProductsController@index');

    Route::get('create/products', 'ProductsController@create');
    Route::post('products/create', 'ProductsController@postcreate');
    Route::post('products/aupdate/{id}/{price}/{quantity}','ProductsController@aupdate');
    Route::get('products/listdetail/{slug_name}','ProductsController@listdetail');
    Route::get('products/edit/{id}', 'ProductsController@edit');
    Route::post('products/update/{id}', 'ProductsController@postupdate');
    Route::delete('products/delete/{id}', 'ProductsController@delete');
    Route::delete('products/deleteall/{slug_name}', 'ProductsController@deleteall');
    Route::delete('products/ajax_images', 'ProductsController@ajax_images');
    Route::get('products/import', 'ProductsController@import');
    Route::post('products/import', 'ProductsController@postimport');
    Route::get('products/seach', 'ProductsController@seach');



    /* Tips routes */

    Route::get('tips', 'TipHomeController@index');
    Route::get('tips/create', 'TipHomeController@create');
    Route::post('tips/create', 'TipHomeController@postcreate');
    Route::post('tips/order', 'TipHomeController@orders');
    Route::get('tips/edit/{id}', 'TipHomeController@edit');
    Route::post('tips/edit/{id}', 'TipHomeController@postupdate');
    Route::get('tips/delete/{id}', 'TipHomeController@delete');

    /* Content Website */
    Route::get('content', 'ContentController@index');
    Route::get('content/create', 'ContentController@create');
    Route::post('content/create', 'ContentController@postcreate');
    Route::post('content/order', 'ContentController@orders');
    Route::get('content/edit/{id}', 'ContentController@edit');
    Route::post('content/edit/{id}', 'ContentController@postupdate');
    Route::get('content/delete/{id}', 'ContentController@delete');

    /* Supper Menus routes */
    Route::post('menus/orders', 'SupperMenusController@orders');
    Route::get('menus/{code}', 'SupperMenusController@index');
    Route::get('menus/{code}/create', 'SupperMenusController@create');
    Route::post('menus/{id}', 'SupperMenusController@GetType');
    Route::post('menus/{code}/create', 'SupperMenusController@postcreate');
    Route::get('menus/{code}/edit/{id}', 'SupperMenusController@edit');
    Route::post('menus/{code}/edit/{id}', 'SupperMenusController@postupdate');
    Route::delete('menus/delete/{id}', 'SupperMenusController@delete');


    /* Coupons routes */
    Route::get('coupons', 'CouponsController@index');
    Route::post('coupons/create', 'CouponsController@postcreate');
    Route::get('coupons/edit/{id}', 'CouponsController@edit');
    Route::post('coupons/edit/{id}', 'CouponsController@postupdate');
    Route::delete('coupons/delete/{id}', 'CouponsController@delete');


    /* Groups Products routes */
    Route::get('groupproducts', 'GroupproductsController@index');
    Route::post('groupproducts/create', 'GroupproductsController@postcreate');
    Route::get('groupproducts/edit/{id}', 'GroupproductsController@edit');
    Route::post('groupproducts/edit/{id}', 'GroupproductsController@postupdate');
    Route::delete('groupproducts/delete/{id}', 'GroupproductsController@delete');


    /* Properties routes */
    Route::get('properties', 'PropertiesController@index');
    Route::get('create/properties', 'PropertiesController@create');
    Route::post('properties/create', 'PropertiesController@postcreate');
    Route::post('properties/create/cates', 'PropertiesController@postcreatecates');
    Route::get('properties/edit/{id}', 'PropertiesController@edit');
    Route::post('properties/edit/{id}', 'PropertiesController@postupdate');
    Route::get('properties/delete/{id}', 'PropertiesController@delete');

    /* User level routes */
    Route::get('userlevel', 'UserlevelController@index');
    Route::get('create/userlevel', 'UserlevelController@create');
    Route::post('userlevel/create', 'UserlevelController@postcreate');
    Route::post('userlevel/create/cates', 'UserlevelController@postcreatecates');
    Route::get('userlevel/edit/{id}', 'UserlevelController@edit');
    Route::post('userlevel/edit/{id}', 'UserlevelController@postupdate');
    Route::get('userlevel/delete/{id}', 'UserlevelController@delete');

    /* Support level routes */
    Route::get('support', 'SupportController@index');
    Route::get('create/support', 'SupportController@create');
    Route::post('support/create', 'SupportController@postcreate');
    Route::post('support/create/cates', 'SupportController@postcreatecates');
    Route::get('support/edit/{id}', 'SupportController@edit');
    Route::post('support/edit/{id}', 'SupportController@postupdate');
    Route::get('support/delete/{id}', 'SupportController@delete');

    /* Customers level routes */

    Route::get('exportcustomer/{level}', 'CustomersController@exportCustomer');
    Route::get('customer', 'CustomersController@all');
    Route::get('customer/{level}', 'CustomersController@level');
    Route::post('customer/create', 'CustomersController@create');
    Route::post('movelevel/customer/{id}', 'CustomersController@movelevel');


    /* Report level routes */

    Route::get('report/online', 'ReportsController@online');
    Route::post('report/orderexcel', 'ReportsController@orderexcel');

    /* Units level routes */
    Route::get('units', 'UnitsController@index');
    Route::get('create/units', 'UnitsController@create');
    Route::post('units/create', 'UnitsController@postcreate');
    Route::get('units/edit/{id}', 'UnitsController@edit');
    Route::post('units/edit/{id}', 'UnitsController@postupdate');
    Route::get('units/delete/{id}', 'UnitsController@delete');


    /* Currency level routes */
    Route::get('currency', 'CurrencyController@index');
    Route::get('create/currency', 'CurrencyController@create');
    Route::post('currency/create', 'CurrencyController@postcreate');
    Route::get('currency/edit/{id}', 'CurrencyController@edit');
    Route::post('currency/edit/{id}', 'CurrencyController@postupdate');
    Route::get('currency/delete/{id}', 'CurrencyController@delete');


    /* Notification level routes */
    Route::post('notification/edit/{id}', 'NotificationController@postupdate');
    Route::get('notification/delete/{id}', 'NotificationController@delete');
    Route::get('notification/{group}/{code}', 'NotificationController@index');
    Route::get('notification/{group}/{code}/edit/{id}', 'NotificationController@edit');
    Route::post('notification/create/{group}/{code}', 'NotificationController@postcreate');


    Route::post('send/notification/{id}', 'NotificationController@send');

    /* Sendemails level routes */
    Route::get('sendemails/exportemail/{status}', 'SendemailsController@exportEmail');
    Route::get('sendemails/listregister', 'SendemailsController@listregister');
    Route::get('registeremails/delete/{id}', 'SendemailsController@deleteemail');
    Route::get('registeremails/seach', 'SendemailsController@seachemail');
    Route::get('sendemails/{code}', 'SendemailsController@index');
    Route::get('sendemails/edit/{id}', 'SendemailsController@edit');
    Route::post('sendemails/create/{code}', 'SendemailsController@postcreate');
    Route::post('sendemails/edit/{id}', 'SendemailsController@postupdate');
    Route::get('sendemails/delete/{id}', 'SendemailsController@delete');


    /* Feedback l routes */
    Route::get('feedback', 'FeedbackController@index');
    Route::get('feedback/view/{id}', 'FeedbackController@view');
    Route::post('feedback/reply', 'FeedbackController@postReply');
    Route::get('feedback/delete/{id}', 'FeedbackController@delete');
    Route::get('feedback/status/{code}', 'FeedbackController@status');

    /* Imgaes routes */
    Route::post('images/order', 'ImagesController@orders');
    Route::get('images', 'ImagesController@index');
    Route::get('create/images', 'ImagesController@create');
    Route::post('images/create', 'ImagesController@postcreate');
    Route::get('images/edit/{id}', 'ImagesController@edit');
    Route::post('images/edit/{id}', 'ImagesController@postupdate');
    Route::get('images/delete/{id}', 'ImagesController@delete');
    Route::get('images/seach', 'ImagesController@seach');

    /* Crawler routes */
    Route::get('crawler', 'CrawlerController@index');
    Route::get('create/crawler', 'CrawlerController@create');
    Route::post('crawler/create', 'CrawlerController@postcreate');
    Route::get('crawler/edit/{id}', 'CrawlerController@edit');
    Route::post('crawler/edit/{id}', 'CrawlerController@postupdate');
    Route::get('crawler/delete/{id}', 'CrawlerController@delete');
    /* Order routes */
    Route::get('order/{type}','OrdersController@type');
    Route::get('order/{type}/{status}','OrdersController@status');
    Route::post('movestatus/order/{id}','OrdersController@movestatus');
    Route::get('delete/order/{id}','OrdersController@delete');
    Route::post('seach/order','OrdersController@seach');
    Route::get('view/order/{id}','OrdersController@detail');


    /* Complaints routes */
    Route::get('complaint', 'ComplaintsController@index');
    Route::get('complaint/{status}', 'ComplaintsController@status');
    Route::get('view/complaint/{id}', 'ComplaintsController@view');
    Route::get('complaint/view/{id}', 'ComplaintsController@view');
    Route::post('movestatus/complaint/{id}', 'ComplaintsController@movestatus');
    Route::get('delete/complaint/{id}', 'ComplaintsController@delete');
    Route::post('seach/complaint', 'ComplaintsController@seach');
    Route::get('complaint/changestatus', 'ComplaintsController@changestatus');

    /* Application settings routes */
    Route::get('settings', function () {
        return redirect('/');
    });
    Route::get('settings/general', ['as' => 'settings.general', 'uses' => 'SettingsController@showGeneralSettingsForm']);
    Route::get('settings/data', ['as' => 'settings.data', 'uses' => 'SettingsController@showdataSettingsForm']);
    Route::patch('settings/general', 'SettingsController@updateGeneralSettings');
    Route::patch('settings/fontendgeneral', 'SettingsController@updateGeneralSettings');
    Route::get('settings/emails', ['as' => 'settings.emails', 'uses' => 'EmailTemplatesController@showEmailTemplatesForm']);
    Route::patch('settings/emails/{templateId}', 'EmailTemplatesController@update');
    Route::post('settings/emails/{templateId}/translate', 'EmailTemplatesController@translate');

    /* Menus routes */
    Route::get('settings/menus', 'MenusController@show');
    Route::get('settings/menus/{menuId}', 'MenusController@getMenu'); // for ajax request that populates the form
    Route::post('settings/menus', ['as' => 'menus.create', 'uses' => 'MenusController@create']);
    Route::patch('settings/menus/{menuId}', 'MenusController@update');
    Route::delete('settings/menus/{menuId}', 'MenusController@delete');
    Route::post('settings/menus/{menuId}/translate', 'MenusController@translate');

    Route::get('roles', 'RolesController@show');
    Route::post('roles', 'RolesController@create');
    Route::get('roles/{roleId}', 'RolesController@getRole');
    Route::patch('roles/{roleId}', 'RolesController@update');
    Route::delete('roles/{roleId}', 'RolesController@delete');

    Route::get('roles/user/{username}', 'RolesController@getUserRoles'); // for ajax request that populates the form
    Route::post('roles/user/{username}', 'RolesController@updateUserRoles'); // to update roles for a single username

    Route::get('permissions', 'PermissionsController@showPermissionsForm');
    Route::get('permissions/{permissionId}', 'PermissionsController@getPermission');
    Route::patch('permissions/{permissionId}', 'PermissionsController@updateSinglePermission');
    Route::patch('permissions', 'PermissionsController@update');
    Route::get('modules', 'ModulesController@all');

    Route::get('filemanager/show', 'FilemanagerLaravelController@getShow');
    Route::get('filemanager/connectors', 'FilemanagerLaravelController@getConnectors');
    Route::post('filemanager/connectors', 'FilemanagerLaravelController@postConnectors');


    /* Ajax routes */
    Route::post('urlcategories', 'AjaxController@urlcategories');
    Route::post('cateforproperty', 'AjaxController@cateforproperty');
    Route::post('urlarticles', 'AjaxController@urlarticles');
    Route::post('urlgroups', 'AjaxController@urlgroups');

    Route::post('editcouponscate', 'AjaxController@editcouponscate');
    Route::post('editurlproducts', 'AjaxController@editurlproducts');

    Route::post('editgroupscate', 'AjaxController@editgroupscate');
    Route::post('editgroupsproducts', 'AjaxController@editgroupsproducts');
});
Route::group(['prefix' => 'admin'], function () {
    Route::auth();
    /* Email Confirmation Routes */
    Route::get('login/confirm/{email_token}', 'Auth\AuthController@confirmEmail');
    Route::get('login/confirm', function () {
        return redirect('admin/login');
    });
});

/* Welcome landing page*/
Route::group(['prefix' => '/','namespace' => 'Fontend'], function () {
    Route::get('/', 'HomeController@index');
    Route::get('successorder','HomeController@successorder');

    /* San Pham */
    Route::get('san-pham/{slug}/{group}','ProductsController@groups')->where(['slug' => '[a-zA-Z0-9-]+']);
    Route::get('san-pham/{slug}','ProductsController@category')->where(['slug' => '[a-zA-Z0-9-]+']);
    Route::get('san-pham/{slug}.html','ProductsController@detail')->where(['slug' => '[a-zA-Z0-9-]+']);
    Route::get('nhom-san-pham/{slug}','ProductsController@groupproductss')->where(['slug' => '[a-zA-Z0-9-]+']);

    Route::get('lienhe.html','HomeController@lienhe');
    Route::get('gioithieu.html','HomeController@gioithieu');
    Route::get('seach/text','SeachController@fulltext');
    Route::get('members/show/{username}', 'MembersController@show');
    Route::get('members/orders/{username}', 'MembersController@orders');

    /* Gio hang */
    Route::get('cart','CartController@index');
    Route::post('addcart','CartController@addcart');
    Route::post('addsize','CartController@addsize');
    Route::post('cart/deleteitem','CartController@deleteitem');
    Route::post('cart/updateitem','CartController@updateitem');
    Route::post('coupons','CouponsController@coupons');
    Route::post('cancercoupons','CouponsController@cancercoupons');

    Route::post('member/register','MembersController@postregister');
    Route::post('member/forgotpassword','MembersController@postgetpassword');
    Route::post('member/changepass','MembersController@postchangepass');

    Route::get('members/orders','MembersController@orders');
    Route::get('members/show','MembersController@show');
    Route::post('members/update','MembersController@postupdate');

    Route::post('order','OrdersController@postorder');

    Route::get('checkout','CartController@checkout');

    Route::post('emails', 'HomeController@emails');

    Route::get('{group}','ArticlesController@list_articles');
    Route::get('{group}/{slug}','ArticlesController@detail');


});




