<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="{{ asset('adminlte/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('adminlte/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2"
                    alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">
                    @if (auth()->check())
                        {{ auth()->user()->name }}
                    @endif
                </a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                @can('employee-list')
                    <li class="nav-item">
                        <a href="{{ route('nhanvien.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-th"></i>
                            <p>
                                Danh sách nhân viên
                            </p>
                        </a>
                    </li>
                @endcan

                @can('department-list')
                    <li class="nav-item">
                        <a href="{{ route('phongban.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-th"></i>
                            <p>
                                Danh sách phòng ban
                            </p>
                        </a>
                    </li>
                @endcan

                @can('degree-list')
                    <li class="nav-item">
                        <a href="{{ route('degree.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-th"></i>
                            <p>
                                Danh sách bằng cấp
                            </p>
                        </a>
                    </li>
                @endcan

                @can('user-list')
                    <li class="nav-item">
                        <a href="{{ route('users.index') }}" class="nav-link">
                            <i class="nav-icon fa-solid fa-user"></i>
                            <p>
                                Danh sách tài khoản
                            </p>
                        </a>
                    </li>
                @endcan

                @can('role-list')
                    <li class="nav-item">
                        <a href="{{ route('roles.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-th"></i>
                            <p>
                                Danh sách vai trò (Roles)
                            </p>
                        </a>
                    </li>
                @endcan

                @can('is_admin')
                    <li class="nav-item">
                        <a href="{{ route('permissions.create') }}" class="nav-link">
                            <p>
                                Tạo dữ liệu bảng Permissions
                            </p>
                        </a>
                    </li>
                @endcan
                <li class="nav-item">
                    <a href="{{ route('logout') }}" class="nav-link">
                        <i class="nav-icon  fas fa-sign-out-alt"></i>
                        <p>
                            Đăng xuất
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
