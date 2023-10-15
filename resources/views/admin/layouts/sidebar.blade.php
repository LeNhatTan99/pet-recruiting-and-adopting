<aside class="main-sidebar sidebar-dark-primary elevation-4" style="background-color: #2A3F54;">
    <!-- Brand Logo -->
    <a href="{{route('admin.dashboard')}}" class="brand-link" style="text-align: center;">
      <img  class="brand-image img-circle elevation-3" style="opacity: .8 ">
      <i class="fa fa-university" aria-hidden="true"></i>
      <span class="brand-text font-weight-light">ADMIN</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset('images/web/avatar.png')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Xin chào </a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">      
          <li class="nav-item">
            <a href="#" class="nav-link">
            <i class=" fas fa-solid fa-bell"></i>
              <p>Thông báo</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="fas fa-solid fa-calendar-minus"></i>  
              <p>Sự kiện</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('animal.cases')}}" class="nav-link">
            <i class="fas fa-regular fa-calendar"></i>
              <p>Manager animal cases</p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

<script>
