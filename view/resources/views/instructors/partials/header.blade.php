       <!-- START X-NAVIGATION VERTICAL -->
                <ul class="x-navigation x-navigation-horizontal">
                    <li class="xn-logo">
                        <a href="{{url('/instructors/dashboard')}}">SmartSchool</a>
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
                            <span class="fa fa-sign-out"></span>{{trans('user.logout-1')}}
                        </a>                        
                    </li> 
                    <!-- END SIGN OUT --> 

                    <li class="xn-openable pull-right">
                        <a href="#"><span class="fa fa-indent"></span> <span class="xn-text user-name">User name</span></a>
                        <ul class="animated zoomIn">   
                            <li><a href="{{url('/instructors/courses/all')}}"><span class="fa fa-folder-open-o"></span>{{trans('instructor.dashboard-1')}}</a></li>
                            <li><a href="javascript:void(0)"><span class="fa fa-certificate"></span>{{trans('instructor.dashboard-6')}}</a></li>
                            <li><a href="javascript:void(0)"><span class="fa fa-users"></span>{{trans('instructor.dashboard-2')}}</a></li>
                            <li><a href="javascript:void(0)"><span class="fa fa-comments-o"></span>{{trans('instructor.dashboard-3')}}</a></li>
                            <li><a href="javascript:void(0)"><span class="fa fa-phone"></span>{{trans('instructor.dashboard-4')}}</a></li>
                            <li><a href="{{url('/instructors/settings')}}"><span class="fa fa-cogs"></span>{{trans('instructor.dashboard-5')}}</a></li>
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
                    <div class="mb-title"><span class="fa fa-sign-out"></span> <strong>{{trans('user.logout-1')}}</strong> ?</div>
                    <div class="mb-content">
                        <p>{{trans('user.logout-2')}}</p>                    
                        <p>{{trans('user.logout-3')}}</p>
                    </div>
                    <div class="mb-footer">
                        <div class="pull-right">
                            <a href="javascript:void(0)" class="btn btn-success btn-lg" id="logout">{{trans('user.logout-4')}}</a>
                            <button class="btn btn-default btn-lg mb-control-close">{{trans('user.logout-5')}}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END MESSAGE BOX-->           