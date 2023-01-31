<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\LoginController;
use App\Http\Controllers\Admin\LoginController as AdminController;
use App\Http\Controllers\Front\FrontController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\FooterController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\SocialController;
use App\Http\Controllers\Admin\EbannerController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Front\ProductController as FontProductController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\User\RegisterController;
use App\Http\Controllers\Admin\CurrencyController;
use App\Http\Controllers\Admin\LanguageController;
use App\Http\Controllers\Admin\ShippingController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\NewsletterController;
use App\Http\Controllers\Admin\DynamicpageController;
use App\Http\Controllers\Admin\EmailsettingController;
use App\Http\Controllers\Admin\ProductOrderController;
use App\Http\Controllers\Front\ProductReviewController;
use App\Http\Controllers\Admin\PaymentGatewayController;
use App\Http\Controllers\Admin\ProductCategoryController;
use App\Http\Controllers\Payment\Product\PaypalController;
use App\Http\Controllers\Payment\Product\StripeController;
use App\Http\Controllers\Admin\ProductSubCategoryController;
use App\Http\Controllers\Payment\Product\CashOnDeliveryController;

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

    Route::get('/', [FrontController::class,'index'])->name('front.index');

    // Language Change Route
    Route::get('/changelanguage/{lang}', [FrontController::class,'changeLanguage'])->name('changeLanguage');
    // Currency Change Route
    Route::get('/changecurrency/{currId}', [FrontController::class,'changeCurrency'])->name('changeCurrency');

    // Shop Page & product details page
    Route::get('/shop',[FontProductController::class,'products'])->name('front.products');
    Route::get('/product/product-details/{slug}',[FontProductController::class,'product_details'])->name('front.product_details');

    // product ratting & review comment
    Route::post('/review/submit/{id}',[ProductReviewController::class,'review'])->name('front.product.review');
    Route::get('cart/qty/get/ajax', [FontProductController::class,'cartQtyGet'])->name('cart.qty.get'); // Product quantity
    Route::get('/cart',[FontProductController::class,'cart'])->name('front.cart'); // cart page route
    Route::get('/cart/header/load/',[FontProductController::class,'headerCartLoad'])->name('cart.header.load'); // header cart load
    Route::get('/add-to-cart/{id}',[FontProductController::class,'addToCart'])->name('front.product.add_cart'); // Add to cart
    Route::get('/cart/item/remove/{id}', [FontProductController::class,'cartItemRemove'])->name('cart.item.remove'); // Remove cart
    Route::post('/cart/update/', [FontProductController::class,'cartUpdate'])->name('cart.update'); // Update Cart


    // wishlist
    Route::get('/add-wishlist/{slug}',[FontProductController::class,'addWishlist'])->name('front.product.add.wishlist'); // Add to wishlist
    Route::get('/wishlist',[FontProductController::class,'wishlist'])->name('front.wishlist'); // Add to wishlist
    Route::get('/remove-wishlist/{slug}',[FontProductController::class,'removeWishlist'])->name('front.product.remove.wishlist'); // Add to wishlist

    // Checkout Routes
    // checkout page
    Route::get('/checkout',[FontProductController::class,'checkout'])->name('front.checkout');
    Route::get('/product/checkout/{slug}',[FontProductController::class,'productCheckout'])->name('front.product.checkout');

    // paypal routes
    Route::post('/paypal/submit/', [PaypalController::class,'submit'])->name('product.paypal.submit');
    Route::get('/product/order/paypal/cancle', [PaypalController::class,'paycancle'])->name('product.paypal.cancle');
    Route::get('/product/paypal/return', [PaypalController::class,'payreturn'])->name('product.paypal.return');
    Route::get('/product/paypal/notify', [PaypalController::class,'notify'])->name('product.paypal.notify');

    // stripe routes
    Route::post('/stripe/submit/', [StripeController::class,'submit'])->name('product.stripe.submit');

    // cash on delivery routes
    Route::post('/cash-on-delivery/submit/', [CashOnDeliveryController::class,'submit'])->name('product.cash_on_delivery.submit');

    // Contact page & submit page Route
    Route::get('/contact',[FrontController::class,'contact'])->name('front.contact');
    Route::post('/contact/submit',[FrontController::class,'contactSubmit'])->name('front.contact.submit');

    // Newsletter Route
    Route::post('/newsletter',[NewsletterController::class,'store'])->name('front.newsletter.store');

    Route::group(['prefix'=> 'user'], function(){

        Route::get('/login', [LoginController::class,'showLogin'])->name('user.login');
        Route::post('/login/submit', [LoginController::class,'login'])->name('user.login.submit');


        Route::get('/register', [RegisterController::class,'showRegister'])->name('user.register');
        Route::post('/register/submit', [RegisterController::class,'register'])->name('user.register.submit');
        Route::get('/register/verify/{token}', [RegisterController::class,'token'])->name('user.register.token');

    });

    Route::group(['prefix'=> 'user' , 'middleware'=>'auth:web'], function(){

        Route::get('/dashboard',[UserController::class,'dashboard'])->name('user.dashboard');
        Route::get('/edit-profile',[UserController::class,'editProfile'])->name('user.editProfile');
        Route::post('/update-profile/{id}',[UserController::class,'updateProfile'])->name('user.updateProfile');

        Route::get('/change-password',[UserController::class,'changePassword'])->name('user.changePassword');
        Route::post('/update-password/{id}',[UserController::class,'updatePassword'])->name('user.updatePassword');

        // product order route
        Route::get('/product-orders',[UserController::class,'product_order'])->name('user.product.order');
        Route::get('/order/details/{id}',[UserController::class,'orderDetails'])->name('user.order.details');

        Route::get('/logout',[UserController::class,'logout'])->name('user.logout');

    });


});

