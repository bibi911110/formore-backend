    <ul class="sidebar-nav">

<li>

    <a href="{{ url('/admin') }}" class=" active"><i class="gi gi-stopwatch sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">Dashboard</span></a>

</li>



@canany(['users-index','users-create','users-edit','users-delete','roles-index','roles-create','roles-edit','roles-delete'])
<li class="sidebar-header">

    <span class="sidebar-header-options clearfix"><a href="javascript:void(0)" data-toggle="tooltip" title="Quick Settings"><i class="gi gi-settings"></i></a></span>

    <span class="sidebar-header-title">All Users</span>

</li>

<li class="{{ request()->is('show_data*') ? 'active' : '' }} {{ Request::is('roles*') ? 'active' : '' }}">

    <a href="#" class="sidebar-nav-menu"><i class="fa fa-angle-left sidebar-nav-indicator sidebar-nav-mini-hide"></i><i class="gi gi-certificate sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">Users</span></a>

    <ul>

        @canany(['users-index','users-create','users-edit','users-delete'])

            <li class="">

                <a class="{{ Request::is('show_data*') ? 'active' : '' }}" href="{{ url('show_data') }}"><i class="fa fa-circle-thin"></i> User manager</a>

            </li>


        @endcan
        <li class="">

                <a class="{{ Request::is('buss_user_show_data*') ? 'active' : '' }}" href="{{ url('buss_user_show_data') }}"><i class="fa fa-circle-thin"></i> Business User</a>

            </li>
            
            
       <!--  @canany(['permissions-index','permissions-create','permissions-edit','permissions-delete'])

        <li class="{{ Request::is('permissions*') ? 'active' : '' }}">

            <a href="{{ route('permissions.index') }}"> Permission Manager</a>

        </li>

        @endcan -->



        @canany(['roles-index','roles-create','roles-edit','roles-delete'])

        <li >

            <a class="{{ Request::is('roles*') ? 'active' : '' }}" href="{{ route('roles.index') }}"> <i class="fa fa-circle-thin"></i> Role manager</a>

        </li>

        @endcan

        

    </ul>

</li>
@endcan

@canany(['countries-index','countries-create','countries-edit','countries-delete','languages-index','languages-create','languages-edit','languages-delete','segments-index','segments-create','segments-edit','segments-delete','categories-index','categories-create','categories-edit','categories-delete','sub_categories-index','sub_categories-create','sub_categories-edit','sub_categories-delete','sub_categories-index','sub_categories-create','sub_categories-edit','sub_categories-delete','brands-index','brands-create','brands-edit','brands-delete'])
<li class="{{ Request::is('countries*') ? 'active' : '' }} {{ Request::is('languages*') ? 'active' : '' }} {{ Request::is('segments*') ? 'active' : '' }} {{ Request::is('categories*') ? 'active' : '' }} {{ Request::is('subCategories*') ? 'active' : '' }} {{ Request::is('brands*') ? 'active' : '' }}">

    <a href="#" class="sidebar-nav-menu"><i class="fa fa-angle-left sidebar-nav-indicator sidebar-nav-mini-hide"></i><i class="gi gi-cup sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">Master</span></a>

    <ul>

        @canany(['countries-index','countries-create','countries-edit','countries-delete'])

        <li >

            <a class="{{ Request::is('countries*') ? 'active' : '' }}" href="{{ route('countries.index') }}"><span><i class="fa fa-circle-thin"></i> Countries</span></a>

        </li>

        @endcan



        @canany(['languages-index','languages-create','languages-edit','languages-delete'])

        <li >

            <a class="{{ Request::is('languages*') ? 'active' : '' }}" href="{{ route('languages.index') }}"><span><i class="fa fa-circle-thin"></i> Languages</span></a>

        </li>

        @endcan



        @canany(['segments-index','segments-create','segments-edit','segments-delete'])

        <li>

            <a class="{{ Request::is('segments*') ? 'active' : '' }}" href="{{ route('segments.index') }}"><span><i class="fa fa-circle-thin"></i> Segments</span></a>

        </li>

        @endcan 
        @canany(['categories-index','categories-create','categories-edit','categories-delete'])
        <li>
            <a class="{{ Request::is('categories*') ? 'active' : '' }}" href="{{ route('categories.index') }}"><span><i class="fa fa-circle-thin"></i> Categories</span></a>
        </li>
        @endcan

        @canany(['sub_categories-index','sub_categories-create','sub_categories-edit','sub_categories-delete'])
        <li>
            <a class="{{ Request::is('subCategories*') ? 'active' : '' }}" href="{{ route('subCategories.index') }}"><span><i class="fa fa-circle-thin"></i> Sub categories</span></a>
        </li>
        @endcan

        @canany(['brands-index','brands-create','brands-edit','brands-delete'])
        <li>
            <a class="{{ Request::is('brands*') ? 'active' : '' }}" href="{{ route('brands.index') }}"><span><i class="fa fa-circle-thin"></i> Business/Brands</span></a>
        </li>
        @endcan

        </ul>


