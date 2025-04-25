<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Bootstrap RTL CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.rtl.min.css">




    <style>
        body {
            font-family: 'Cairo', sans-serif;
        }
        .navbar {
            box-shadow: 0 2px 4px rgba(0,0,0,.08);
        }
        .hero-section {
            background: linear-gradient(135deg, #0d6efd 0%, #0dcaf0 100%);
            color: white;
            padding: 80px 0;
        }
        .card {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 .5rem 1rem rgba(0,0,0,.15)!important;
        }
        .course-card .card-img-top {
            height: 200px;
            object-fit: cover;
        }
        .category-card {
            border: none;
            border-radius: 1rem;
        }
        .category-card .card-body {
            padding: 2rem;
        }
        .btn-primary {
            padding: .5rem 1.5rem;
        }
        .footer {
            background: #f8f9fa;
            padding: 4rem 0;
            margin-top: 4rem;
        }
        
        /* WhatsApp Floating Button */
        .whatsapp-float {
            position: fixed;
            width: 60px;
            height: 60px;
            bottom: 30px;
            left: 30px;
            background-color: #25d366;
            color: #FFF;
            border-radius: 50px;
            text-align: center;
            font-size: 30px;
            box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.2);
            z-index: 100;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            animation: pulse 2s infinite;
        }
        
        .whatsapp-float:hover {
            background-color: #128C7E;
            transform: scale(1.1);
            box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.3);
        }
        
        @keyframes pulse {
            0% {
                box-shadow: 0 0 0 0 rgba(37, 211, 102, 0.5);
            }
            70% {
                box-shadow: 0 0 0 15px rgba(37, 211, 102, 0);
            }
            100% {
                box-shadow: 0 0 0 0 rgba(37, 211, 102, 0);
            }
        }



        elevenlabs-convai {
    direction: rtl !important;
    text-align: right !important;
    font-family: 'Cairo', 'Tajawal', sans-serif; /* خطوط عربية مناسبة */
  }

  /* تعديل حاوية المحادثة إذا ظهرت في الزاوية */
  .elevenlabs-widget-container {
    direction: rtl !important;
    text-align: right !important;
  }

  /* لو فيه فقاعة محادثة أو نافذة تظهر */
  .elevenlabs-chat-window,
  .elevenlabs-chat-message {
    direction: rtl !important;
    text-align: right !important;
  }


  a.telegram-float {
    padding: unset;
    position: fixed;
    /* width: 43px; */
    /* height: 68px; */
    bottom: 99px;
    left: 30px;
    font-size: 58px;
}
    </style>


    @stack('styles')
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold text-primary" href="{{ url('/') }}">
                <i class="fas fa-graduation-cap me-2"></i>Digital Hub Egypt
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">
                            <i class="fas fa-home me-1"></i>الرئيسية
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('categories.*') ? 'active' : '' }}" href="{{ route('categories.index') }}">
                            <i class="fas fa-book me-1"></i>التصنيفات 
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('courses.*') ? 'active' : '' }}" href="{{ route('courses.index') }}">
                            <i class="fas fa-book me-1"></i>الدورات
                        </a>
                    </li>

                    
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('payment') ? 'active' : '' }}" href="{{ route('payment') }}">
                            <i class="fas fa-credit-card me-1"></i>طرق الدفع
                        </a>
                    </li>
                    <!-- <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('instructors.*') ? 'active' : '' }}" href="{{ route('instructors.index') }}">
                            <i class="fas fa-book me-1"></i>المحاضرين 
                        </a>
                    </li> -->


                </ul>
                
                <ul class="navbar-nav">
                    @auth
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                                <!-- <img src="{{ Auth::user()->profile_photo_url }}" 
                                     alt="{{ Auth::user()->name }}" 
                                     class="rounded-circle me-2"
                                     width="32"
                                     height="32"> -->
                                {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                @if(Auth::user()->is_admin)
                                    <li>
                                        <a class="dropdown-item" href="{{ route('admin.dashboard') }}">
                                            <i class="fas fa-tachometer-alt me-2"></i>لوحة التحكم
                                        </a>
                                    </li>
                                    <li><hr class="dropdown-divider"></li>
                                @endif
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
                    @else
                        <li class="nav-item">
                            <a class="link btn btn-outline-primary mx-2" href="{{ route('login') }}">
                                <i class="fas fa-sign-in-alt me-1"></i>تسجيل الدخول
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="link btn btn-outline-primary mx-2" href="{{ route('register') }}">
                                <i class="fas fa-user-plus me-1"></i>تسجيل جديد
                            </a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        {{ $slot }}
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t mt-auto py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <h5 class="mb-3">Digital Hub Egypt</h5>
                    <p class="text-muted">منصة تعليمية رائدة في مجال التكنولوجيا والتطوير المهني</p>
                </div>
                <div class="col-md-3">
                    <h5 class="mb-3">روابط سريعة</h5>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('courses.index') }}" class="text-decoration-none">الدورات</a></li>
                        <li><a href="{{ route('instructors.index') }}" class="text-decoration-none">المدربين</a></li>
                        <li><a href="{{ route('about') }}" class="text-decoration-none">عن المنصة</a></li>
                        <li><a href="{{ route('contact') }}" class="text-decoration-none">اتصل بنا</a></li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h5 class="mb-3">معلومات قانونية</h5>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('privacy') }}" class="text-decoration-none">سياسة الخصوصية</a></li>
                        <li><a href="{{ route('terms') }}" class="text-decoration-none">الشروط والأحكام</a></li>
                        @auth
                            <li><a href="{{ route('dashboard') }}" class="text-decoration-none">لوحة التحكم</a></li>
                        @else
                            <li><a href="{{ route('login') }}" class="text-decoration-none">تسجيل الدخول</a></li>
                            <li><a href="{{ route('register') }}" class="text-decoration-none">إنشاء حساب</a></li>
                        @endauth
                    </ul>
                </div>
                <div class="col-md-3">
                    <h5 class="mb-3">تواصل معنا</h5>
                    <div class="d-flex gap-3 mb-3">
                        <a href="https://www.facebook.com/digitalhubteam/" class="text-muted"><i class="fab fa-facebook-f"></i></a>
                        <!-- <a href="https://twitter.com/DigitalHubEgypt" class="text-muted"><i class="fab fa-twitter"></i></a> -->
                        <a href="https://www.instagram.com/digitalhubegy/#" class="text-muted"><i class="fab fa-instagram"></i></a>
                        <a href="https://www.linkedin.com/company/digital-hub-egypt/" class="text-muted"><i class="fab fa-linkedin-in"></i></a>
                        <a href="https://www.youtube.com/@Digitalhubegypt" class="text-muted"><i class="fab fa-youtube"></i></a>
                        <a href="https://www.tiktok.com/@digital_hub_egypt" class="text-muted"><i class="fab fa-tiktok"></i></a>
                    </div>
                    <p class="text-muted mb-0">
                        البريد الإلكتروني: info@digitalhubegypt.com<br>
                        الهاتف: "01066843185"
                    </p>
                </div>
            </div>
            <hr>
            <div class="text-center text-muted">
                <small>&copy; {{ date('Y') }} Digital Hub Egypt. جميع الحقوق محفوظة</small>
            </div>
        </div>
    </footer>




    <!-- ElevenLabs Convai Widget -->
    <elevenlabs-convai agent-id="fKnS71KpRFQpi2GVR64B"></elevenlabs-convai>
    <script src="https://elevenlabs.io/convai-widget/index.js" async type="text/javascript"></script>

    <!-- Telegram Bot Floating Button -->
    <a href="https://t.me/DigitalHub_2020_bot" class="telegram-float" target="_blank" title="تواصل معنا عبر تليجرام">
        <i class="fab fa-telegram"></i>
    </a>


    <!-- WhatsApp Floating Button -->
    <a href="https://wa.me/201066843185" class="whatsapp-float" target="_blank" title="تحدث معنا الآن">
        <i class="fab fa-whatsapp"></i>
    </a>



    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
