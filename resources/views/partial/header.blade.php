<style type="text/css">
    .active-site{
        background-color: #f4f4f4;
    }
</style>

<header class="main-header">
    <!-- Logo -->
    <a href="{!! url('/') !!}" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg">Inventory</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- Messages: style can be found in dropdown.less-->

                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-user"></i> <span class="hidden-xs">Your Account</span>
                    </a>
                    <ul class="dropdown-menu">
                      <!-- User image -->
                      <li class="user-header">
                         <img src="{!! GLobalHelp::checkImage(Auth::user()->photo) !!}" class="img-circle" alt="User Image"/>
                        <p>
                          {!! Auth::user()->name !!}
                          <small>Member since {!! GLobalHelp::formatDate(Auth::user()->created_at, 'd F Y') !!}</small>
                        </p>
                      </li>
                      <!-- Menu Footer-->
                      <li class="user-footer">
                        <div class="pull-left">
                          <a href="{!! url('/users/my-profil') !!}" class="btn btn-default btn-flat">Profile</a>
                        </div>
                        <div class="pull-right">
                          <a href="{!! url('auth/logout') !!}" class="btn btn-default btn-flat">Sign out</a>
                        </div>
                      </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>