@endcan

<!-- my Menu -->
@canany(['gallery_masters-index','gallery_masters-create','gallery_masters-edit','gallery_masters-delete','social_icons-index','social_icons-create','social_icons-edit','social_icons-delete','web_link_banners-index','web_link_banners-create','web_link_banners-edit','web_link_banners-delete','offer_banners-index','offer_banners-create','offer_banners-edit','offer_banners-delete','purchase_options-index','purchase_options-create','purchase_options-edit','purchase_options-delete','about_uses-index','about_uses-create','about_uses-edit','about_uses-delete','ratings-index','ratings-create','ratings-edit','ratings-delete','user_business_details-index','user_business_details-create','user_business_details-edit','user_business_details-delete'])
<li class="{{ Request::is('galleryMasters*') ? 'active' : '' }} {{ Request::is('socialIcons*') ? 'active' : '' }} {{ Request::is('webLinkBanners*') ? 'active' : '' }} {{ Request::is('offerBanners*') ? 'active' : '' }} {{ Request::is('purchaseOptions*') ? 'active' : '' }} {{ Request::is('aboutUses*') ? 'active' : '' }} {{ Request::is('ratings*') ? 'active' : '' }} {{ Request::is('userBusinessDetails*') ? 'active' : '' }} ">

    <a href="#" class="sidebar-nav-menu"><i class="fa fa-angle-left sidebar-nav-indicator sidebar-nav-mini-hide"></i><i class="gi gi-certificate sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">Business Master</span></a>

    <ul>
        @canany(['user_business_details-index','user_business_details-create','user_business_details-edit','user_business_details-delete'])
        <li class="{{ Request::is('userBusinessDetails*') ? 'active' : '' }}">
            <a class="{{ Request::is('userBusinessDetails*') ? 'active' : '' }}" href="{{ route('userBusinessDetails.index') }}"><i class="fa fa-circle-thin"></i> Business details</a>
        </li>
        @endcan
        
        @canany(['gallery_masters-index','gallery_masters-create','gallery_masters-edit','gallery_masters-delete'])
            <li class="{{ Request::is('galleryMasters*') ? 'active' : '' }}">

                <a class="{{ Request::is('show_data*') ? 'active' : '' }}" href="{{ route('galleryMasters.index') }}"><i class="fa fa-circle-thin"></i> Gallery</a>

                <!-- <a href="{{ route('galleryMasters.index') }}"><i class="fa fa-edit"></i><span>Gallery Masters</span></a> -->
            </li>
        @endcan
        @canany(['social_icons-index','social_icons-create','social_icons-edit','social_icons-delete'])
                <a class="{{ Request::is('socialIcons*') ? 'active' : '' }}" href="{{ route('socialIcons.index') }}"><i class="fa fa-circle-thin"></i> Social icons</a>

            </li>
        @endcan
        @canany(['web_link_banners-index','web_link_banners-create','web_link_banners-edit','web_link_banners-delete'])
            <li>
            <a class="{{ Request::is('webLinkBanners*') ? 'active' : '' }}" href="{{ route('webLinkBanners.index') }}"><i class="fa fa-circle-thin"></i> Web Link banners</a>
            </li>
        @endcan

        @canany(['offer_banners-index','offer_banners-create','offer_banners-edit','offer_banners-delete'])
            <li>
            <a class="{{ Request::is('offerBanners*') ? 'active' : '' }}" href="{{ route('offerBanners.index') }}"><i class="fa fa-circle-thin"></i> Offer banners</a>
            </li>
        @endcan

        @canany(['purchase_options-index','purchase_options-create','purchase_options-edit','purchase_options-delete'])
        <li>
            <a class="{{ Request::is('purchaseOptions*') ? 'active' : '' }}" href="{{ route('purchaseOptions.index') }}"><i class="fa fa-circle-thin"></i> Purchase options</a>
        </li>
        @endcan

        @canany(['about_uses-index','about_uses-create','about_uses-edit','about_uses-delete'])
            <li class="{{ Request::is('aboutUses*') ? 'active' : '' }}">
                <a class="{{ Request::is('aboutUses*') ? 'active' : '' }}" href="{{ route('aboutUses.index') }}"><i class="fa fa-circle-thin"></i> About Us</a>                
            </li>
        @endcan
        @canany(['ratings-index','ratings-create','ratings-edit','ratings-delete'])
            <li class="{{ Request::is('ratings*') ? 'active' : '' }}">
                <a class="{{ Request::is('ratings*') ? 'active' : '' }}" href="{{ route('ratings.index') }}"><i class="fa fa-circle-thin"></i> Business ratings</a>
            </li>
        @endcan
    </ul>

