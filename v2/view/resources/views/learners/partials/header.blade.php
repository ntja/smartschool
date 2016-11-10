    
                <!-- START X-NAVIGATION VERTICAL -->
                <ul class="x-navigation x-navigation-horizontal">
                    <li class="xn-logo">
                        <a href="{{url('/learners/dashboard')}}">SmartSchool</a>
                        <a href="#" class="x-navigation-control"></a>
                    </li>                    
                    <!-- SEARCH -->
                    <li class="xn-search">
                        <form role="form">
                            <input type="text" name="search" placeholder="Search..."/>
                        </form>
                    </li>   
                    <!-- END SEARCH -->
                     <!-- SIGN OUT -->
                    <li class="pull-right">
                        <a href="#" class="mb-control" data-box="#mb-signout">
                            <span class="fa fa-sign-out"></span>Log out
                        </a>                        
                    </li> 
                    <!-- END SIGN OUT --> 

                    <li class="xn-openable pull-right">
                        <a href="#"><span class="fa fa-indent"></span> <span class="xn-text user-name">User name</span></a>
                        <ul class="animated zoomIn">                                                    
                            <li><a href="{{url('/courses/catalog')}}"><span class="fa fa-search"></span>Courses Catalog</a></li>
                            <li><a href="javascript:void(0)"><span class="fa fa-folder-open-o"></span>My Courses</a></li>
                            <li><a href="javascript:void(0)"><span class="fa fa-book"></span>E-books Library</a></li>
                            <li><a href="javascript:void(0)"><span class="fa fa-phone-square"></span>On Demand Courses</a></li>
                            <li><a href="javascript:void(0)"><span class="fa fa-phone"></span>Private Tutoring</a></li>
                            <li><a href="{{url('/learners/settings')}}"><span class="fa fa-gears"></span>Settings</a></li>
                        </ul>                        
                    </li>                                                   
                    <li class="dropdown">
                        <a href="#" class="dropdown‐toggle" data‐toggle="dropdown">
                        {{ Config::get('languages')[App::getLocale()] }}
                        </a>
                        <ul class="dropdown‐menu">
                         @foreach (Config::get('languages') as $lang => $language)
                            @if ($lang != App::getLocale())
                                <li>
                                <a href="{{ route('lang.switch',  $lang) }}">{{$language}}</a>
                                </li>
                            @endif
                        @endforeach
                        </ul>
                    </li>
                </ul>
                <!-- END X-NAVIGATION VERTICAL -->                     

         <!-- MESSAGE BOX-->
        <div class="message-box animated fadeIn" id="mb-signout">
            <div class="mb-container">
                <div class="mb-middle">
                    <div class="mb-title"><span class="fa fa-sign-out"></span> Log <strong>Out</strong> ?</div>
                    <div class="mb-content">
                        <p>Are you sure you want to log out?</p>                    
                        <p>Press No if you want to continue work. Press Yes to logout.</p>
                    </div>
                    <div class="mb-footer">
                        <div class="pull-right">
                            <a href="javascript:void(0)" class="btn btn-success btn-lg" id="logout" onclick="signOut();">Yes</a>
                            <button class="btn btn-default btn-lg mb-control-close">No</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END MESSAGE BOX-->           