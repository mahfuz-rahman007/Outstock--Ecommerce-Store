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


Route::group(['middleware' => 'setlang'], function(){

    Route::get('/', 'Front\FrontController@index')->name('front.index');

    // Language Change Route
    Route::get('/changelanguage/{lang}', 'Front\FrontController@changeLanguage')->name('changeLanguage');
    // Currency Change Route
    Route::get('/changecurrency/{currId}', 'Front\FrontController@changeCurrency')->name('changeCurrency');

    // Shop Page & product details page
    Route::get('/shop','Front\ProductController@products')->name('front.products');
    Route::get('/product/product-details/{slug}','Front\ProductController@product_details')->name('front.product_details');

    // product ratting & review comment
    Route::post('/review/submit/{id}','Front\ProductReviewController@review')->name('front.product.review');
    Route::get('cart/qty/get/ajax', 'Front\ProductController@cartQtyGet')->name('cart.qty.get'); // Product quantity
    Route::get('/cart','Front\ProductController@cart')->name('front.cart'); // cart page route
    Route::get('/cart/header/load/','Front\ProductController@headerCartLoad')->name('cart.header.load'); // header cart load
    Route::get('/add-to-cart/{id}','Front\ProductController@addToCart')->name('front.product.add_cart'); // Add to cart
    Route::get('/cart/item/remove/{id}', 'Front\ProductController@cartItemRemove')->name('cart.item.remove'); // Remove cart
    Route::post('/cart/update/', 'Front\ProductController@cartUpdate')->name('cart.update'); // Update Cart


    // wishlist
    Route::get('/add-wishlist/{slug}','Front\ProductController@addWishlist')->name('front.product.add.wishlist'); // Add to wishlist
    Route::get('/wishlist','Front\ProductController@wishlist')->name('front.wishlist'); // Add to wishlist
    Route::get('/remove-wishlist/{slug}','Front\ProductController@removeWishlist')->name('front.product.remove.wishlist'); // Add to wishlist

    // Checkout Routes
    // checkout page
    Route::get('/checkout','Front\ProductController@checkout')->name('front.checkout');
    Route::get('/product/checkout/{slug}','Front\ProductController@productCheckout')->name('front.product.checkout');

    // paypal routes
    Route::post('/paypal/submit/', 'Payment\Product\PaypalController@submit')->name('product.paypal.submit');
    Route::get('/product/order/paypal/cancle', 'Payment\Product\PaypalController@paycancle')->name('product.paypal.cancle');
    Route::get('/product/paypal/return', 'Payment\Product\PaypalController@payreturn')->name('product.paypal.return');
    Route::get('/product/paypal/notify', 'Payment\Product\PaypalController@notify')->name('product.paypal.notify');

    // stripe routes
    Route::post('/stripe/submit/', 'Payment\Product\StripeController@submit')->name('product.stripe.submit');

    // cash on delivery routes
    Route::post('/cash-on-delivery/submit/', 'Payment\Product\CashOnDeliveryController@submit')->name('product.cash_on_delivery.submit');

    // Contact page & submit page Route
    Route::get('/contact','Front\FrontController@contact')->name('front.contact');
    Route::post('/contact/submit','Front\FrontController@contactSubmit')->name('front.contact.submit');

    // Newsletter Route
    Route::post('/newsletter','Admin\NewsletterController@store')->name('front.newsletter.store');

    Route::group(['prefix'=> 'user'], function(){

        Route::get('/login', 'User\LoginController@showLogin')->name('user.login');
        Route::post('/login/submit', 'User\LoginController@login')->name('user.login.submit');


        Route::get('/register', 'User\RegisterController@showRegister')->name('user.register');
        Route::post('/register/submit', 'User\RegisterController@register')->name('user.register.submit');
        Route::get('/register/verify/{token}', 'User\RegisterController@token')->name('user.register.token');

    });

    Route::group(['prefix'=> 'user' , 'middleware'=>'auth:web'], function(){

        Route::get('/dashboard', 'User\UserController@dashboard')->name('user.dashboard');
        Route::get('/edit-profile', 'User\UserController@editProfile')->name('user.editProfile');
        Route::post('/update-profile/{id}', 'User\UserController@updateProfile')->name('user.updateProfile');

        Route::get('/change-password', 'User\UserController@changePassword')->name('user.changePassword');
        Route::post('/update-password/{id}', 'User\UserController@updatePassword')->name('user.updatePassword');

        // product order route
        Route::get('/product-orders', 'User\UserController@product_order')->name('user.product.order');
        Route::get('/order/details/{id}', 'User\UserController@orderDetails')->name('user.order.details');

        Route::get('/logout', 'User\UserController@logout')->name('user.logout');

    });


});