</li>
@endcan
<!-- my menu end -->



<!-- @canany(['gallery_masters-index','gallery_masters-create','gallery_masters-edit','gallery_masters-delete'])
<li class="{{ Request::is('galleryMasters*') ? 'active' : '' }}">
    <a href="{{ route('galleryMasters.index') }}"><i class="fa fa-edit"></i><span>Gallery Masters</span></a>
</li>
@endcan -->

<!-- @canany(['social_icons-index','social_icons-create','social_icons-edit','social_icons-delete'])
<li class="{{ Request::is('socialIcons*') ? 'active' : '' }}">
    <a href="{{ route('socialIcons.index') }}"><i class="fa fa-edit"></i><span>Social Icons</span></a>
</li>
@endcan -->

<!-- @canany(['web_link_banners-index','web_link_banners-create','web_link_banners-edit','web_link_banners-delete'])
<li class="{{ Request::is('webLinkBanners*') ? 'active' : '' }}">
    <a href="{{ route('webLinkBanners.index') }}"><i class="fa fa-edit"></i><span>Web Link Banners</span></a>
</li>
@endcan -->

<!-- @canany(['offer_banners-index','offer_banners-create','offer_banners-edit','offer_banners-delete'])
<li class="{{ Request::is('offerBanners*') ? 'active' : '' }}">
    <a href="{{ route('offerBanners.index') }}"><i class="fa fa-edit"></i><span>Offer Banners</span></a>
</li>
@endcan -->

<!-- @canany(['purchase_options-index','purchase_options-create','purchase_options-edit','purchase_options-delete'])
<li class="{{ Request::is('purchaseOptions*') ? 'active' : '' }}">
    <a href="{{ route('purchaseOptions.index') }}"><i class="fa fa-edit"></i><span>Purchase Options</span></a>
</li>
@endcan -->

<!-- @canany(['about_uses-index','about_uses-create','about_uses-edit','about_uses-delete'])
<li class="{{ Request::is('aboutUses*') ? 'active' : '' }}">
    <a href="{{ route('aboutUses.index') }}"><i class="fa fa-edit"></i><span>About Uses</span></a>
</li>
@endcan -->

<!-- @canany(['ratings-index','ratings-create','ratings-edit','ratings-delete'])
<li class="{{ Request::is('ratings*') ? 'active' : '' }}">
    <a href="{{ route('ratings.index') }}"><i class="fa fa-edit"></i><span>Ratings</span></a>
</li>
@endcan -->

<!-- @canany(['user_business_details-index','user_business_details-create','user_business_details-edit','user_business_details-delete'])
<li class="{{ Request::is('userBusinessDetails*') ? 'active' : '' }}">
    <a href="{{ route('userBusinessDetails.index') }}"><i class="fa fa-edit"></i><span>User Business Details</span></a>
</li>
@endcan -->

@canany(['app_screen_informations-index','app_screen_informations-create','app_screen_informations-edit','app_screen_informations-delete'])
<li class="{{ Request::is('appScreenInformations*') ? 'active' : '' }}">
    <a href="{{ route('appScreenInformations.index') }}"><i class="fa fa-circle-thin"></i><span>  App screen informations</span></a>
</li>
@endcan

@canany(['questions-index','questions-create','questions-edit','questions-delete'])
<li class="{{ Request::is('questions*') ? 'active' : '' }}">
    <a href="{{ route('questions.index') }}"><i class="fa fa-circle-thin"></i><span> Questions</span></a>
</li>
@endcan