Route::group(['prefix' => 'admin', 'middleware' => 'guest:admin'], function () {

    Route::get('/', [AdminController::class,'login'])->name('admin.login');
    Route::post('/login', [AdminController::class,'authenticate'])->name('admin.auth');
});

Route::group(['prefix' => 'admin', 'middleware' => 'auth:admin'], function () {

    Route::get('/logout', [AdminController::class,'logout'])->name('admin.logout');
    Route::get('/dashboard', [DashboardController::class,'dashboard'])->name('admin.dashboard');

    // Admin Profile Routs
    Route::get('/profile/edit', [ProfileController::class,'editProfile'])->name('admin.editProfile');
    Route::post('/profile/update', [ProfileController::class,'updateProfile'])->name('admin.updateProfile');
    Route::get('/profile/password/edit', [ProfileController::class,'editPassword'])->name('admin.editPassword');
    Route::post('/profile/password/update', [ProfileController::class,'updatePassword'])->name('admin.updatePassword');


    // Setting Routes

    // Basic Information
    Route::get('/basicinfo', [SettingController::class,'basicinfo'])->name('admin.setting.basicinfo');
    Route::post('/basicinfo/update/{lang}', [SettingController::class,'updateBasicinfo'])->name('admin.setting.updateBasicinfo');
    Route::post('/commoninfo/update', [SettingController::class,'updateCommoninfo'])->name('admin.setting.updateCommoninfo');

    // ADMIN EMAIL SETTINGS SECTION
    Route::get('/email-config', [EmailsettingController::class,'config'])->name('admin.mail.config');
    Route::post('/email-config/submit', [EmailsettingController::class,'configUpdate'])->name('admin.mail.config.update');

    // Social Links
    Route::get('/slinks', [SocialController::class,'slinks'])->name('admin.Slinks');
    Route::post('/slinks/store', [SocialController::class,'storeSlinks'])->name('admin.storeSlinks');
    Route::get('/slinks/edit/{id}', [SocialController::class,'editSlinks'])->name('admin.editSlinks');
    Route::post('/slinks/update/{id}', [SocialController::class,'updateSlinks'])->name('admin.updateSlinks');
    Route::post('/slinks/delete/{id}', [SocialController::class,'deleteSlinks'])->name('admin.deleteSlinks');

    //Section Title
    Route::get('/sectiontitle' , [SettingController::class,'sectiontitle'])->name('admin.sectiontitle');
    Route::post('/sectiontitle/update/{lang}' , [SettingController::class,'updateSectiontitle'])->name('admin.updateSectiontitle');


    // Seo Info Routes
    Route::get('/seoinfo', [SettingController::class,'seoinfo'])->name('admin.seoinfo');
    Route::post('/seoinfo/update/{id}', [SettingController::class,'updateSeoinfo'])->name('admin.updateSeoinfo');

    // Scripts Routes
    Route::get('/scripts', [SettingController::class,'scripts'])->name('admin.scripts');
    Route::post('/scripts/update', [SettingController::class,'updateScript'])->name('admin.updateScript');

    // page Visibility
    Route::get('/page-visibility', [SettingController::class,'pagevisibility'])->name('admin.pagevisibility');
    Route::post('/page-visibility/update', [SettingController::class,'updatePagevisibility'])->name('admin.updatePagevisibility');

    // Cookie Alert
    Route::get('/cookie-alert', [SettingController::class,'cookiealert'])->name('admin.cookiealert');
    Route::post('/cookie-alert/update/{id}', [SettingController::class,'updateCookiealert'])->name('admin.updateCookiealert');

    // Cusstom Css Routes
    Route::get('/custom-css', [SettingController::class,'customcss'])->name('admin.customcss');
    Route::post('/custom-css/update', [SettingController::class,'updateCustomcss'])->name('admin.updateCustomcss');

    // Hero Slider Version
    Route::get('/slider', [SliderController::class,'slider'])->name('admin.slider');
    Route::get('/slider/add', [SliderController::class,'add'])->name('admin.slider.add');
    Route::post('/slider/store', [SliderController::class,'store'])->name('admin.slider.store');
    Route::post('/slider/delete/{id}/', [SliderController::class,'delete'])->name('admin.slider.delete');
    Route::get('/slider/edit/{id}/', [SliderController::class,'edit'])->name('admin.slider.edit');
    Route::post('/slider/update/{id}/', [SliderController::class,'update'])->name('admin.slider.update');

    // E-Banner Routes
    Route::get('/ebanner', [EbannerController::class,'ebanner'])->name('admin.ebanner');
    Route::get('/ebanner/add', [EbannerController::class,'add'])->name('admin.ebanner.add');
    Route::post('/ebanner/store', [EbannerController::class,'store'])->name('admin.ebanner.store');
    Route::post('/ebanner/delete/{id}/', [EbannerController::class,'delete'])->name('admin.ebanner.delete');
    Route::get('/ebanner/edit/{id}/', [EbannerController::class,'edit'])->name('admin.ebanner.edit');
    Route::post('/ebanner/update/{id}/', [EbannerController::class,'update'])->name('admin.ebanner.update');

    // Currency  Route
    Route::get('/currency', [CurrencyController::class,'currency'])->name('admin.currency');
    Route::get('/currency/add', [CurrencyController::class,'add'])->name('admin.currency.add');
    Route::post('/currency/store', [CurrencyController::class,'store'])->name('admin.currency.store');
    Route::post('/currency/delete/{id}/', [CurrencyController::class,'delete'])->name('admin.currency.delete');
    Route::get('/currency/edit/{id}/', [CurrencyController::class,'edit'])->name('admin.currency.edit');
    Route::post('/currency/update/{id}/', [CurrencyController::class,'update'])->name('admin.currency.update');
    Route::get('/currency/status/set/{id}', [CurrencyController::class,'status'])->name('admin.currency.status');

    // Payment Settings Route
    Route::get('/payment/gateways', [PaymentGatewayController::class,'index'])->name('admin.payment');
    Route::get('/payment/gateways/edit/{id}', [PaymentGatewayController::class,'edit'])->name('admin.payment.edit');
    Route::post('/payment/gateways/update/{id}', [PaymentGatewayController::class,'update'])->name('admin.payment.update');
    Route::get('/payment/gateways/{delete}', [PaymentGatewayController::class,'delete'])->name('admin.payment.delete');

    // Shipping Method  Route
    Route::get('/shipping/methods/', [ShippingController::class,'shipping'])->name('admin.shipping');
    Route::get('/shipping/method/add', [ShippingController::class,'add'])->name('admin.shipping.add');
    Route::post('/shipping/method/store', [ShippingController::class,'store'])->name('admin.shipping.store');
    Route::post('/shipping/method/delete/{id}/', [ShippingController::class,'delete'])->name('admin.shipping.delete');
    Route::get('/shipping/method/edit/{id}/', [ShippingController::class,'edit'])->name('admin.shipping.edit');
    Route::post('/shipping/method/update/{id}/', [ShippingController::class,'update'])->name('admin.shipping.update');
    Route::get('/shipping/method/status/set/{id}', [ShippingController::class,'status'])->name('admin.shipping.status');

    // Message Section
    Route::get('/messages', [MessageController::class,'message'])->name('admin.message');
    Route::get('/message/send/{id}', [MessageController::class,'send'])->name('admin.message.send');
    Route::post('/message/delete/{id}', [MessageController::class,'delete'])->name('admin.message.delete');

    // Newsletter Route
    Route::get('/subscriber', [NewsletterController::class,'newsletter'])->name('admin.newsletter');
    Route::get('/mailsubscriber', [NewsletterController::class,'mailsubscriber'])->name('admin.mailsubscriber');
    Route::post('/subscribers/sendmail', [NewsletterController::class,'subscsendmail'])->name('admin.subscribers.sendmail');

    Route::get('/subscriber/add', [NewsletterController::class,'add'])->name('admin.newsletter.add');
    Route::post('/subscriber/store', [NewsletterController::class,'store'])->name('admin.newsletter.store');
    Route::post('/subscriber/delete/{id}/', [NewsletterController::class,'delete'])->name('admin.newsletter.delete');
    Route::get('/subscriber/edit/{id}/', [NewsletterController::class,'edit'])->name('admin.newsletter.edit');
    Route::post('/subscriber/update/{id}/', [NewsletterController::class,'update'])->name('admin.newsletter.update');

    // Home Clients Section
    Route::get('/client', [ClientController::class,'client'])->name('admin.client');
    Route::get('/client/add', [ClientController::class,'add'])->name('admin.client.add');
    Route::post('/client/store', [ClientController::class,'store'])->name('admin.client.store');
    Route::post('/client/delete/{id}/', [ClientController::class,'delete'])->name('admin.client.delete');
    Route::get('/client/edit/{id}/', [ClientController::class,'edit'])->name('admin.client.edit');
    Route::post('/client/update/{id}/', [ClientController::class,'update'])->name('admin.client.update');

    // Product Category Routes
    Route::get('/product/product-category', [ProductCategoryController::class,'productcategory'])->name('admin.product.category');
    Route::get('/product/product-category/add', [ProductCategoryController::class,'add'])->name('admin.product.category.add');
    Route::post('/product/product-category/store', [ProductCategoryController::class,'store'])->name('admin.product.category.store');
    Route::post('/product/product-category/delete/{id}/', [ProductCategoryController::class,'delete'])->name('admin.product.category.delete');
    Route::get('/product/product-category/edit/{id}/', [ProductCategoryController::class,'edit'])->name('admin.product.category.edit');
    Route::post('/product/product-category/update/{id}/', [ProductCategoryController::class,'update'])->name('admin.product.category.update');

    Route::post('/product/product-category/popular', [ProductCategoryController::class,'makePopular'])->name('admin.product.category.makePopular');

    // Product Sub Category Route
    Route::get('/product/product-category/subcategory/{id}', [ProductSubCategoryController::class,'productsubcategory'])->name('admin.product.subcategory');
    Route::post('/product/product-category/subcategory/store', [ProductSubCategoryController::class,'store'])->name('admin.product.subcategory.store');
    Route::post('/product/product-category/subcategory/delete/{id}/', [ProductSubCategoryController::class,'delete'])->name('admin.product.subcategory.delete');
    Route::get('/product/product-category/subcategory/edit/{id}/', [ProductSubCategoryController::class,'edit'])->name('admin.product.subcategory.edit');
    Route::post('/product/product-category/subcategory/update/{id}/', [ProductSubCategoryController::class,'update'])->name('admin.product.subcategory.update');

    // Product  Route
    Route::get('/product', [ProductController::class,'products'])->name('admin.product');
    Route::get('/product/add', [ProductController::class,'add'])->name('admin.product.add');
    Route::post('/product/store', [ProductController::class,'store'])->name('admin.product.store');
    Route::post('/product/delete/{id}/', [ProductController::class,'delete'])->name('admin.product.delete');
    Route::get('/product/edit/{id}/', [ProductController::class,'edit'])->name('admin.product.edit');
    Route::post('/product/update/{id}/', [ProductController::class,'update'])->name('admin.product.update');

    Route::post('/product/featured', [ProductController::class,'makeFeature'])->name('admin.product.makeFeature');

    Route::get('/category/get', [ProductController::class,'getcategory'])->name('admin.helper.category');
    Route::get('/subcategory/get', [ProductController::class,'getsubcategory'])->name('admin.helper.subcategory');

    // Product Order Routes
    Route::get('/product/all/orders', [ProductOrderController::class,'all'])->name('admin.all.product.orders');
    Route::get('/product/pending/orders', [ProductOrderController::class,'pending'])->name('admin.pending.product.orders');
    Route::get('/product/processing/orders', [ProductOrderController::class,'processing'])->name('admin.processing.product.orders');
    Route::get('/product/completed/orders', [ProductOrderController::class,'completed'])->name('admin.completed.product.orders');
    Route::get('/product/rejected/orders', [ProductOrderController::class,'rejected'])->name('admin.rejected.product.orders');

    Route::post('/product/orders/status', [ProductOrderController::class,'status'])->name('admin.product.orders.status');
    Route::post('/product/orders/payment/status', [ProductOrderController::class,'payment_status'])->name('admin.product.payment.status');
    Route::get('/product/orders/detais/{id}', [ProductOrderController::class,'details'])->name('admin.product.details');
    Route::post('/product/order/delete', [ProductOrderController::class,'orderDelete'])->name('admin.product.order.delete');

    // Dynamic Page  Route
    Route::get('/dynamic-page', [DynamicpageController::class,'dynamic_page'])->name('admin.dynamic_page');
    Route::get('/dynamic-page/add', [DynamicpageController::class,'add'])->name('admin.dynamic_page.add');
    Route::post('/dynamic-page/store', [DynamicpageController::class,'store'])->name('admin.dynamic_page.store');
    Route::post('/dynamic-page/delete/{id}/', [DynamicpageController::class,'delete'])->name('admin.dynamic_page.delete');
    Route::get('/dynamic-page/edit/{id}/', [DynamicpageController::class,'edit'])->name('admin.dynamic_page.edit');
    Route::post('/dynamic-page/update/{id}/', [DynamicpageController::class,'update'])->name('admin.dynamic_page.update');

    // Language Routes
    Route::get('/languages', [LanguageController::class,'index'])->name('admin.language.index');
    Route::get('/language/add', [LanguageController::class,'add'])->name('admin.language.add');
    Route::post('/language/store', [LanguageController::class,'store'])->name('admin.language.store');
    Route::get('/language/edit/{id}', [LanguageController::class,'edit'])->name('admin.language.edit');
    Route::post('/language/update/{id}', [LanguageController::class,'update'])->name('admin.language.update');
    Route::post('/language/delete/{id}', [LanguageController::class,'delete'])->name('admin.language.delete');
    Route::post('/language/default/{id}', [LanguageController::class,'default'])->name('admin.language.default');
    Route::get('/language/edit/keyword/{id}', [LanguageController::class,'editKeyword'])->name('admin.language.editKeyword');
    Route::post('/language/update/keyword/{id}', [LanguageController::class,'updateKeyword'])->name('admin.language.updateKeyword');

    // Admin Footer Logo Text Routes
    Route::get('/footer', [FooterController::class,'index'])->name('admin.footer.index');
    Route::post('/footer/update/{id}', [FooterController::class,'update'])->name('admin.footer.update');
});

Route::group(['middleware' => 'setlang'], function () {

    Route::get('/{slug}', [FrontController::class,'front_dynamic_page'])->name('front.front_dynamic_page');

});
