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

Route::get('/', 'FrontController@index')->name('home');

Route::get('/command', function() {
    Artisan::call('cache:clear');
    Artisan::call('optimize:clear');
    return "Cache and optimize cleared";
});
Route::get('/', function () {
    return view('auth.login');
});


/* Start Don't Remove */
Route::post('/login-data','TridentInfowayManagementController@login_data');
Route::get('/logout-data','TridentInfowayManagementController@logout_data');
/* End Don't Remove */

Auth::routes();

Route::group(['middleware' => ['auth','admin']], function() {
    
    Route::get('/admin', 'HomeController@index');
    Route::get('/user_report', 'HomeController@user_report');
    Route::post('/user_report_find', 'HomeController@user_report_find');

    Route::get('/brand_report', 'HomeController@brand_report');
    Route::post('/brand_report_find', 'HomeController@brand_report_find');

    Route::get('/transaction_report', 'HomeController@transaction_report');
    Route::post('/transaction_report_find', 'HomeController@transaction_report_find');
    Route::get('/business_admin_performance', 'HomeController@business_admin_performance');
    Route::get('/business_admin_performance_export/{start_date}/{end_date}', 'HomeController@business_admin_performance_export');

    Route::get('/business_admin_use', 'HomeController@business_admin_user');
    //Route::get('/business_admin_performance_export/{start_date}/{end_date}', 'HomeController@business_admin_performance_export');

    Route::get('/business_admin_order', 'HomeController@business_admin_order');
    Route::get('/business_admin_appointment', 'HomeController@business_admin_appointment');
    
    Route::get('user_export/{id?}', 'AclController@user_export')->name('user_export');
    Route::get('user_export_report/{id?}', 'AclController@user_export_report')->name('user_export_report');
    Route::get('user_export_download/{id?}', 'AclController@user_export_download')->name('user_export_download');

    Route::resource('users','AclController');
    Route::delete('users_buss_delete/{id}','AclController@users_buss_delete');
    Route::get('user_status/{id}/{status}', 'AclController@user_status')->name('user_status');
    Route::get('show_data','AclController@show_data')->name('show_data');
    Route::get('buss_user_show_data','AclController@buss_user_show_data')->name('buss_user_show_data');
    Route::post('buss_user_create','AclController@buss_user_create')->name('buss_user_create');

    Route::resource('roles','RoleController');
    
    Route::resource('permissions','PermissionController');
    
    Route::get('/administrator/profile/{id}', 'UserProfileController@index');
    Route::post('/administrator/profile/update', 'UserProfileController@update');
    
    Route::resource('User-Activity','UserActivityController');
    Route::resource('logins','UserActivityController');
    Route::get('delete_one_data/{id}','UserActivityController@delete_one_data')->name('delete_one_data');
    Route::get('delete_all_data/{id}','UserActivityController@delete_all_data')->name('delete_all_data');
    Route::get('backup-index','UserActivityController@backup_index')->name('backup_index');
});


Route::resource('countries', 'CountryController');


Route::resource('languages', 'LanguageController');


Route::resource('segments', 'SegmentController');


Route::resource('vehicles', 'VehicleController');
Route::get('country_status/{id}/{status}', 'CountryController@country_status')->name('country_status');   
Route::get('language_status/{id}/{status}', 'LanguageController@language_status')->name('language_status');   
Route::get('segment_status/{id}/{status}', 'SegmentController@segment_status')->name('segment_status');   
Route::get('vehicle_status/{id}/{status}', 'VehicleController@vehicle_status')->name('vehicle_status');   

   

Route::resource('categories', 'CategoryController');
Route::get('categories_status/{id}/{status}', 'CategoryController@categories_status')->name('categories_status');   



Route::resource('subCategories', 'Sub_categoryController');
Route::get('sub_categories_status/{id}/{status}', 'Sub_categoryController@sub_categories_status')->name('sub_categories_status');   
   
Route::resource('brands', 'BrandController');
Route::get('brands_status/{id}/{status}', 'BrandController@brands_status')->name('brands_status'); 

Route::get('get-sub-cat-list', 'HomeController@subcatList');  
Route::get('get-segment-list', 'HomeController@segmentList');  
Route::get('get-country-list', 'HomeController@buss_countryList');  
Route::get('get-business-point-stamp', 'HomeController@getBusinessPointStamp');
Route::get('get-business-point-details', 'HomeController@getBusinessPointDetails');
Route::get('get_days_count_list', 'HomeController@get_days_count_list');
Route::get('get_month_count_list', 'HomeController@get_month_count_list');
Route::get('get_country_buss_list', 'HomeController@get_country_buss_list');
Route::get('get_country_brand_list', 'HomeController@get_country_brand_list');


