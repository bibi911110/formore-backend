<?php



use Illuminate\Http\Request;

use Illuminate\Support\Facades\Route;



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



Route::post('/register','API\AuthApiController@register');
Route::post('/RegisterToken','API\AuthApiController@RegisterToken');
Route::post('/forget_password', 'API\AuthApiController@forget_password');
Route::post('/account_setting_update','API\AuthApiController@account_setting_update');
Route::post('/send_otp','API\AuthApiController@send_otp');
Route::post('/send_mobile_otp','API\AuthApiController@send_mobile_otp');

Route::post('/user_detils_update','API\AuthApiController@user_detils_update');
Route::post('/user_detils_show','API\AuthApiController@user_detils_show');

Route::post('/login','API\AuthApiController@login');
Route::post('/login_buss_user','API\AuthApiController@login_buss_user');



Route::middleware('auth:api')->get('/user', function (Request $request) {

    return $request->user();

});





Route::resource('countries', 'API\CountryAPIController');
Route::post('profile_country_upadte', 'API\CountryAPIController@profile_country_upadte');





Route::resource('languages', 'API\LanguageAPIController');





Route::resource('segments', 'API\SegmentAPIController');





Route::resource('vehicles', 'API\VehicleAPIController');



//Route::resource('categories', 'API\CategoryAPIController');
Route::post('categories', 'API\CategoryAPIController@index');
Route::post('sub_category_categorie_wise', 'API\CategoryAPIController@sub_category_categorie_wise');
Route::post('sub_category_business', 'API\CategoryAPIController@sub_category_business');


Route::resource('sub_categories', 'API\Sub_categoryAPIController');


Route::resource('brands', 'API\BrandAPIController');
Route::get('brands_id_wise', 'API\BrandAPIController@brands_id_wise');
Route::post('order_brand', 'API\BrandAPIController@order_brand');
Route::post('business_deals_categorywise', 'API\BrandAPIController@business_deals_categorywise');
Route::post('business_map_wise', 'API\BrandAPIController@business_map_wise');
Route::post('informative_page', 'API\BrandAPIController@informative_page');
Route::post('category_search_business', 'API\BrandAPIController@category_search_business');
Route::post('country_wise_business_position', 'API\BrandAPIController@country_wise_business_position');


Route::resource('gallery_masters', 'Gallery_masterAPIController');


Route::resource('social_icons', 'Social_iconAPIController');


Route::resource('web_link_banners', 'Web_link_bannersAPIController');


Route::post('offer_banners_buss_wise', 'API\Offer_bannerAPIController@offer_banners_buss_wise');
Route::post('offer_banners_brand_wise', 'API\Offer_bannerAPIController@offer_banners_brand_wise');


Route::resource('purchase_options', 'Purchase_optionsAPIController');


Route::resource('about_uses', 'About_usAPIController');


Route::resource('ratings', 'RatingAPIController');
Route::post('ratings_add', 'API\RatingAPIController@store');
Route::post('ratings_view_id_wise', 'API\RatingAPIController@ratings_view_id_wise');


Route::resource('user_business_details', 'User_business_detailsAPIController');


Route::resource('app_screen_informations', 'App_screen_informationAPIController');
Route::post('app_screen_language_wise', 'API\App_screen_informationAPIController@app_screen_language_wise');


Route::resource('questions', 'QuestionAPIController');
Route::post('questions_get', 'API\QuestionAPIController@questions_get');




Route::resource('question_answers', 'Question_answerAPIController');

Route::post('question_answers_add', 'API\Question_answerAPIController@store');


Route::resource('tutorial_masters', 'API\Tutorial_masterAPIController');
Route::post('tutorial_master_language_wise', 'API\Tutorial_masterAPIController@tutorial_master_language_wise');


Route::resource('notification_masters', 'API\Notification_masterAPIController');


Route::resource('link_masters', 'API\Link_masterAPIController');


Route::resource('refer_businesses', 'API\Refer_businessAPIController');



Route::resource('refer_business_details', 'Refer_business_detailsAPIController');

Route::post('add_refer_details', 'API\Refer_business_detailsAPIController@store');


