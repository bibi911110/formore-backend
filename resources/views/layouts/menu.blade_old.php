<ul class="sidebar-nav">

<li>

    <a href="{{ url('/admin') }}" class=" active"><i class="gi gi-stopwatch sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">Dashboard</span></a>

</li>



<li class="sidebar-header">

    <span class="sidebar-header-options clearfix"><a href="javascript:void(0)" data-toggle="tooltip" title="Quick Settings"><i class="gi gi-settings"></i></a></span>

    <span class="sidebar-header-title">All Users</span>

</li>

<li class="">

    <a href="#" class="sidebar-nav-menu"><i class="fa fa-angle-left sidebar-nav-indicator sidebar-nav-mini-hide"></i><i class="gi gi-certificate sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">Users</span></a>

    <ul>

        @canany(['users-index','users-create','users-edit','users-delete'])

            <li class="{{ Request::is('users*') ? 'active' : '' }}">

                <a href="{{ url('show_data') }}"><i class="fa fa-circle-thin"></i> Users Manager</a>

            </li>

        @endcan

       <!--  @canany(['permissions-index','permissions-create','permissions-edit','permissions-delete'])

        <li class="{{ Request::is('permissions*') ? 'active' : '' }}">

            <a href="{{ route('permissions.index') }}"> Permission Manager</a>

        </li>

        @endcan -->



        @canany(['roles-index','roles-create','roles-edit','roles-delete'])

        <li class="{{ Request::is('roles*') ? 'active' : '' }}">

            <a href="{{ route('roles.index') }}"> <i class="fa fa-circle-thin"></i> Role Manager</a>

        </li>

        @endcan

        

    </ul>

</li>

<li>

    <a href="#" class="sidebar-nav-menu"><i class="fa fa-angle-left sidebar-nav-indicator sidebar-nav-mini-hide"></i><i class="gi gi-cup sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">Master</span></a>

    <ul>

        @canany(['countries-index','countries-create','countries-edit','countries-delete'])

        <li class="{{ Request::is('countries*') ? 'active' : '' }}">

            <a href="{{ route('countries.index') }}"><span><i class="fa fa-circle-thin"></i> Countries</span></a>

        </li>

        @endcan



        @canany(['languages-index','languages-create','languages-edit','languages-delete'])

        <li class="{{ Request::is('languages*') ? 'active' : '' }}">

            <a href="{{ route('languages.index') }}"><span><i class="fa fa-circle-thin"></i> Languages</span></a>

        </li>

        @endcan



        @canany(['segments-index','segments-create','segments-edit','segments-delete'])

        <li class="{{ Request::is('segments*') ? 'active' : '' }}">

            <a href="{{ route('segments.index') }}"><span><i class="fa fa-circle-thin"></i> Segments</span></a>

        </li>

        @endcan 
        @canany(['categories-index','categories-create','categories-edit','categories-delete'])
        <li class="{{ Request::is('categories*') ? 'active' : '' }}">
            <a href="{{ route('categories.index') }}"><span><i class="fa fa-circle-thin"></i> Categories</span></a>
        </li>
        @endcan

        @canany(['sub_categories-index','sub_categories-create','sub_categories-edit','sub_categories-delete'])
        <li class="{{ Request::is('subCategories*') ? 'active' : '' }}">
            <a href="{{ route('subCategories.index') }}"><span><i class="fa fa-circle-thin"></i> Sub Categories</span></a>
        </li>
        @endcan

        @canany(['brands-index','brands-create','brands-edit','brands-delete'])
        <li class="{{ Request::is('brands*') ? 'active' : '' }}">
            <a href="{{ route('brands.index') }}"><span><i class="fa fa-circle-thin"></i> Business/Brands</span></a>
        </li>
        @endcan

        </ul>



@canany(['gallery_masters-index','gallery_masters-create','gallery_masters-edit','gallery_masters-delete'])
<li class="{{ Request::is('galleryMasters*') ? 'active' : '' }}">
    <a href="{{ route('galleryMasters.index') }}"><i class="fa fa-edit"></i><span>Gallery Masters</span></a>
</li>
@endcan

@canany(['social_icons-index','social_icons-create','social_icons-edit','social_icons-delete'])
<li class="{{ Request::is('socialIcons*') ? 'active' : '' }}">
    <a href="{{ route('socialIcons.index') }}"><i class="fa fa-edit"></i><span>Social Icons</span></a>
</li>
@endcan

@canany(['web_link_banners-index','web_link_banners-create','web_link_banners-edit','web_link_banners-delete'])
<li class="{{ Request::is('webLinkBanners*') ? 'active' : '' }}">
    <a href="{{ route('webLinkBanners.index') }}"><i class="fa fa-edit"></i><span>Web Link Banners</span></a>
</li>
@endcan

@canany(['offer_banners-index','offer_banners-create','offer_banners-edit','offer_banners-delete'])
<li class="{{ Request::is('offerBanners*') ? 'active' : '' }}">
    <a href="{{ route('offerBanners.index') }}"><i class="fa fa-edit"></i><span>Offer Banners</span></a>
</li>
@endcan

@canany(['purchase_options-index','purchase_options-create','purchase_options-edit','purchase_options-delete'])
<li class="{{ Request::is('purchaseOptions*') ? 'active' : '' }}">
    <a href="{{ route('purchaseOptions.index') }}"><i class="fa fa-edit"></i><span>Purchase Options</span></a>
</li>
@endcan

@canany(['about_uses-index','about_uses-create','about_uses-edit','about_uses-delete'])
<li class="{{ Request::is('aboutUses*') ? 'active' : '' }}">
    <a href="{{ route('aboutUses.index') }}"><i class="fa fa-edit"></i><span>About Uses</span></a>
</li>
@endcan

@canany(['ratings-index','ratings-create','ratings-edit','ratings-delete'])
<li class="{{ Request::is('ratings*') ? 'active' : '' }}">
    <a href="{{ route('ratings.index') }}"><i class="fa fa-edit"></i><span>Ratings</span></a>
</li>
@endcan

@canany(['user_business_details-index','user_business_details-create','user_business_details-edit','user_business_details-delete'])
<li class="{{ Request::is('userBusinessDetails*') ? 'active' : '' }}">
    <a href="{{ route('userBusinessDetails.index') }}"><i class="fa fa-edit"></i><span>User Business Details</span></a>
</li>
@endcan