Route::resource('galleryMasters', 'Gallery_masterController');


Route::resource('socialIcons', 'Social_iconController');


Route::resource('webLinkBanners', 'Web_link_bannersController');


Route::resource('offerBanners', 'Offer_bannerController');


Route::resource('purchaseOptions', 'Purchase_optionsController');
Route::get('purchase_status/{id}/{status}', 'Purchase_optionsController@purchase_status')->name('purchase_status');


Route::resource('aboutUses', 'About_usController');


Route::resource('ratings', 'RatingController');
Route::get('rating_status/{id}/{status}', 'RatingController@rating_status')->name('rating_status');
Route::post('ratings_filter', 'RatingController@ratings_filter')->name('ratings_filter');
Route::get('ratings_export/{id?}', 'RatingController@ratings_export');


Route::resource('userBusinessDetails', 'User_business_detailsController');


Route::resource('appScreenInformations', 'App_screen_informationController');


Route::resource('questions', 'QuestionController');
Route::get('question_status/{id}/{status}', 'QuestionController@question_status')->name('question_status');


Route::resource('questionAnswers', 'Question_answerController');
Route::post('exporQuestion', 'Question_answerController@exporQuestion');
Route::get('export_upload_receipt', 'Voucher_upload_receiptController@export_upload_receipt');
Route::get('export_upload_scenario_1/{id}', 'Voucher_upload_receiptController@export_upload_scenario_1');
Route::get('export_upload_scenario_2/{id}', 'Voucher_upload_receiptController@export_upload_scenario_2');




Route::resource('tutorialMasters', 'Tutorial_masterController');
Route::get('tutorial_status/{id}/{status}', 'Tutorial_masterController@tutorial_status')->name('tutorial_status');   

Route::resource('notificationMasters', 'Notification_masterController');
Route::get('notification_status/{id}/{status}', 'Notification_masterController@notification_status')->name('notification_status');

Route::get('sendNotification/{id}', 'Notification_masterController@sendNotification')->name('sendNotification');

Route::resource('linkMasters', 'Link_masterController');


Route::resource('referBusinesses', 'Refer_businessController');

Route::get('refer_business_status/{id}/{status}', 'Refer_businessController@refer_business_status')->name('refer_business_status');

Route::resource('referBusinessDetails', 'Refer_business_detailsController');


Route::resource('vouchers', 'VoucherController');
Route::get('lotery_code_details_scenario_1', 'VoucherController@lotery_code_details_scenario_1');
Route::get('lotery_code_details_scenario_2', 'VoucherController@lotery_code_details_scenario_2');
Route::get('vouchers_status/{id}/{status}', 'VoucherController@vouchers_status')->name('vouchers_status');


Route::resource('voucherCategories', 'Voucher_categoryController');
Route::get('tutorial_status/{id}/{status}', 'Voucher_categoryController@tutorial_status')->name('tutorial_status'); 
Route::get('findMember','BusinessController@findMember')->name('findMember');
Route::post('findMemberDetails','BusinessController@findMemberDetails')->name('findMemberDetails');
Route::get('rewards_details/{id}','BusinessController@rewards_details')->name('rewards_details');
Route::post('rewards_submit','BusinessController@rewards_submit')->name('rewards_submit');
Route::get('get_member_voucher/{id}','BusinessController@get_member_voucher')->name('get_member_voucher');
Route::post('credit_member_voucher','BusinessController@credit_member_voucher')->name('credit_member_voucher');
Route::get('get_give_voucher/{id}','BusinessController@get_give_voucher')->name('get_give_voucher');
Route::post('post_give_voucher','BusinessController@post_give_voucher')->name('post_give_voucher');


Route::get('appointments_new','BusinessController@appointments_new');
Route::get('appointments_view','BusinessController@appointments_view');
Route::get('appointments_view_id_wise/{id}','BusinessController@appointments_view_id_wise');

Route::get('appointments_weekly_view','BusinessController@appointments_weekly_view');
Route::get('appointments_monthly_view','BusinessController@appointments_monthly_view');

Route::get('available_appointment_list/{id?}','BusinessController@available_appointment_list');