Route::resource('vouchers', 'VoucherAPIController');
Route::post('get_vouchers', 'API\VoucherAPIController@get_vouchers');
Route::post('get_vouchers_campaign', 'API\VoucherAPIController@get_vouchers_campaign');
Route::post('get_lottery', 'API\VoucherAPIController@get_lottery');
Route::post('lottery_code_scan', 'API\VoucherAPIController@lottery_code_scan');
Route::post('get_used_vouchers', 'API\VoucherAPIController@get_used_vouchers');
Route::get('date_of_expiration_voucher', 'API\VoucherAPIController@date_of_expiration_voucher');
Route::get('get_voucher_category', 'API\VoucherAPIController@get_voucher_category');
Route::post('get_voucher_for_business', 'API\VoucherAPIController@get_voucher_for_business');
Route::post('my_rewards', 'API\VoucherAPIController@my_rewards');
Route::post('transaction_history', 'API\VoucherAPIController@transaction_history');
Route::post('brand_vocher_wise', 'API\VoucherAPIController@brand_vocher_wise');
Route::post('nfc_scan', 'API\VoucherAPIController@nfc_scan');
Route::post('super_deal_vocher', 'API\VoucherAPIController@super_deal_vocher');
Route::post('super_deal_scan', 'API\User_voucherAPIController@super_deal_scan');


Route::resource('voucher_categories', 'Voucher_categoryAPIController');


Route::resource('notification_details', 'API\Notification_detailsAPIController');
Route::post('notification_details_view', 'API\Notification_detailsAPIController@notification_details_view');

Route::post('delete_notification', 'API\Notification_detailsAPIController@delete_notification');


Route::resource('voucher_upload_receipts', 'Voucher_upload_receiptAPIController');
Route::post('add_voucher_upload_receipts', 'API\Voucher_upload_receiptAPIController@store');


Route::resource('user_vouchers', 'User_voucherAPIController');
Route::post('voucher_credit', 'API\User_voucherAPIController@store');


Route::resource('gift_cards', 'Gift_cardAPIController');
Route::post('send_gift_card', 'API\Gift_cardAPIController@store');


Route::resource('stamp_masters', 'Stamp_masterAPIController');


Route::resource('points_masters', 'Points_masterAPIController');


Route::resource('flag_selections', 'Flag_selectionAPIController');


Route::resource('faqs_businesses', 'Faqs_businessAPIController');


Route::resource('gift_vocher_types', 'Gift_vocher_typesAPIController');


Route::resource('marketplace_logos', 'API\Marketplace_logoAPIController');


Route::resource('order_categories', 'Order_categoriesAPIController');
Route::post('order_categories_business_wise', 'API\Order_categoriesAPIController@order_categories_business_wise');


Route::resource('order_products', 'Order_productsAPIController');
Route::post('order_products_business_wise', 'API\Order_productsAPIController@order_products_business_wise');


Route::resource('order_product_extra_details', 'Order_product_extra_detailsAPIController');
Route::post('order_extra_product_wise', 'API\Order_product_extra_detailsAPIController@order_extra_product_wise');


Route::resource('member_orders', 'Member_ordersAPIController');
Route::post('order_add', 'API\Member_ordersAPIController@store');
Route::post('add_cart', 'API\Member_ordersAPIController@add_cart');
Route::post('add_cart_extra_details ', 'API\Member_ordersAPIController@add_cart_extra_details');
Route::post('view_cart', 'API\Member_ordersAPIController@view_cart');
Route::post('view_cart_product_wise', 'API\Member_ordersAPIController@view_cart_product_wise');
Route::post('cart_delete', 'API\Member_ordersAPIController@cart_delete');

Route::post('member_orders_user_view', 'API\Member_ordersAPIController@member_orders_user_view');
Route::post('orders_buss_wise_view', 'API\Member_ordersAPIController@orders_buss_wise_view');
Route::post('orders_user_buss_wise_view', 'API\Member_ordersAPIController@orders_user_buss_wise_view');
Route::post('orders_details_view', 'API\Member_ordersAPIController@orders_details_view');

Route::post('get_all_order', 'API\Member_ordersAPIController@get_all_order');
Route::post('order_filter', 'API\Member_ordersAPIController@order_filter');
Route::post('order_details', 'API\Member_ordersAPIController@order_details');
Route::post('update_order_status', 'API\Member_ordersAPIController@update_order_status');



Route::resource('coupon_master_orders', 'Coupon_master_orderAPIController');
Route::post('order_coupon', 'API\Coupon_master_orderAPIController@order_coupon');


Route::resource('booking_categories', 'Booking_categoriesAPIController');
Route::post('booking_categories_business_wise', 'API\Booking_categoriesAPIController@booking_categories_business_wise');


Route::resource('services_products', 'Services_productAPIController');
Route::post('booking_products_business_wise', 'API\Services_productAPIController@booking_products_business_wise');


