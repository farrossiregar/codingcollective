<div id="left-sidebar" class="sidebar">
    <div class="sidebar-scroll">
        <div class="user-account">
            <img src="{{ asset('assets/img/user.png') }}" class="rounded-circle user-photo" alt="User Profile Picture">
            <div class="dropdown">
                <span>Welcome,</span>
                <a href="javascript:void(0);" class="dropdown-toggle user-name" data-toggle="dropdown"><strong>{{ isset(\Auth::user()->name)?\Auth::user()->name :''}}</strong></a>
                <ul class="dropdown-menu dropdown-menu-right account">
                    <li><a href="{{route('profile')}}"><i class="icon-user"></i>My Profile</a></li>
                    <li><a href=""><i class="icon-envelope-open"></i>Messages</a></li>
                    <li><a href="{{route('setting')}}"><i class="icon-settings"></i>Settings</a></li>
                    <li class="divider"></li>
                    <li><a href="#" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();"><i class="icon-power"></i>Logout</a></li>
                </ul>
            </div>
            <hr>
            <ul class="row list-unstyled">
                @if(\Auth::user()->user_access_id==3)<!--Sales and Business Development-->
                <li class="col-4 text-center">
                    <small>Opportunity</small>
                    <h6>{{count_project_status(1)}}</h6>
                </li>
                <li class="col-4 text-center">
                    <small>Successful</small>
                    <h6>{{count_project_status(2)}}</h6>
                </li>
                <li class="col-4 text-center">
                    <small>Unsuccessful</small>
                    <h6>{{count_project_status(3)}}</h6>
                </li>
                @else
                <li class="col-4">
                    <small>Sales</small>
                    <h6>456</h6>
                </li>
                <li class="col-4">
                    <small>Order</small>
                    <h6>1350</h6>
                </li>
                <li class="col-4">
                    <small>Revenue</small>
                    <h6>$2.13B</h6>
                </li>
                @endif
            </ul>
        </div>
        <!-- Nav tabs -->
        <ul class="nav nav-tabs">
            <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#menu">Menu</a></li>
            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#Chat"><i class="icon-book-open"></i></a></li>
            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#setting"><i class="icon-settings"></i></a></li>
            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#question"><i class="icon-question"></i></a></li>                
        </ul>
            
        <!-- Tab panes -->
        <div class="tab-content p-l-0 p-r-0">
            <div class="tab-pane active" id="menu">
                <nav id="left-sidebar-nav" class="sidebar-nav">
                    <ul id="main-menu" class="metismenu">    
                        @if(\Auth::user()->user_access_id==3)<!--Sales and Business Development-->
                        <li class="{{ Request::segment(1) === 'project' ? 'active' : null }}">
                            <a href="{{route('project')}}"><i class="fa fa-database"></i> <span>Projects</span></a>
                        </li>
                        <li class="{{ Request::segment(1) === 'customer' ? 'active' : null }}">
                            <a href="{{route('customer')}}"><i class="fa fa-user"></i> <span>Customer</span></a>
                        </li>
                        @endif
                        @if(\Auth::user()->user_access_id==4)<!--Project Manager-->
                        <li class="{{ Request::segment(1) === 'vendor' ? 'active' : null }}">
                            <a href="{{route('vendor')}}"><i class="fa fa-database"></i> <span>Vendor</span></a>
                        </li>
                        @endif

                        @if(\Auth::user()->user_access_id==1)<!--Administrator-->                   
                        <li class="{{ Request::segment(1) === 'dashboard' ? 'active' : null }}">
                            <a href="#Dashboard" class="has-arrow"><i class="icon-home"></i> <span>Dashboard</span></a>
                            <ul>
                                <li class="{{ Request::segment(2) === 'analytical' ? 'active' : null }}"><a href="">Analytical</a></li>                                    
                            </ul>
                        </li>
                        <li class="{{ (Request::segment(1) === 'users' || Request::segment(1) === 'user-access') ? 'active' : null }}">
                            <a href="#App" class="has-arrow"><i class="icon-grid"></i> <span>Management User</span></a>
                            <ul>
                                <li class="{{ (Request::segment(2) === 'insert' || Request::segment(2) === 'index') ? 'active' : null }}"><a href="{{route('users.index')}}">Users</a></li>
                                <li class="{{ Request::segment(2) === 'access' ? 'active' : null }}"><a href="{{route('user-access.index')}}">Access</a></li>
                            </ul>
                        </li>
                        <li class="{{ Request::segment(1) === 'module' ? 'active' : null }}">
                            <a href="{{route('module.index')}}"><i class="icon-list"></i> <span>Module</span></a>
                        </li>
                        <li class="{{ Request::segment(1) === 'app' ? 'active' : null }}">
                            <a href="#App" class="has-arrow"><i class="icon-grid"></i> <span>Management Sales</span></a>
                            <ul>
                                <li class="{{ Request::segment(2) === 'inbox' ? 'active' : null }}"><a href="">Sales</a></li>
                            </ul>
                        </li>
                        <li class="{{ Request::segment(1) === 'app' ? 'active' : null }}">
                            <a href="#App" class="has-arrow"><i class="icon-grid"></i> <span>Finance</span></a>
                            <ul>
                                <li class="{{ Request::segment(2) === 'inbox' ? 'active' : null }}"><a href="">Finance</a></li>
                                <li class="{{ Request::segment(2) === 'inbox' ? 'active' : null }}"><a href="">Invoice</a></li>
                                <li class="{{ Request::segment(2) === 'inbox' ? 'active' : null }}"><a href="">Accounting</a></li>
                            </ul>
                        </li>
                        <li class="{{ Request::segment(1) === 'app' ? 'active' : null }}">
                            <a href="#App" class="has-arrow"><i class="icon-grid"></i> <span>Project Management</span></a>
                            <ul>
                                <li class="{{ Request::segment(2) === 'inbox' ? 'active' : null }}"><a href="">Projects</a></li>
                            </ul>
                        </li>
                        @endif
                    </ul>
                </nav>
            </div>
            <div class="tab-pane p-l-15 p-r-15" id="Chat">
                <form>
                    <div class="input-group m-b-20">
                        <div class="input-group-prepend">
                            <span class="input-group-text" ><i class="icon-magnifier"></i></span>
                        </div>
                        <input type="text" class="form-control" placeholder="Search...">
                    </div>
                </form>
                <ul class="right_chat list-unstyled">
                    <li class="online">
                        <a href="javascript:void(0);">
                            <div class="media">
                                <img class="media-object " src="{{ asset('assets/img/xs/avatar4.jpg') }}" alt="">
                                <div class="media-body">
                                    <span class="name">Chris Fox</span>
                                    <span class="message">Designer, Blogger</span>
                                    <span class="badge badge-outline status"></span>
                                </div>
                            </div>
                        </a>                            
                    </li>
                    <li class="online">
                        <a href="javascript:void(0);">
                            <div class="media">
                                <img class="media-object " src="{{ asset('assets/img/xs/avatar5.jpg') }}" alt="">
                                <div class="media-body">
                                    <span class="name">Joge Lucky</span>
                                    <span class="message">Java Developer</span>
                                    <span class="badge badge-outline status"></span>
                                </div>
                            </div>
                        </a>                            
                    </li>
                    <li class="offline">
                        <a href="javascript:void(0);">
                            <div class="media">
                                <img class="media-object " src="{{ asset('assets/img/xs/avatar2.jpg') }}" alt="">
                                <div class="media-body">
                                    <span class="name">Isabella</span>
                                    <span class="message">CEO, Thememakker</span>
                                    <span class="badge badge-outline status"></span>
                                </div>
                            </div>
                        </a>                            
                    </li>
                    <li class="offline">
                        <a href="javascript:void(0);">
                            <div class="media">
                                <img class="media-object " src="{{ asset('assets/img/xs/avatar1.jpg') }}" alt="">
                                <div class="media-body">
                                    <span class="name">Folisise Chosielie</span>
                                    <span class="message">Art director, Movie Cut</span>
                                    <span class="badge badge-outline status"></span>
                                </div>
                            </div>
                        </a>                            
                    </li>
                    <li class="online">
                        <a href="javascript:void(0);">
                            <div class="media">
                                <img class="media-object " src="{{ asset('assets/img/xs/avatar3.jpg') }}" alt="">
                                <div class="media-body">
                                    <span class="name">Alexander</span>
                                    <span class="message">Writter, Mag Editor</span>
                                    <span class="badge badge-outline status"></span>
                                </div>
                            </div>
                        </a>                            
                    </li>                        
                </ul>
            </div>
            <div class="tab-pane p-l-15 p-r-15" id="setting">
                <h6>Choose Skin</h6>
                <ul class="choose-skin list-unstyled">
                    <li data-theme="purple">
                        <div class="purple"></div>
                        <span>Purple</span>
                    </li>                   
                    <li data-theme="blue">
                        <div class="blue"></div>
                        <span>Blue</span>
                    </li>
                    <li data-theme="cyan" class="active">
                        <div class="cyan"></div>
                        <span>Cyan</span>
                    </li>
                    <li data-theme="green">
                        <div class="green"></div>
                        <span>Green</span>
                    </li>
                    <li data-theme="orange">
                        <div class="orange"></div>
                        <span>Orange</span>
                    </li>
                    <li data-theme="blush">
                        <div class="blush"></div>
                        <span>Blush</span>
                    </li>
                </ul>
                <hr>
                <h6>General Settings</h6>
                <ul class="setting-list list-unstyled">
                    <li>
                        <label class="fancy-checkbox">
                            <input type="checkbox" name="checkbox">
                            <span>Report Panel Usag</span>
                        </label>
                    </li>
                    <li>
                        <label class="fancy-checkbox">
                            <input type="checkbox" name="checkbox" checked>
                            <span>Email Redirect</span>
                        </label>
                    </li>
                    <li>
                        <label class="fancy-checkbox">
                            <input type="checkbox" name="checkbox" checked>
                            <span>Notifications</span>
                        </label>                      
                    </li>
                    <li>
                        <label class="fancy-checkbox">
                            <input type="checkbox" name="checkbox">
                            <span>Auto Updates</span>
                        </label>
                    </li>
                    <li>
                        <label class="fancy-checkbox">
                            <input type="checkbox" name="checkbox">
                            <span>Offline</span>
                        </label>
                    </li>
                    <li>
                        <label class="fancy-checkbox">
                            <input type="checkbox" name="checkbox">
                            <span>Location Permission</span>
                        </label>
                    </li>
                </ul>
            </div>
            <div class="tab-pane p-l-15 p-r-15" id="question">
                <form>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" ><i class="icon-magnifier"></i></span>
                        </div>
                        <input type="text" class="form-control" placeholder="Search...">
                    </div>
                </form>
                <ul class="list-unstyled question">
                    <li class="menu-heading">HOW-TO</li>
                    <li><a href="javascript:void(0);">How to Create Campaign</a></li>
                    <li><a href="javascript:void(0);">Boost Your Sales</a></li>
                    <li><a href="javascript:void(0);">Website Analytics</a></li>
                    <li class="menu-heading">ACCOUNT</li>
                    <li><a href="javascript:void(0);">Cearet New Account</a></li>
                    <li><a href="javascript:void(0);">Change Password?</a></li>
                    <li><a href="javascript:void(0);">Privacy &amp; Policy</a></li>
                    <li class="menu-heading">BILLING</li>
                    <li><a href="javascript:void(0);">Payment info</a></li>
                    <li><a href="javascript:void(0);">Auto-Renewal</a></li>                        
                    <li class="menu-button m-t-30">
                        <a href="javascript:void(0);" class="btn btn-primary"><i class="icon-question"></i> Need Help?</a>
                    </li>
                </ul>
            </div>                
        </div>          
    </div>
</div>