@canany(['question_answers-index','question_answers-create','question_answers-edit','question_answers-delete'])
<li class="{{ Request::is('questionAnswers*') ? 'active' : '' }}">
    <a href="{{ route('questionAnswers.index') }}"><i class="fa fa-circle-thin"></i><span> Question answers</span></a>
</li>
@endcan

@canany(['tutorial_masters-index','tutorial_masters-create','tutorial_masters-edit','tutorial_masters-delete','notification_masters-index','notification_masters-create','notification_masters-edit','notification_masters-delete','link_masters-index','link_masters-create','link_masters-edit','link_masters-delete','refer_businesses-index','refer_businesses-create','refer_businesses-edit','refer_businesses-delete','refer_business_details-index','refer_business_details-create','refer_business_details-edit','refer_business_details-delete'])
<li class="{{ Request::is('tutorialMasters*') ? 'active' : '' }} {{ Request::is('notificationMasters*') ? 'active' : '' }} {{ Request::is('linkMasters*') ? 'active' : '' }} {{ Request::is('referBusinesses*') ? 'active' : '' }} {{ Request::is('referBusinessDetails*') ? 'active' : '' }}">

    <a href="#" class="sidebar-nav-menu"><i class="fa fa-angle-left sidebar-nav-indicator sidebar-nav-mini-hide"></i><i class="gi gi-cup sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">Account setting</span></a>

    <ul>

    @canany(['tutorial_masters-index','tutorial_masters-create','tutorial_masters-edit','tutorial_masters-delete'])
    <li >
        <a class="{{ Request::is('tutorialMasters*') ? 'active' : '' }}" href="{{ route('tutorialMasters.index') }}"><i class="fa fa-circle-thin"></i><span> Tutorial masters</span></a>
    </li>
    @endcan

    @canany(['notification_masters-index','notification_masters-create','notification_masters-edit','notification_masters-delete'])
    <li>
        <a class="{{ Request::is('notificationMasters*') ? 'active' : '' }}" href="{{ route('notificationMasters.index') }}"><i class="fa fa-circle-thin"></i><span> Notification masters</span></a>
    </li>
    @endcan

    @canany(['link_masters-index','link_masters-create','link_masters-edit','link_masters-delete'])
    <li>
        <a class="{{ Request::is('linkMasters*') ? 'active' : '' }}" href="{{ route('linkMasters.index') }}"><i class="fa fa-circle-thin"></i><span> Link masters</span></a>
    </li>
    @endcan

    @canany(['refer_businesses-index','refer_businesses-create','refer_businesses-edit','refer_businesses-delete'])
    <li >
        <a class="{{ Request::is('referBusinesses*') ? 'active' : '' }}" href="{{ route('referBusinesses.index') }}"><i class="fa fa-circle-thin"></i><span> Refer businesses</span></a>
    </li>
    @endcan

    @canany(['refer_business_details-index','refer_business_details-create','refer_business_details-edit','refer_business_details-delete'])
    <li >
        <a class="{{ Request::is('referBusinessDetails*') ? 'active' : '' }}" href="{{ route('referBusinessDetails.index') }}"><i class="fa fa-circle-thin"></i><span> Refer business details</span></a>
    </li>
    @endcan
    </ul>