Route::resource('extra_services', 'Extra_servicesAPIController');
Route::post('booking_extra_product_wise', 'API\Extra_servicesAPIController@booking_extra_product_wise');


Route::resource('booked_services', 'Booked_servicesAPIController');
Route::post('booking_add', 'API\Booked_servicesAPIController@store');
Route::post('booking_add_cart', 'API\Booked_servicesAPIController@booking_add_cart');
Route::post('booking_add_cart_extra_details ', 'API\Booked_servicesAPIController@booking_add_cart_extra_details');
Route::post('booking_view_cart', 'API\Booked_servicesAPIController@booking_view_cart');
Route::post('bookig_view_cart_product_wise', 'API\Booked_servicesAPIController@bookig_view_cart_product_wise');
Route::post('booking_cart_delete', 'API\Booked_servicesAPIController@booking_cart_delete');

Route::post('booking_user_view', 'API\Booked_servicesAPIController@booking_user_view');
Route::post('booking_buss_wise_view', 'API\Booked_servicesAPIController@booking_buss_wise_view');
Route::post('booking_user_buss_wise_view', 'API\Booked_servicesAPIController@booking_user_buss_wise_view');
Route::post('booking_details_view', 'API\Booked_servicesAPIController@booking_details_view');
Route::post('active_apportionment_view', 'API\Booked_servicesAPIController@active_apportionment_view');
Route::post('history_apportionment_view', 'API\Booked_servicesAPIController@history_apportionment_view');



Route::resource('coupon_master_services', 'Coupon_master_servicesAPIController');
Route::post('booking_coupon', 'API\Coupon_master_servicesAPIController@booking_coupon');


Route::resource('slot_masters', 'Slot_masterAPIController');
Route::post('get_slot', 'API\Slot_masterAPIController@get_slot');
Route::post('get_slot_list', 'API\Slot_masterAPIController@get_slot_list');


Route::post('appointments_today_view', 'API\BusinessAPIController@appointments_today_view');
Route::post('appointments_weekly_view', 'API\BusinessAPIController@appointments_weekly_view');
Route::post('appointments_monthly_view', 'API\BusinessAPIController@appointments_monthly_view');
Route::post('servies_list', 'API\BusinessAPIController@servies_list');
Route::post('get_slot_by_date', 'API\BusinessAPIController@get_slot_by_date');
Route::post('get_booked_appointment', 'API\BusinessAPIController@get_booked_appointment');



Route::resource('week_off_masters', 'Week_off_masterAPIController');


Route::resource('holiday_masters', 'Holiday_masterAPIController');



Route::post('findMemberDetails','API\BusinessAPIController@findMemberDetails');
Route::post('rewards_details','API\BusinessAPIController@rewards_details');
Route::post('get_member_voucher','API\BusinessAPIController@get_member_voucher');
Route::post('rewards_submit','API\BusinessAPIController@rewards_submit');
Route::post('credit_member_voucher','API\BusinessAPIController@credit_member_voucher');

Route::post('get_give_voucher','API\BusinessAPIController@get_give_voucher');
Route::post('post_give_voucher','API\BusinessAPIController@post_give_voucher');
Route::post('cash_back','API\BusinessAPIController@cash_back');
Route::post('save_cash_back','API\BusinessAPIController@save_cash_back');
Route::post('sendInvitation','API\BusinessAPIController@sendInvitation');
Route::post('offerBannersList','API\BusinessAPIController@offerBannersList');
Route::post('getFaq','API\BusinessAPIController@getFaq');
Route::post('save_appointment','API\BusinessAPIController@save_appointment');
Route::post('edit_appointment','API\BusinessAPIController@update_book_appointment');
Route::get('transaction_type','API\BusinessAPIController@transaction_type');






Route::resource('promotional_image_masters', 'API\Promotional_image_masterAPIController');


Route::resource('other_program_masters', 'Other_program_masterAPIController');
Route::post('other_program_add', 'API\Other_program_masterAPIController@store');
Route::post('other_business_list', 'API\Other_program_masterAPIController@other_business_list');
Route::post('other_progrom_list', 'API\Other_program_masterAPIController@other_progrom_list');
Route::post('business_loyalty_card', 'API\Other_program_masterAPIController@business_loyalty_card');


Route::resource('loyalty_banner_masters', 'API\Loyalty_banner_masterAPIController');


Route::resource('nfc_masters', 'Nfc_masterAPIController');


Route::resource('social_media_mgts', 'Social_media_mgtAPIController');
