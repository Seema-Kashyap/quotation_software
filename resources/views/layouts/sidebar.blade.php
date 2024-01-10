<nav id="sidebar">
   <div class="sidebar_blog_1">
      <div class="sidebar-header">
         <div class="logo_section">
            <a href=""><img class="logo_icon img-responsive" src="{{asset('assets/images/logo/logo_black.png')}}" alt="" width="142" height="72" /></a>
         </div>
      </div>
      <div class="sidebar_user_info">
         <div class="icon_setting"></div>
         <div class="user_profle_side">
            <div class="user_img">
               <a class="sidebar-logo" href="#">
                  <img class="img-responsive" src="{{asset('assets/images/logo/logo_black.png')}}" alt="" width="142" height="72" />
               </a>
            </div>
         </div>
      </div>
   </div>
   <div class="sidebar_blog_2">
      <ul class="list-unstyled components">
         <li class="@if(Route::currentRouteName() == 'dashboard.index') active @endif">
            <a href="{{route('dashboard.index')}}">
               <span class="sidebar-icon">
                  <img src="{{asset('assets/images/home-icon.png')}}" alt="" width="16" height="16" class="default-img">
                  <img src="{{asset('assets/images/home-hover-icon.png')}}" alt="" width="16" height="16" class="hover-img">
               </span>
               <span>Dashboard</span>
            </a>
         </li>
         <li class="@if(Route::currentRouteName() == 'quotations.index') active @endif">
            <a href="{{route('quotations.index')}}">
               <span class="sidebar-icon">
                  <img src="{{asset('assets/images/edit-icon.png')}}" alt="" width="16" height="16" class="default-img">
                  <img src="{{asset('assets/images/edit-icon-hover.png')}}" alt="" width="16" height="16" class="hover-img">
               </span>
               <span>Quotation</span>
            </a>
         </li>
         <li class="@if(Route::currentRouteName() == 'items.index') active @endif">
            <a href="{{route('items.index')}}">
               <span class="sidebar-icon">
                  <img src="{{asset('assets/images/settings-icon.png')}}" alt="" width="20" height="20" class="default-img">
                  <img src="{{asset('assets/images/settings-hover-icon.png')}}" alt="" width="20" height="20" class="hover-img">
               </span>
               <span>Items</span>
            </a>
         </li>
         <li class="@if(Route::currentRouteName() == 'customers.index') active @endif">
            <a href="{{route('customers.index')}}">
               <span class="sidebar-icon">
                  <img src="{{asset('assets/images/person-icon.png')}}" alt="" width="16" height="16" class="default-img">
                  <img src="{{asset('assets/images/person-hover-icon.png')}}" alt="" width="16" height="16" class="hover-img">
               </span>
               <span>Customers</span></a>
         </li>
      </ul>
   </div>
</nav>