Route::get('book_appointment/{id?}/{date?}','BusinessController@book_appointment');
Route::post('save_appointment','BusinessController@save_appointment');
Route::get('booked_appointment/{appointmentId}/{userId}/{slot_id}','BusinessController@booked_appointment');
Route::post('update_book_appointment','BusinessController@update_book_appointment');
Route::get('appointment_by_date/{slot_id}','BusinessController@appointment_by_date');

Route::get('get_weekly_apointments','BusinessController@get_weekly_apointments');
Route::get('get_monthly_apointments','BusinessController@get_monthly_apointments');
Route::get('cash_back/{id}','BusinessController@cash_back')->name('cash_back');
Route::post('save_cash_back','BusinessController@save_cash_back')->name('save_cash_back');
Route::get('invite_member','BusinessController@invite_member')->name('invite_member');
Route::post('sendInvitation','BusinessController@sendInvitation')->name('sendInvitation');
Route::get('offerBannersList','BusinessController@offerBannersList')->name('offerBannersList');

Route::resource('notificationDetails', 'Notification_detailsController');


Route::resource('voucherUploadReceipts', 'Voucher_upload_receiptController');


Route::resource('userVouchers', 'User_voucherController');


Route::resource('giftCards', 'Gift_cardController');


Route::resource('stampMasters', 'Stamp_masterController');


Route::resource('pointsMasters', 'Points_masterController');


Route::resource('flagSelections', 'Flag_selectionController');
Route::get('downloadSecion', 'Flag_selectionController@downloadSecion');


Route::resource('faqsBusinesses', 'Faqs_businessController');
Route::get('faq_user_wise', 'Faqs_businessController@faq_user_wise')->name('faq_user_wise');

Route::resource('giftVocherTypes', 'Gift_vocher_typesController');
Route::get('gift_vocher_statuss/{id}/{status}', 'Gift_vocher_typesController@gift_vocher_status')->name('gift_vocher_status');



Route::resource('marketplaceLogos', 'Marketplace_logoController');


Route::resource('orderCategories', 'Order_categoriesController');
Route::get('order_categories_status/{id}/{status}', 'Order_categoriesController@order_categories_status')->name('order_categories_status');


Route::resource('orderProducts', 'Order_productsController');


Route::resource('orderProductExtraDetails', 'Order_product_extra_detailsController');
Route::get('product_extra_status/{id}/{status}', 'Order_product_extra_detailsController@product_extra_status')->name('product_extra_status');
Route::post('search_orders', 'Member_ordersController@search_orders')->name('search_orders');

Route::resource('memberOrders', 'Member_ordersController');

Route::get('get_all_order/{status?}','Member_ordersController@get_all_order')->name('get_all_order');
Route::get('get_by_date/','Member_ordersController@get_by_date')->name('get_by_date');
Route::get('view_order_details/{id}','Member_ordersController@view_order_details')->name('view_order_details');
Route::post('update_order_status','Member_ordersController@update_order_status')->name('update_order_status');


Route::resource('couponMasterOrders', 'Coupon_master_orderController');


Route::resource('bookingCategories', 'Booking_categoriesController');
Route::get('booking_categories_status/{id}/{status}', 'Booking_categoriesController@booking_categories_status')->name('booking_categories_status');


Route::resource('servicesProducts', 'Services_productController');


Route::resource('extraServices', 'Extra_servicesController');
Route::get('service_extra_status/{id}/{status}', 'Extra_servicesController@service_extra_status')->name('service_extra_status');


Route::resource('bookedServices', 'Booked_servicesController');


Route::resource('couponMasterServices', 'Coupon_master_servicesController');


Route::resource('slotMasters', 'Slot_masterController');


Route::resource('weekOffMasters', 'Week_off_masterController');


Route::resource('holidayMasters', 'Holiday_masterController');


Route::resource('promotionalImageMasters', 'Promotional_image_masterController');
Route::post('promotionalImageMasters/1/edit', 'Promotional_image_masterController@edit');


Route::resource('otherProgramMasters', 'Other_program_masterController');


Route::resource('loyaltyBannerMasters', 'Loyalty_banner_masterController');
Route::post('loyaltyBannerMasters/1/edit', 'Loyalty_banner_masterController@edit');


Route::resource('nfcMasters', 'Nfc_masterController');


Route::resource('socialMediaMgts', 'Social_media_mgtController');
