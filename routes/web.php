<?php


// Route::get('/category/show', 'Admin\Category\CategoryController@index');







Route::get('/','Layout\FrontController@index')->name('logout');

Route::get('/verify','Auth\SendOtpCodeController@index')->name('getverify');
Route::post('/verify','Auth\SendOtpCodeController@postVerify')->name('verify');

//Pavilion 
Route::get('/pavilion','Layout\PavilionController@index');
Route::get('/pavilion/country/show/{country_id}','Layout\PavilionController@show')->name('pavilion.country.show');
Route::get('/helpline','Layout\AboutController@helpline')->name('helpline');

//Single and count & quick
Route::resource('/single-product','Layout\SingleProductController');
Route::resource('/count','Layout\CountDownController');
Route::get('/quick/view/{product_id}','Layout\SingleProductController@quickview')->name('quick.view');
Route::get('/live_search/action', 'Layout\SingleProductController@action')->name('live_search.action');

//pop,renent,cat,abt,contact
Route::get('/popular','Layout\FrontController@popular')->name('front.popular');
Route::get('/recent','Layout\FrontController@recent')->name('front.recent');
Route::get('/special','Layout\FrontController@special')->name('front.special');
Route::get('/category/{category_id}','Layout\CategoryController@category')->name('front.category');
Route::get('/about','Layout\AboutController@about')->name('front.about');
Route::get('/contact','Layout\AboutController@contact')->name('front.contact');


//Terms & Condition
Route::get('/condition','Layout\TermsAndConditionController@condition')->name('condition');
Route::get('/payment/condition','Layout\TermsAndConditionController@paymentcondition')->name('payment.condition');
Route::get('/policy','Layout\TermsAndConditionController@policy')->name('policy');
Route::post('/subscribe','Layout\SubscriberController@subscribe')->name('subscribe');
Route::get('/moneyback','Layout\TermsAndConditionController@moneyback');
Route::get('/how/to/order','Layout\TermsAndConditionController@howToOrder');

//Rating
// Route::resource('/rating','Layout\RatingController');
// Route::post('/rating/show','Layout\RatingController@show');

//faq,map,banner
Route::resource('/blog','Layout\BlogController');
Route::get('/faq','Layout\AboutController@faq')->name('front.faq');
Route::get('/sitemap','Layout\AboutController@sitemap')->name('front.sitemap');
Route::get('/banner','Layout\AboutController@banner')->name('front.banner');

// all about cart
Route::resource('/cart','Layout\Cart\CartController');
Route::get('/cart/add/item/{id}','Layout\Cart\CartController@addItem')->name('cart.addItem'); 
Route::get('/cart/revome/item/{id}','Layout\Cart\CartController@destroy')->name('cart.remove');
//notification
Route::get('/markAsRead', function(){
auth()->user()->unreadNotifications->markAsRead();
});




//temporary
Route::get('/temporary','Layout\FrontController@temporary')->name('temporary');
Route::get('/comming/soon','Layout\CountDownController@commingsoon')->name('coming.soon');

