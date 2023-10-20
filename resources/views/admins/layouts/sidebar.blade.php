@php
    $currentRoute = \Request::route()->getName();
@endphp
<aside class="main-sidebar sidebar-admin sidebar-dark-primary elevation-4" style="background-color: #2A3F54;">
    <!-- Brand Logo -->
    <a href="{{route('admin.dashboard')}}" class="brand-link" style="text-align: center;">
      <img  class="brand-image img-circle elevation-3" style="opacity: .8 ">
      <i class="fa fa-university" aria-hidden="true"></i>
      <span class="brand-text font-weight-light">Admin</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset('images/web/avatar.png')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Hello {{auth()->guard('admin')->user()->username}}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">      
          <li class="nav-item {{strpos($currentRoute, 'dashboard') !== false ? 'navbar-active' : ''}}">
            <a href="{{route('admin.dashboard')}}" class="nav-link">
              <i class="fa-solid fa-house"></i>
              <p>Home</p>
            </a>
          </li>
          <li class="nav-item {{strpos($currentRoute, 'user') !== false ? 'navbar-active' : ''}}">
            <a href="{{route('admin.user')}}" class="nav-link">
              <i class="fa-solid fa-users"></i>
              <p>Manage user</p>
            </a>
          </li>
          <li class="nav-item {{strpos($currentRoute, 'animal') !== false ? 'navbar-active' : ''}}">
            <a href="{{route('animal.cases')}}" class="nav-link">
            <i class="fas fa-regular fa-calendar"></i>
              <p>Manage animal cases</p>
            </a>
          </li>
          <li class="nav-item {{strpos($currentRoute, 'adoption-application') !== false ? 'navbar-active' : ''}}">
            <a href="{{route('admin.adoption-application')}}" class="nav-link">
              <i class="fa-solid fa-hand-holding-heart"></i>
              <p>Manage adoption application</p>
            </a>
          </li>
          <li class="nav-item {{strpos($currentRoute, 'donation') !== false ? 'navbar-active' : ''}}">
            <a href="{{route('admin.donation')}}" class="nav-link">
              <i class="fa-solid fa-hand-holding-dollar"></i>
              <p>Manage donation</p>
            </a>
          </li>
          <li class="nav-item {{strpos($currentRoute, 'news') !== false ? 'navbar-active' : ''}}">
            <a href="{{route('admin.news')}}" class="nav-link">
              <i class="fa-brands fa-neos"></i>
              <p>Manage news</p>
            </a>
          </li>
        </ul>
        <div style="margin: 20px">
          <a class="btn-logout" href="{{ route('admin.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout <i class="fa-solid fa-right-from-bracket"></i></a>
          <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
              @csrf
          </form>
        </div>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