Route::group(['prefix' => 'admin', 'middleware' => 'guest:admin'], function () {

    Route::get('/', 'Admin\LoginController@login')->name('admin.login');
    Route::post('/login', 'Admin\LoginController@authenticate')->name('admin.auth');
});

Route::group(['prefix' => 'admin', 'middleware' => 'auth:admin'], function () {

    Route::get('/logout', 'Admin\LoginController@logout')->name('admin.logout');
    Route::get('/dashboard', 'Admin\DashboardController@dashboard')->name('admin.dashboard');

    // Admin Profile Routs
    Route::get('/profile/edit', 'Admin\ProfileController@editProfile')->name('admin.editProfile');
    Route::post('/profile/update', 'Admin\ProfileController@updateProfile')->name('admin.updateProfile');
    Route::get('/profile/password/edit', 'Admin\ProfileController@editPassword')->name('admin.editPassword');
    Route::post('/profile/password/update', 'Admin\ProfileController@updatePassword')->name('admin.updatePassword');


    // Setting Routes

    // Basic Information
    Route::get('/basicinfo', 'Admin\SettingController@basicinfo')->name('admin.setting.basicinfo');
    Route::post('/basicinfo/update/{id}', 'Admin\SettingController@updateBasicinfo')->name('admin.setting.updateBasicinfo');
    Route::post('/commoninfo/update', 'Admin\SettingController@updateCommoninfo')->name('admin.setting.updateCommoninfo');

    // ADMIN EMAIL SETTINGS SECTION
    Route::get('/email-config', 'Admin\EmailsettingController@config')->name('admin.mail.config');
    Route::post('/email-config/submit', 'Admin\EmailsettingController@configUpdate')->name('admin.mail.config.update');

    // Social Links
    Route::get('/slinks', 'Admin\SocialController@slinks')->name('admin.Slinks');
    Route::post('/slinks/store', 'Admin\SocialController@storeSlinks')->name('admin.storeSlinks');
    Route::get('/slinks/edit/{id}', 'Admin\SocialController@editSlinks')->name('admin.editSlinks');
    Route::post('/slinks/update/{id}', 'Admin\SocialController@updateSlinks')->name('admin.updateSlinks');
    Route::post('/slinks/delete/{id}', 'Admin\SocialController@deleteSlinks')->name('admin.deleteSlinks');

    //Section Title
    Route::get('/sectiontitle' , 'Admin\SettingController@sectiontitle')->name('admin.sectiontitle');
    Route::post('/sectiontitle/update/{id}' , 'Admin\SettingController@updateSectiontitle')->name('admin.updateSectiontitle');


    // Seo Info Routes
    Route::get('/seoinfo', 'Admin\SettingController@seoinfo')->name('admin.seoinfo');
    Route::post('/seoinfo/update/{id}', 'Admin\SettingController@updateSeoinfo')->name('admin.updateSeoinfo');

    // Scripts Routes
    Route::get('/scripts', 'Admin\SettingController@scripts')->name('admin.scripts');
    Route::post('/scripts/update', 'Admin\SettingController@updateScript')->name('admin.updateScript');

    // page Visibility
    Route::get('/page-visibility', 'Admin\SettingController@pagevisibility')->name('admin.pagevisibility');
    Route::post('/page-visibility/update', 'Admin\SettingController@updatePagevisibility')->name('admin.updatePagevisibility');

    // Cookie Alert
    Route::get('/cookie-alert', 'Admin\SettingController@cookiealert')->name('admin.cookiealert');
    Route::post('/cookie-alert/update/{id}', 'Admin\SettingController@updateCookiealert')->name('admin.updateCookiealert');

    // Cusstom Css Routes
    Route::get('/custom-css', 'Admin\SettingController@customcss')->name('admin.customcss');
    Route::post('/custom-css/update', 'Admin\SettingController@updateCustomcss')->name('admin.updateCustomcss');

    // Hero Slider Version
    Route::get('/slider', 'Admin\SliderController@slider')->name('admin.slider');
    Route::get('/slider/add', 'Admin\SliderController@add')->name('admin.slider.add');
    Route::post('/slider/store', 'Admin\SliderController@store')->name('admin.slider.store');
    Route::post('/slider/delete/{id}/', 'Admin\SliderController@delete')->name('admin.slider.delete');
    Route::get('/slider/edit/{id}/', 'Admin\SliderController@edit')->name('admin.slider.edit');
    Route::post('/slider/update/{id}/', 'Admin\SliderController@update')->name('admin.slider.update');

    // E-Banner Routes
    Route::get('/ebanner', 'Admin\EbannerController@ebanner')->name('admin.ebanner');
    Route::get('/ebanner/add', 'Admin\EbannerController@add')->name('admin.ebanner.add');
    Route::post('/ebanner/store', 'Admin\EbannerController@store')->name('admin.ebanner.store');
    Route::post('/ebanner/delete/{id}/', 'Admin\EbannerController@delete')->name('admin.ebanner.delete');
    Route::get('/ebanner/edit/{id}/', 'Admin\EbannerController@edit')->name('admin.ebanner.edit');
    Route::post('/ebanner/update/{id}/', 'Admin\EbannerController@update')->name('admin.ebanner.update');

    // Currency  Route
    Route::get('/currency', 'Admin\CurrencyController@currency')->name('admin.currency');
    Route::get('/currency/add', 'Admin\CurrencyController@add')->name('admin.currency.add');
    Route::post('/currency/store', 'Admin\CurrencyController@store')->name('admin.currency.store');
    Route::post('/currency/delete/{id}/', 'Admin\CurrencyController@delete')->name('admin.currency.delete');
    Route::get('/currency/edit/{id}/', 'Admin\CurrencyController@edit')->name('admin.currency.edit');
    Route::post('/currency/update/{id}/', 'Admin\CurrencyController@update')->name('admin.currency.update');
    Route::get('/currency/status/set/{id}', 'Admin\CurrencyController@status')->name('admin.currency.status');

    // Payment Settings Route
    Route::get('/payment/gateways', 'Admin\PaymentGatewayController@index')->name('admin.payment');
    Route::get('/payment/gateways/edit/{id}', 'Admin\PaymentGatewayController@edit')->name('admin.payment.edit');
    Route::post('/payment/gateways/update/{id}', 'Admin\PaymentGatewayController@update')->name('admin.payment.update');
    Route::get('/payment/gateways/{delete}', 'Admin\PaymentGatewayController@delete')->name('admin.payment.delete');

    // Shipping Method  Route
    Route::get('/shipping/methods/', 'Admin\ShippingController@shipping')->name('admin.shipping');
    Route::get('/shipping/method/add', 'Admin\ShippingController@add')->name('admin.shipping.add');
    Route::post('/shipping/method/store', 'Admin\ShippingController@store')->name('admin.shipping.store');
    Route::post('/shipping/method/delete/{id}/', 'Admin\ShippingController@delete')->name('admin.shipping.delete');
    Route::get('/shipping/method/edit/{id}/', 'Admin\ShippingController@edit')->name('admin.shipping.edit');
    Route::post('/shipping/method/update/{id}/', 'Admin\ShippingController@update')->name('admin.shipping.update');
    Route::get('/shipping/method/status/set/{id}', 'Admin\ShippingController@status')->name('admin.shipping.status');

    // Message Section
    Route::get('/messages', 'Admin\MessageController@message')->name('admin.message');
    Route::get('/message/send/{id}', 'Admin\MessageController@send')->name('admin.message.send');
    Route::post('/message/delete/{id}', 'Admin\MessageController@delete')->name('admin.message.delete');

    // Newsletter Route
    Route::get('/subscriber', 'Admin\NewsletterController@newsletter')->name('admin.newsletter');
    Route::get('/mailsubscriber', 'Admin\NewsletterController@mailsubscriber')->name('admin.mailsubscriber');
    Route::post('/subscribers/sendmail', 'Admin\NewsletterController@subscsendmail')->name('admin.subscribers.sendmail');

    Route::get('/subscriber/add', 'Admin\NewsletterController@add')->name('admin.newsletter.add');
    Route::post('/subscriber/store', 'Admin\NewsletterController@store')->name('admin.newsletter.store');
    Route::post('/subscriber/delete/{id}/', 'Admin\NewsletterController@delete')->name('admin.newsletter.delete');
    Route::get('/subscriber/edit/{id}/', 'Admin\NewsletterController@edit')->name('admin.newsletter.edit');
    Route::post('/subscriber/update/{id}/', 'Admin\NewsletterController@update')->name('admin.newsletter.update');

    // Home Clients Section
    Route::get('/client', 'Admin\ClientController@client')->name('admin.client');
    Route::get('/client/add', 'Admin\ClientController@add')->name('admin.client.add');
    Route::post('/client/store', 'Admin\ClientController@store')->name('admin.client.store');
    Route::post('/client/delete/{id}/', 'Admin\ClientController@delete')->name('admin.client.delete');
    Route::get('/client/edit/{id}/', 'Admin\ClientController@edit')->name('admin.client.edit');
    Route::post('/client/update/{id}/', 'Admin\ClientController@update')->name('admin.client.update');

    // Product Category Routes
    Route::get('/product/product-category', 'Admin\ProductCategoryController@productcategory')->name('admin.product.category');
    Route::get('/product/product-category/add', 'Admin\ProductCategoryController@add')->name('admin.product.category.add');
    Route::post('/product/product-category/store', 'Admin\ProductCategoryController@store')->name('admin.product.category.store');
    Route::post('/product/product-category/delete/{id}/', 'Admin\ProductCategoryController@delete')->name('admin.product.category.delete');
    Route::get('/product/product-category/edit/{id}/', 'Admin\ProductCategoryController@edit')->name('admin.product.category.edit');
    Route::post('/product/product-category/update/{id}/', 'Admin\ProductCategoryController@update')->name('admin.product.category.update');

    Route::post('/product/product-category/popular', 'Admin\ProductCategoryController@makePopular')->name('admin.product.category.makePopular');

    // Product Sub Category Route
    Route::get('/product/product-category/subcategory/{id}', 'Admin\ProductSubCategoryController@productsubcategory')->name('admin.product.subcategory');
    Route::post('/product/product-category/subcategory/store', 'Admin\ProductSubCategoryController@store')->name('admin.product.subcategory.store');
    Route::post('/product/product-category/subcategory/delete/{id}/', 'Admin\ProductSubCategoryController@delete')->name('admin.product.subcategory.delete');
    Route::get('/product/product-category/subcategory/edit/{id}/', 'Admin\ProductSubCategoryController@edit')->name('admin.product.subcategory.edit');
    Route::post('/product/product-category/subcategory/update/{id}/', 'Admin\ProductSubCategoryController@update')->name('admin.product.subcategory.update');

    // Product  Route
    Route::get('/product', 'Admin\ProductController@products')->name('admin.product');
    Route::get('/product/add', 'Admin\ProductController@add')->name('admin.product.add');
    Route::post('/product/store', 'Admin\ProductController@store')->name('admin.product.store');
    Route::post('/product/delete/{id}/', 'Admin\ProductController@delete')->name('admin.product.delete');
    Route::get('/product/edit/{id}/', 'Admin\ProductController@edit')->name('admin.product.edit');
    Route::post('/product/update/{id}/', 'Admin\ProductController@update')->name('admin.product.update');

    Route::post('/product/featured', 'Admin\ProductController@makeFeature')->name('admin.product.makeFeature');

    Route::get('/category/get', 'Admin\ProductController@getcategory')->name('admin.helper.category');
    Route::get('/subcategory/get', 'Admin\ProductController@getsubcategory')->name('admin.helper.subcategory');

    // Product Order Routes
    Route::get('/product/all/orders', 'Admin\ProductOrderController@all')->name('admin.all.product.orders');
    Route::get('/product/pending/orders', 'Admin\ProductOrderController@pending')->name('admin.pending.product.orders');
    Route::get('/product/processing/orders', 'Admin\ProductOrderController@processing')->name('admin.processing.product.orders');
    Route::get('/product/completed/orders', 'Admin\ProductOrderController@completed')->name('admin.completed.product.orders');
    Route::get('/product/rejected/orders', 'Admin\ProductOrderController@rejected')->name('admin.rejected.product.orders');

    Route::post('/product/orders/status', 'Admin\ProductOrderController@status')->name('admin.product.orders.status');
    Route::post('/product/orders/payment/status', 'Admin\ProductOrderController@payment_status')->name('admin.product.payment.status');
    Route::get('/product/orders/detais/{id}', 'Admin\ProductOrderController@details')->name('admin.product.details');
    Route::post('/product/order/delete', 'Admin\ProductOrderController@orderDelete')->name('admin.product.order.delete');

    // Dynamic Page  Route
    Route::get('/dynamic-page', 'Admin\DynamicpageController@dynamic_page')->name('admin.dynamic_page');
    Route::get('/dynamic-page/add', 'Admin\DynamicpageController@add')->name('admin.dynamic_page.add');
    Route::post('/dynamic-page/store', 'Admin\DynamicpageController@store')->name('admin.dynamic_page.store');
    Route::post('/dynamic-page/delete/{id}/', 'Admin\DynamicpageController@delete')->name('admin.dynamic_page.delete');
    Route::get('/dynamic-page/edit/{id}/', 'Admin\DynamicpageController@edit')->name('admin.dynamic_page.edit');
    Route::post('/dynamic-page/update/{id}/', 'Admin\DynamicpageController@update')->name('admin.dynamic_page.update');

    // Language Routes
    Route::get('/languages', 'Admin\LanguageController@index')->name('admin.language.index');
    Route::get('/language/add', 'Admin\LanguageController@add')->name('admin.language.add');
    Route::post('/language/store', 'Admin\LanguageController@store')->name('admin.language.store');
    Route::get('/language/edit/{id}', 'Admin\LanguageController@edit')->name('admin.language.edit');
    Route::post('/language/update/{id}', 'Admin\LanguageController@update')->name('admin.language.update');
    Route::post('/language/delete/{id}', 'Admin\LanguageController@delete')->name('admin.language.delete');

    Route::post('/language/default/{id}', 'Admin\LanguageController@default')->name('admin.language.default');

    Route::get('/language/edit/keyword/{id}', 'Admin\LanguageController@editKeyword')->name('admin.language.editKeyword');
    Route::post('/language/update/keyword/{id}', 'Admin\LanguageController@updateKeyword')->name('admin.language.updateKeyword');

    // Admin Footer Logo Text Routes
    Route::get('/footer', 'Admin\FooterController@index')->name('admin.footer.index');
    Route::post('/footer/update/{id}', 'Admin\FooterController@update')->name('admin.footer.update');
});

Route::group(['middleware' => 'setlang'], function () {

    Route::get('/{slug}', 'Front\FrontController@front_dynamic_page')->name('front.front_dynamic_page');

});
