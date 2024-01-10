               <!-- topbar -->
               <div class="topbar">
                  <nav class="navbar navbar-expand-lg navbar-light">
                     <div class="full">
                        <div class="row">
                           <div class="col-md-8">
                              @if(Route::currentRouteName() == 'quotations.index')
                                 <button type="button" id="sidebarCollapse" class="sidebar_toggle"><i class="fa fa-bars"></i></button>
                                 <div class="logo_section">
                                    <a href="index.html"><img class="img-responsive" src="{{asset('assets/images/logo/logo_black.png')}}" alt="" width="142" height="72" /></a>
                                 </div>
                                 <div class="left-topbar">
                                    <div class="search_box mr-4">
                                       <input type="text" name="top_search" id="top_search" placeholder="Search by Company Name, No#, and  Items">
                                    </div>
                                    <div class="date-picker-grp">
                                       <div class="date-picker-control mr-4">
                                          <input type="text" class="datepicker-here form-control" id="StartDate" data-date-format="dd/mm/yyyy" data-language='en' placeholder="Start date">
                                          <span class="datepicker-icon"></span>
                                       </div>
                                       <div class="date-picker-control">
                                          <input type="text" class="datepicker-here form-control" id="EndDate" data-date-format="dd/mm/yyyy" data-language='en' placeholder="End date">
                                          <span class="datepicker-icon"></span>
                                       </div>
                                    </div>
                                    <div class="dropdown status-dropdown mx-4">
                                       <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                          Status
                                       </button>
                                       <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                          <a class="dropdown-item" href="#">Open</a>
                                          <a class="dropdown-item" href="#">Close Won</a>
                                          <a class="dropdown-item" href="#">Close Lost</a>
                                          <a class="dropdown-item" href="#">Under Negotiation</a>
                                       </div>
                                    </div>
                                    <div class="search_icon" id="search_result">
                                       <i class='fa fa-search'></i>
                                    </div>
                                 </div>
                              @endif
                           </div>
                           <div class="col-md-4">
                              <div class="right_topbar">
                                 <div class="icon_info">
                                    <ul>
                                       <li class="user_profile_dd">
                                          <a href="#">
                                             <img src="{{asset('assets/images/person-icon.png')}}" alt="" width="16" height="16" class="default-img">
                                             <img src="{{asset('assets/images/person-hover-icon.png')}}" alt="" width="16" height="16" class="hover-img">
                                             Sign in</a>
                                       </li>
                                       <li class="user-settings"><a href="#"><i class="fa fa-cog"></i></a></li>
                                       <li class="user-notification"><a href="#"><i class="fa fa-bell"></i></a></li>
                                    </ul>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </nav>
               </div>
               <!-- end topbar -->