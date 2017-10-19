 <div class="off-canvas-overlay" data-toggle="sidebar"></div>
      <div class="sidebar-panel">
        <div class="brand">
          <!-- toggle offscreen menu -->
          <a href="javascript:;" data-toggle="sidebar" class="toggle-offscreen hidden-lg-up">
            <i class="material-icons">menu</i>
          </a>
          <!-- /toggle offscreen menu -->
          <!-- logo -->
          <a class="brand-logo">
            <img class="expanding-hidden" src="{{ asset('assets/admin/images/logo.png') }}" alt=""/>
          </a>
          <!-- /logo -->
        </div>
        <div class="nav-profile dropdown">
          <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
            <div class="user-image">
              <img src="{{Auth::user()->profile->avatar}}" class="avatar img-circle" alt="user" title="user"/>
            </div>
            <div class="user-info expanding-hidden">
             {{Auth::user()->email}}
              <small class="bold">{{Auth::user()->getRoleNames()[0]}}</small>
            </div>
          </a>
          <div class="dropdown-menu">
            <a class="dropdown-item" href="javascript:;">Settings</a>
            <a class="dropdown-item" href="javascript:;">Upgrade</a>
            <a class="dropdown-item" href="javascript:;">
              <span>Notifications</span>
              <span class="tag bg-primary">34</span>
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="javascript:;">Help</a>
            <a class="dropdown-item" href="{{ url('/admin/logout') }}">Logout</a>
          </div>
        </div>
        <!-- main navigation -->
        <nav>
          <p class="nav-title">NAVIGATION</p>
          <ul class="nav">
            <!-- dashboard -->
            <li>
              <a href="{{ url('/admin/home') }}">
                <i class="material-icons text-primary">home</i>
                <span>Home</span>
              </a>
            </li>
            <!-- /dashboard -->
            <!-- apps -->
              <li>
              <a href="{{ url('/admin/categories') }}">
                <i class="material-icons text-success">format_list_numbered</i>
                <span>Category</span>
              </a>
            </li>
            <!-- /apps -->
            <!-- ui -->
              <li>
              <a href="index.html">
                <i class="material-icons text-danger"> local_offer</i>
                <span>Tag</span>
              </a>
            </li>
            <!-- /ui -->
            <!-- charts -->
              <li>
              <a href="{{ url('admin/users') }}">
                <i class="material-icons text-info">account_box</i>
                <span>User</span>
              </a>
            </li>
             <li>
              <a href="index.html">
                <i class="material-icons text-warning">fingerprint</i>
                <span>Permission</span>
              </a>
            </li>
             <li>
              <a href="{{ url('admin/roles') }}">
                <i class="material-icons text-justify"> people</i>
                <span>Role</span>
              </a>
            </li>
            <!-- /charts -->
          </ul>
        </nav>
        <!-- /main navigation -->
      </div>