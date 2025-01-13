<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Digital Hub Egypt') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" rel="stylesheet" />

    <!-- Bootstrap RTL CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.rtl.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        :root {
            --sidebar-width: 280px;
            --sidebar-bg: #ffffff;
            --sidebar-hover: #f8f9fa;
            --primary-color: #0d6efd;
            --text-muted: #6c757d;
        }

        body {
            font-family: 'Cairo', sans-serif;
            background-color: #f8f9fa;
            min-height: 100vh;
        }

        /* Sidebar Styles */
        .sidebar {
            width: var(--sidebar-width);
            position: fixed;
            right: 0;
            top: 0;
            bottom: 0;
            background: var(--sidebar-bg);
            box-shadow: -2px 0 10px rgba(0,0,0,.05);
            z-index: 1000;
            transition: all 0.3s ease;
            overflow-y: auto;
        }

        .sidebar-header {
            padding: 1.5rem;
            text-align: center;
            border-bottom: 1px solid rgba(0,0,0,.05);
        }

        .sidebar .nav-pills {
            padding: 1rem;
        }

        .sidebar .nav-link {
            color: var(--text-muted);
            padding: 0.8rem 1.2rem;
            margin-bottom: 0.5rem;
            border-radius: 8px;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            font-size: 0.95rem;
        }

        .sidebar .nav-link i {
            margin-left: 12px;
            width: 20px;
            font-size: 1.1rem;
            text-align: center;
            transition: all 0.2s ease;
        }

        .sidebar .nav-link:hover {
            color: var(--primary-color);
            background-color: var(--sidebar-hover);
            transform: translateX(-5px);
        }

        .sidebar .nav-link.active {
            color: #fff;
            background: linear-gradient(45deg, var(--primary-color), #0b5ed7);
            box-shadow: 0 2px 6px rgba(13, 110, 253, 0.2);
        }

        .sidebar .nav-link.active i {
            color: #fff;
        }

        /* Navigation Categories */
        .nav-category {
            color: var(--text-muted);
            font-size: 0.8rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 1.5rem 1.2rem 0.5rem;
        }

        /* Logout Button */
        .nav-link.logout-link {
            color: #dc3545;
            margin-top: 1rem;
            border: 1px solid rgba(220, 53, 69, 0.1);
        }

        .nav-link.logout-link:hover {
            background-color: #dc3545;
            color: #fff;
        }

        .nav-link.logout-link:hover i {
            color: #fff;
        }

        /* Main Content */
        .main-content {
            margin-right: var(--sidebar-width);
            padding: 2rem;
            min-height: 100vh;
            transition: all 0.3s ease;
        }

        /* Mobile Responsiveness */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(var(--sidebar-width));
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .main-content {
                margin-right: 0;
            }

            .mobile-overlay {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: rgba(0,0,0,0.5);
                z-index: 999;
            }

            .mobile-overlay.show {
                display: block;
            }
        }

        /* Custom Scrollbar */
        .sidebar::-webkit-scrollbar {
            width: 6px;
        }

        .sidebar::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        .sidebar::-webkit-scrollbar-thumb {
            background: #ddd;
            border-radius: 3px;
        }

        .sidebar::-webkit-scrollbar-thumb:hover {
            background: #ccc;
        }

        /* Card Styles */
        .card {
            background: #fff;
            border: none;
            box-shadow: 0 0 20px rgba(0,0,0,.05);
            border-radius: 12px;
            transition: all 0.3s ease;
        }

        .card:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 25px rgba(0,0,0,.1);
        }
    </style>
