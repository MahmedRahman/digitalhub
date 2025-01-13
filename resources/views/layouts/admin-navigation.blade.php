<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('admin.dashboard') }}">
            <img src="{{ asset('images/general/logo.svg') }}" alt="Logo" height="30">
        </a>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#adminNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="adminNavbar">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" 
                       href="{{ route('admin.dashboard') }}">
                        <i class="fas fa-tachometer-alt me-1"></i>لوحة التحكم
                    </a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.courses.*') ? 'active' : '' }}" 
                       href="{{ route('admin.courses.index') }}">
                        <i class="fas fa-graduation-cap me-1"></i>الدورات
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.instructors.*') ? 'active' : '' }}" 
                       href="{{ route('admin.instructors.index') }}">
                        <i class="fas fa-chalkboard-teacher me-1"></i>المدربين
                    </a>
                </li>

                <li class="nav-item">
                    <x-nav-link :href="route('admin.enrollments.index')" :active="request()->routeIs('admin.enrollments.*')">
                        <i class="fas fa-user-graduate me-2"></i>
                        طلبات الاشتراك
                        @if($pendingEnrollments > 0)
                            <span class="badge bg-danger">{{ $pendingEnrollments }}</span>
                        @endif
                    </x-nav-link>
                </li>

                <li class="nav-item">
                    <x-nav-link :href="route('admin.approved-courses.index')" :active="request()->routeIs('admin.approved-courses.*')">
                        <i class="fas fa-check-circle me-2"></i>
                        الكورسات المعتمدة
                    </x-nav-link>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}" 
                       href="{{ route('admin.categories.index') }}">
                        <i class="fas fa-folder me-1"></i>التصنيفات
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.hero-sections.*') ? 'active' : '' }}" 
                       href="{{ route('admin.hero-sections.index') }}">
                        <i class="fas fa-image me-1"></i>البانر الرئيسي
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.specializations.*') ? 'active' : '' }}" 
                       href="{{ route('admin.specializations.index') }}">
                        <i class="fas fa-tags me-1"></i>التخصصات
                    </a>
                </li>
            </ul>

            <ul class="navbar-nav ms-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                        <img src="{{ Auth::user()->profile_photo_url }}" 
                             alt="{{ Auth::user()->name }}" 
                             class="rounded-circle me-2"
                             width="32">
                        {{ Auth::user()->name }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                <i class="fas fa-user me-2"></i>الملف الشخصي
                            </a>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item text-danger">
                                    <i class="fas fa-sign-out-alt me-2"></i>تسجيل الخروج
                                </button>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