Auth::routes();
Route::get('/verifyEmailFirst', 'Auth\RegisterController@verifyEmailFirst')->name('verifyEmailFirst');//verife page 
Route::get('/sentEmailVerifying/{email}/{verifyToken}','Auth\RegisterController@sentEmailVerifying')->name('sentEmailVerifying');//by clicking on gmail link
Route::get('/resend/verifyEmailFirst/{thisUser}', 'Auth\RegisterController@sendEmail')->name('verification.resend');
Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('admin')->group(function(){
    Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
    Route::get('/', 'Admin\AdminController@index')->name('admin.dashboard');
    Route::post('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');
    Route::get('/password/reset', 'Auth\AdminForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
    Route::post('/password/email', 'Auth\AdminForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
    Route::get('/password/reset/{token}', 'Auth\AdminResetPasswordController@showResetForm')->name('admin.password.reset');
    Route::post('/password/reset', 'Auth\AdminResetPasswordController@reset')->name('admin.password.update');
});



Route::group(['prefix'=>'admin','middleware'=>['admin']],function(){
    Route::resource('/user','Admin\Layouts\UserController');
    Route::resource('/membership','Admin\Layouts\MemberShipController');
    Route::resource('/product','Admin\Layouts\ProductController');
    Route::resource('/slide','Admin\Layouts\SlideController');
    Route::resource('/category','Admin\Layouts\CategoryController');
    Route::resource('/color','Admin\Layouts\ColorController');
    Route::resource('/review','Admin\Layouts\ReviewController');
    Route::resource('/video','Admin\Layouts\VideoController');
    Route::resource('/country','Admin\Layouts\CountryController');

//Product
    Route::post('/product/update/{id}','Admin\Layouts\ProductController@update');
    Route::get('/admin/product/image/edit/{id}','Admin\Layouts\ProductController@editpdtimg');
    Route::post('/admin/product/image/update/{id}','Admin\Layouts\ProductController@updatepdtimg');
//category update
    Route::post('/category/update/{id}','Admin\Layouts\CategoryController@update');
//country
    Route::post('/country/update/{id}','Admin\Layouts\CountryController@update');
    
    Route::get('/city','Admin\Layouts\CountryController@city');
    Route::get('/city/{id}/edit','Admin\Layouts\CountryController@cityEdit');
    Route::post('/city/store','Admin\Layouts\CountryController@cityStore');
    Route::post('/city/update/{id}','Admin\Layouts\CountryController@cityUpdate');
    Route::get('/city/delete/{id}','Admin\Layouts\CountryController@cityDelete');
        
    Route::get('/district','Admin\Layouts\CountryController@district');
    Route::get('/district/{id}/edit','Admin\Layouts\CountryController@city');
    Route::post('/district/store','Admin\Layouts\CountryController@districtStore');
    Route::post('/district/update1/{id}','Admin\Layouts\CountryController@districtUpdate');
    Route::get('/district/delete/{id}','Admin\Layouts\CountryController@districtDelete');
    
    Route::get('/area','Admin\Layouts\CountryController@area');
    Route::get('/area/{id}/edit','Admin\Layouts\CountryController@city');
    Route::post('/area/store','Admin\Layouts\CountryController@areaStore');
    Route::post('/area/update/{city_id}','Admin\Layouts\CountryController@areaUpdate');
    Route::get('/area/delete/{city_id}','Admin\Layouts\CountryController@areaDelete');

//delete
    Route::post('/user/delete','Admin\Layouts\UserController@delete');
    Route::get('/product/delete/{id}','Admin\Layouts\ProductController@delete');
    Route::get('/slide/delete/{slide_id}','Admin\Layouts\SlideController@delete');
    Route::get('/status/update/{id}','Admin\Layouts\ProductController@status');
    Route::get('/membership/status/update/{id}','Admin\Layouts\MemberShipController@status');
    Route::post('/membership/delete','Admin\Layouts\MemberShipController@delete');
    Route::get('/category/delete/{id}','Admin\Layouts\CategoryController@delete');
    Route::post('/color/delete','Admin\Layouts\ColorController@delete');
    Route::post('/review/delete','Admin\Layouts\ReviewController@review');
//order
    Route::get('/orders/{type?}','Admin\Layouts\Order\OrderController@Orders');
    Route::post('/toggle/delivered/{id}','Admin\Layouts\Order\OrderController@toggleDelivered');  
    Route::post('/order/delete/{order_id}','Admin\Layouts\Order\OrderController@Delete');   
});   




Route::group(['prefix'=>'user','middleware'=>['auth']],function(){
	Route::resource('/product','Layouts\ProductController');
    Route::resource('/user','Layouts\UserController');
    Route::resource('/membership','Layouts\MemberShipController');

    Route::post('product/update/{id}','Layouts\ProductController@updates');
    Route::get('/product/image/edit/{id}','Layouts\ProductController@editproductimage');
    Route::post('/product/image/update/{id}','Layouts\ProductController@updateproductimage');
    Route::post('/review/item/{id}','Layouts\ReviewController@ProductReview');

    Route::get('/orders/{type?}','Layouts\Order\OrderController@Orders');
    Route::post('/user/cover/photo/update/{id}','Layouts\UserController@updatecoverphoto');
    Route::post('/crop-image','Layouts\UserController@uploadImage');
});




Route::group(['prefix'=>'product','middleware'=>['auth']], function () {
  Route::get('/shipping/info','Layout\Cart\CartController@shipping')->name('product.shipping');
  Route::post('/shippinginfo/store','Layout\Cart\CartController@store')->name('shippinginfo.store');
  Route::get('/payment/method','Layout\Cart\CartController@PaymentMethod')->name('payment.method');
  Route::post('/card/payment/store','Layout\Cart\CartController@CardPaymentStore')->name('payment.card.store');
  Route::post('/bkas/payment/store','Layout\Cart\CartController@BkashPaymentStore')->name('payment.bkash.store');
  Route::post('/handcash/payment/store','Layout\Cart\CartController@HandCashPaymentStore')->name('payment.handcash.store');
  Route::post('/transaction/no/{order_id}','Layout\Cart\CartController@TransactionNo')->name('payment.transation_no.update');
  Route::get('/confirm/order','Layout\Cart\CartController@ConfirmOrder');
  Route::post('/confirm/order','Layout\Cart\CartController@ConfirmOrder')->name('confirm.order');
  Route::get('/thank/to','Layout\Cart\CartController@ThankTo');

});






Route::get('/cities','Layout\CascadeDropdownController@show');
Route::get('/codes','Layout\CascadeDropdownController@codeShow');
Route::get('/districts','Layout\CascadeDropdownController@districtShow');
Route::get('/areas','Layout\CascadeDropdownController@areasShow');