</head>
<body>
    <!-- Mobile Overlay -->
    <div class="mobile-overlay"></div>
    
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- <div class="sidebar-header">
            <a href="{{ route('dashboard') }}" class="text-decoration-none">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500 w-50" />
            </a>
        </div> -->

        <nav class="mt-2">
            <div class="nav-category">القائمة الرئيسية</div>
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                
            
            <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <i class="fas fas fa-tachometer-alt"></i>
                        <span>لوحة التحكم</span>
                    </a>
                </li>
            
                <li class="nav-item">
                    <a href="{{ route('courses.index') }}" class="nav-link {{ request()->routeIs('courses.*') ? 'active' : '' }}">
                        <i class="fas fas fa-graduation-cap"></i>
                        <span>الموقع الرئيسي</span>
                    </a>
                </li>
             
                @if(auth()->user()->type === 'admin')


                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.hero-sections.*') ? 'active' : '' }}" 
                       href="{{ route('admin.hero-sections.index') }}">
                        <i class="fas fa-image me-1"></i>البانر الرئيسي
                    </a>
                </li>


                    <div class="nav-category">إدارة المحتوى</div>


                    <li class="nav-item">
                        <a href="{{ route('admin.users.index') }}" 
                           class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                            <i class="fas fa-list"></i>
                            <span>إدارة المستخدمين</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.categories.index') }}" 
                           class="nav-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                            <i class="fas fa-list"></i>
                            <span>إدارة الأقسام</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.instructors.index') }}" 
                           class="nav-link {{ request()->routeIs('admin.instructors.*') ? 'active' : '' }}">
                            <i class="fas fa-chalkboard-teacher"></i>
                            <span>إدارة المدربين</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.specializations.index') }}" 
                           class="nav-link {{ request()->routeIs('admin.specializations.*') ? 'active' : '' }}">
                            <i class="fas fa-graduation-cap"></i>
                            <span>إدارة التخصصات</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.courses.index') }}" 
                           class="nav-link {{ request()->routeIs('admin.courses.*') ? 'active' : '' }}">
                            <i class="fas fa-book"></i>
                            <span>إدارة الدورات</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.enrollments.index') }}" 
                           class="nav-link {{ request()->routeIs('admin.enrollments.*') ? 'active' : '' }}">
                            <i class="fas fa-user-graduate"></i>
                            <span>طلبات الاشتراك</span>
                        </a>
                    </li>
                @endif

                <div class="nav-category">حسابي</div>
                <li class="nav-item">
                    <a href="{{ route('profile.edit') }}" 
                       class="nav-link {{ request()->routeIs('profile.edit') ? 'active' : '' }}">
                        <i class="fas fa-user-circle"></i>
                        <span>الملف الشخصي</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('user.enrolled-courses') }}" 
                       class="nav-link {{ request()->routeIs('user.enrolled-courses') ? 'active' : '' }}">
                        <i class="fas fa-graduation-cap"></i>
                        <span>دوراتي المسجلة</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('user.my-enrollments') }}" 
                       class="nav-link {{ request()->routeIs('user.my-enrollments') ? 'active' : '' }}">
                        <i class="fas fa-clipboard-list"></i>
                        <span>طلبات الاشتراك</span>
                    </a>
                </li>

                <li class="nav-item">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a href="{{ route('logout') }}"
                           onclick="event.preventDefault(); this.closest('form').submit();"
                           class="nav-link logout-link">
                            <i class="fas fa-sign-out-alt"></i>
                            <span>تسجيل الخروج</span>
                        </a>
                    </form>
                </li>
            </ul>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <main>
            {{ $slot }}
        </main>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Mobile Menu Toggle Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Create toggle button
            const toggleButton = document.createElement('button');
            toggleButton.className = 'btn btn-primary position-fixed d-md-none';
            toggleButton.style.cssText = 'top: 1rem; right: 1rem; z-index: 1001; width: 45px; height: 45px; border-radius: 50%;';
            toggleButton.innerHTML = '<i class="fas fa-bars"></i>';
            
            // Create overlay
            const overlay = document.querySelector('.mobile-overlay');
            
            // Get sidebar
            const sidebar = document.querySelector('.sidebar');
            
            // Add toggle button to body
            document.body.appendChild(toggleButton);
            
            // Toggle sidebar
            toggleButton.addEventListener('click', function() {
                sidebar.classList.toggle('show');
                overlay.classList.toggle('show');
            });
            
            // Close sidebar when clicking overlay
            overlay.addEventListener('click', function() {
                sidebar.classList.remove('show');
                overlay.classList.remove('show');
            });
            
            // Close sidebar on window resize if open
            window.addEventListener('resize', function() {
                if (window.innerWidth > 768) {
                    sidebar.classList.remove('show');
                    overlay.classList.remove('show');
                }
            });
        });
    </script>

    <!-- Select2 JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                theme: 'bootstrap-5',
                dir: 'rtl',
                language: 'ar',
                placeholder: 'اختر المدربين',
                allowClear: true
            });
        });
    </script>
</body>
</html>