</li>
@endcan
@canany(['vouchers-index','vouchers-create','vouchers-edit','vouchers-delete','voucher_upload_receipts-index','voucher_upload_receipts-create','voucher_upload_receipts-edit','voucher_upload_receipts-delete','stamp_masters-index','stamp_masters-create','stamp_masters-edit','stamp_masters-delete','points_masters-index','points_masters-create','points_masters-edit','points_masters-delete','flag_selections-index','flag_selections-create','flag_selections-edit','flag_selections-delete'])
<li class="{{ Request::is('vouchers*') ? 'active' : '' }} {{ Request::is('voucherUploadReceipts*') ? 'active' : '' }}">
    <a href="#" class="sidebar-nav-menu"><i class="fa fa-angle-left sidebar-nav-indicator sidebar-nav-mini-hide"></i><i class="gi gi-cup sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">Vouchers</span></a>
    <ul>

    @canany(['vouchers-index','vouchers-create','vouchers-edit','vouchers-delete'])
    <li>
        <a class="{{ Request::is('vouchers*') ? 'active' : '' }}" href="{{ route('vouchers.index') }}"><i class="fa fa-circle-thin"></i><span> Vouchers</span></a>
    </li>
    @endcan

    @canany(['voucher_upload_receipts-index','voucher_upload_receipts-create','voucher_upload_receipts-edit','voucher_upload_receipts-delete'])
    <li>
        <a class="{{ Request::is('voucherUploadReceipts*') ? 'active' : '' }}" href="{{ route('voucherUploadReceipts.index') }}"><i class="fa fa-circle-thin"></i><span> Voucher upload receipts</span></a>
    </li>
    @endcan

    @canany(['stamp_masters-index','stamp_masters-create','stamp_masters-edit','stamp_masters-delete'])
    <li>
        <a class="{{ Request::is('stampMasters*') ? 'active' : '' }}" href="{{ route('stampMasters.index') }}">
        <i class="fa fa-circle-thin"></i><span> Stamp masters</span></a>
    </li>
    @endcan

    @canany(['points_masters-index','points_masters-create','points_masters-edit','points_masters-delete'])
    <li>
        <a class="{{ Request::is('pointsMasters*') ? 'active' : '' }}" href="{{ route('pointsMasters.index') }}"><i class="fa fa-circle-thin"></i><span> Points masters</span></a>
    </li>
    @endcan

    @canany(['flag_selections-index','flag_selections-create','flag_selections-edit','flag_selections-delete'])
    <li>
        <a class="{{ Request::is('flagSelections*') ? 'active' : '' }}" href="{{ route('flagSelections.index') }}"><i class="fa fa-circle-thin"></i> Flag selections</a>
    </li>
    @endcan
    <li>
        <a class="{{ Request::is('lotery_code_details_scenario_1*') ? 'active' : '' }}" href="{{ url('lotery_code_details_scenario_1') }}"><i class="fa fa-circle-thin"></i> Lotery code scenario 1</a>
    </li>
     <li>
        <a class="{{ Request::is('lotery_code_details_scenario_2*') ? 'active' : '' }}" href="{{ url('lotery_code_details_scenario_2') }}"><i class="fa fa-circle-thin"></i> Lotery code scenario 2</a>
    </li>
    

    </ul>
</li>

@endcan
<!-- @canany(['voucher_categories-index','voucher_categories-create','voucher_categories-edit','voucher_categories-delete'])
<li class="{{ Request::is('voucherCategories*') ? 'active' : '' }}">
    <a href="{{ route('voucherCategories.index') }}"><i class="fa fa-edit"></i><span>Voucher Categories</span></a>
</li>
@endcan -->

@canany(['notification_details-index','notification_details-create','notification_details-edit','notification_details-delete'])
<li class="{{ Request::is('notificationDetails*') ? 'active' : '' }}">
    <a href="{{ route('notificationDetails.index') }}"><i class="fa fa-edit"></i><span>Notification details</span></a>
</li>
@endcan



@canany(['user_vouchers-index','user_vouchers-create','user_vouchers-edit','user_vouchers-delete'])
<li class="{{ Request::is('userVouchers*') ? 'active' : '' }}">
    <a href="{{ route('userVouchers.index') }}"><i class="fa fa-edit"></i><span>User vouchers</span></a>
</li>
@endcan

@canany(['gift_cards-index','gift_cards-create','gift_cards-edit','gift_cards-delete'])
<li class="{{ Request::is('giftCards*') ? 'active' : '' }}">
    <a href="{{ route('giftCards.index') }}"><i class="fa fa-edit"></i><span>Gift cards</span></a>
</li>
@endcan



@canany(['findMember'])
<li class="{{ Request::is('findMember*') ? 'active' : '' }}">
    <a href="{{ route('findMember') }}"><i class="fa fa-edit"></i><span> Find a member</span></a>
</li>
@endcan


@canany(['invite_member'])
<li class="{{ Request::is('invite_member*') ? 'active' : '' }}">
    <a href="{{ route('invite_member') }}"><i class="fa fa-edit"></i><span> Invite a member</span></a>
</li>
@endcan
@canany(['offerBannersList'])
<li class="{{ Request::is('offerBannersList*') ? 'active' : '' }}">
    <a href="{{ route('offerBannersList') }}"><i class="fa fa-edit"></i><span> Business offers </span></a>
</li>
@endcan
@canany(['appointments_view'])
<li class="{{ Request::is('appointments_view*') ? 'active' : '' }}">
    <a href="{{ url('appointments_view') }}"><i class="fa fa-edit"></i><span> Appointments </span></a>
</li>
@endcan
@canany(['faq_user_wise'])
<li class="{{ Request::is('faq_user_wise*') ? 'active' : '' }}">
    <a href="{{ url('faq_user_wise') }}"><i class="fa fa-edit"></i><span> Support </span></a>
</li>
@endcan

@canany(['get_all_order'])
<li class="{{ Request::is('get_all_order*') ? 'active' : '' }}">
    <a class="{{ Request::is('get_all_order*') ? 'active' : '' }}" href="{{ url('get_all_order') }}"><i class="fa fa-edit"></i> Orders</a>
</li>
@endcan
@canany(['get_by_date'])
<li class="{{ Request::is('get_by_date*') ? 'active' : '' }}">
<a class="{{ Request::is('get_by_date*') ? 'active' : '' }}" href="{{ url('get_by_date') }}"><i class="fa fa-edit"></i> Orders Filter</a>
</li>
@endcan
<!-- @canany(['appointments_view']) -->
<!-- @endcan -->
@canany(['faqs_businesses-index','faqs_businesses-create','faqs_businesses-edit','faqs_businesses-delete'])
<li>
    <a  class="{{ Request::is('faqsBusinesses*') ? 'active' : '' }}" href="{{ route('faqsBusinesses.index') }}"><i class="fa fa-edit"></i><span> Support</span></a>
</li>
@endcan
@canany(['gift_vocher_types-index','gift_vocher_types-create','gift_vocher_types-edit','gift_vocher_types-delete'])
<li class="{{ Request::is('giftVocherTypes*') ? 'active' : '' }}">
    <a href="{{ route('giftVocherTypes.index') }}"><i class="fa fa-edit"></i><span> Transaction Types</span></a>
</li>
@endcan

@canany(['marketplace_logos-index','marketplace_logos-create','marketplace_logos-edit','marketplace_logos-delete'])
<li class="{{ Request::is('marketplaceLogos*') ? 'active' : '' }}">
    <a href="{{ route('marketplaceLogos.index') }}"><i class="fa fa-edit"></i><span> Marketplace Logos</span></a>
</li>
@endcan

 @canany(['order_categories-index','order_categories-create','order_categories-edit','order_categories-delete','order_products-index','order_products-create','order_products-edit','order_products-delete','order_product_extra_details-index','order_product_extra_details-create','order_product_extra_details-edit','order_product_extra_details-delete','member_orders-index','member_orders-create','member_orders-edit','member_orders-delete','coupon_master_orders-index','coupon_master_orders-create','coupon_master_orders-edit','coupon_master_orders-delete'])
<li class="{{ Request::is('orderCategories*') ? 'active' : '' }} {{ Request::is('orderProducts*') ? 'active' : '' }}">
    <a href="#" class="sidebar-nav-menu"><i class="fa fa-angle-left sidebar-nav-indicator sidebar-nav-mini-hide"></i><i class="gi gi-cup sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">Order</span></a>
    <ul>
        @canany(['order_categories-index','order_categories-create','order_categories-edit','order_categories-delete'])
        <li class="{{ Request::is('orderCategories*') ? 'active' : '' }}">
            <a href="{{ route('orderCategories.index') }}"><i class="fa fa-circle-thin"></i><span> Order Categories</span></a>
        </li>
        @endcan

        @canany(['order_products-index','order_products-create','order_products-edit','order_products-delete'])
        <li class="{{ Request::is('orderProducts*') ? 'active' : '' }}">
            <a href="{{ route('orderProducts.index') }}"><i class="fa fa-circle-thin"></i><span> Order Products</span></a>
        </li>
        @endcan

        @canany(['order_product_extra_details-index','order_product_extra_details-create','order_product_extra_details-edit','order_product_extra_details-delete'])
        <li class="{{ Request::is('orderProductExtraDetails*') ? 'active' : '' }}">
            <a href="{{ route('orderProductExtraDetails.index') }}"><i class="fa fa-circle-thin"></i><span> Order Product Extra Details</span></a>
        </li>
        @endcan

        @canany(['member_orders-index','member_orders-create','member_orders-edit','member_orders-delete'])
        <li class="{{ Request::is('memberOrders*') ? 'active' : '' }}">
            <a href="{{ route('memberOrders.index') }}"><i class="fa fa-circle-thin"></i><span> Member Orders</span></a>
        </li>
        @endcan

        @canany(['coupon_master_orders-index','coupon_master_orders-create','coupon_master_orders-edit','coupon_master_orders-delete'])
        <li class="{{ Request::is('couponMasterOrders*') ? 'active' : '' }}">
            <a href="{{ route('couponMasterOrders.index') }}"><i class="fa fa-circle-thin"></i><span> Coupon Master Orders</span></a>
        </li>
        @endcan
</ul>
</li>
@endcan
@canany(['booking_categories-index','booking_categories-create','booking_categories-edit','booking_categories-delete','services_products-index','services_products-create','services_products-edit','services_products-delete','extra_services-index','extra_services-create','extra_services-edit','extra_services-delete','booked_services-index','booked_services-create','booked_services-edit','booked_services-delete','coupon_master_services-index','coupon_master_services-create','coupon_master_services-edit','coupon_master_services-delete','slot_masters-index','slot_masters-create','slot_masters-edit','slot_masters-delete','week_off_masters-index','week_off_masters-create','week_off_masters-edit','week_off_masters-delete','holiday_masters-index','holiday_masters-create','holiday_masters-edit','holiday_masters-delete'])
<li class="{{ Request::is('bookingCategories*') ? 'active' : '' }} {{ Request::is('servicesProducts*') ? 'active' : '' }}">
    <a href="#" class="sidebar-nav-menu"><i class="fa fa-angle-left sidebar-nav-indicator sidebar-nav-mini-hide"></i><i class="gi gi-cup sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">Booking</span></a>
    <ul>
    @canany(['booking_categories-index','booking_categories-create','booking_categories-edit','booking_categories-delete'])
    <li class="{{ Request::is('bookingCategories*') ? 'active' : '' }}">
        <a href="{{ route('bookingCategories.index') }}"><i class="fa fa-circle-thin"></i><span> Booking Categories</span></a>
    </li>
    @endcan

     @canany(['services_products-index','services_products-create','services_products-edit','services_products-delete'])
    <li class="{{ Request::is('servicesProducts*') ? 'active' : '' }}">
        <a href="{{ route('servicesProducts.index') }}"><i class="fa fa-circle-thin"></i><span> Services Products</span></a>
    </li>
    @endcan

   @canany(['extra_services-index','extra_services-create','extra_services-edit','extra_services-delete'])
    <li class="{{ Request::is('extraServices*') ? 'active' : '' }}">
        <a href="{{ route('extraServices.index') }}"><i class="fa fa-circle-thin"></i><span> Extra Services</span></a>
    </li>
    @endcan

     @canany(['booked_services-index','booked_services-create','booked_services-edit','booked_services-delete'])
    <li class="{{ Request::is('bookedServices*') ? 'active' : '' }}">
        <a href="{{ route('bookedServices.index') }}"><i class="fa fa-circle-thin"></i><span> Booked Services</span></a>
    </li>
    @endcan

   @canany(['coupon_master_services-index','coupon_master_services-create','coupon_master_services-edit','coupon_master_services-delete'])
    <li class="{{ Request::is('couponMasterServices*') ? 'active' : '' }}">
        <a href="{{ route('couponMasterServices.index') }}"><i class="fa fa-circle-thin"></i><span> Coupon Master Services</span></a>
    </li>
    @endcan
    @canany(['slot_masters-index','slot_masters-create','slot_masters-edit','slot_masters-delete'])
    <li class="{{ Request::is('slotMasters*') ? 'active' : '' }}">
        <a href="{{ route('slotMasters.index') }}"><i class="fa fa-circle-thin"></i><span> Slot Masters</span></a>
    </li>
    @endcan

    @canany(['week_off_masters-index','week_off_masters-create','week_off_masters-edit','week_off_masters-delete'])
    <li class="{{ Request::is('weekOffMasters*') ? 'active' : '' }}">
        <a href="{{ route('weekOffMasters.index') }}"><i class="fa fa-circle-thin"></i><span> Week Off Masters</span></a>
    </li>
    @endcan

    @canany(['holiday_masters-index','holiday_masters-create','holiday_masters-edit','holiday_masters-delete'])
    <li class="{{ Request::is('holidayMasters*') ? 'active' : '' }}">
        <a href="{{ route('holidayMasters.index') }}"><i class="fa fa-circle-thin"></i><span> Holiday Masters</span></a>
    </li>
    @endcan

</ul>
</li>

@endcan

