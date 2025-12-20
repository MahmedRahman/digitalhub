<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>{{ config('app.name', 'Laravel') }}</title>
    
    <!-- Preload critical resources -->
    <link rel="preload" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.rtl.min.css" as="style">
    <link rel="preload" href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" as="style">
    
    <!-- Optimized Fonts - Arabic fonts similar to lrnn.ai -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700;800&family=Tajawal:wght@300;400;500;700;800&family=IBM+Plex+Sans+Arabic:wght@300;400;500;600;700&family=Almarai:wght@300;400;700;800&display=swap" rel="stylesheet">
    
    <!-- Faux Arabic Font - Using similar alternative -->
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Arabic:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome - load with non-blocking technique -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" media="print" onload="this.media='all'">
    <noscript><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"></noscript>
    
    <!-- Bootstrap RTL CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.rtl.min.css">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">

    <style>
        /* Typography - Matching lrnn.ai style */
        :root {
            --font-primary: 'IBM Plex Sans Arabic', 'Almarai', 'Cairo', 'Tajawal', sans-serif;
            --font-faux-arabic: 'IBM Plex Sans Arabic', 'Almarai', sans-serif;
            --font-size-xs: 0.75rem;      /* 12px */
            --font-size-sm: 0.875rem;     /* 14px */
            --font-size-base: 1rem;       /* 16px */
            --font-size-lg: 1.125rem;     /* 18px */
            --font-size-xl: 1.25rem;      /* 20px */
            --font-size-2xl: 1.5rem;      /* 24px */
            --font-size-3xl: 1.875rem;    /* 30px */
            --font-size-4xl: 2.25rem;     /* 36px */
            --font-size-5xl: 3rem;        /* 48px */
            --font-weight-light: 300;
            --font-weight-normal: 400;
            --font-weight-medium: 500;
            --font-weight-semibold: 600;
            --font-weight-bold: 700;
            --font-weight-extrabold: 800;
            --line-height-tight: 1.25;
            --line-height-normal: 1.5;
            --line-height-relaxed: 1.75;
        }

        body {
            font-family: var(--font-primary);
            font-size: var(--font-size-base);
            font-weight: var(--font-weight-normal);
            line-height: var(--line-height-normal);
            color: #1a1a1a;
        }

        /* Faux Arabic Font for Course Page */
        @font-face {
            font-family: 'Faux Arabic';
            src: url('{{ asset("fonts/FauxArabic.woff2") }}') format('woff2'),
                 url('{{ asset("fonts/FauxArabic.woff") }}') format('woff'),
                 url('{{ asset("fonts/FauxArabic.ttf") }}') format('truetype');
            font-weight: normal;
            font-style: normal;
            font-display: swap;
        }

        .course-page-wrapper,
        .course-page-wrapper * {
            font-family: 'Faux Arabic', var(--font-faux-arabic) !important;
        }

        /* Ensure proper font rendering */
        .course-page-wrapper {
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            text-rendering: optimizeLegibility;
        }

        /* Headings - Matching lrnn.ai typography */
        h1, .h1 {
            font-size: var(--font-size-4xl);
            font-weight: var(--font-weight-bold);
            line-height: var(--line-height-tight);
            margin-bottom: 1.5rem;
        }

        h2, .h2 {
            font-size: var(--font-size-3xl);
            font-weight: var(--font-weight-bold);
            line-height: var(--line-height-tight);
            margin-bottom: 1.25rem;
        }

        h3, .h3 {
            font-size: var(--font-size-2xl);
            font-weight: var(--font-weight-semibold);
            line-height: var(--line-height-tight);
            margin-bottom: 1rem;
        }

        h4, .h4 {
            font-size: var(--font-size-xl);
            font-weight: var(--font-weight-semibold);
            line-height: var(--line-height-normal);
            margin-bottom: 0.875rem;
        }

        h5, .h5 {
            font-size: var(--font-size-lg);
            font-weight: var(--font-weight-semibold);
            line-height: var(--line-height-normal);
            margin-bottom: 0.75rem;
        }

        h6, .h6 {
            font-size: var(--font-size-base);
            font-weight: var(--font-weight-semibold);
            line-height: var(--line-height-normal);
            margin-bottom: 0.5rem;
        }

        /* Display headings for hero sections */
        .display-1 {
            font-size: var(--font-size-5xl);
            font-weight: var(--font-weight-extrabold);
            line-height: var(--line-height-tight);
        }

        .display-2 {
            font-size: calc(var(--font-size-5xl) * 0.875);
            font-weight: var(--font-weight-extrabold);
            line-height: var(--line-height-tight);
        }

        .display-3 {
            font-size: calc(var(--font-size-4xl) * 1.1);
            font-weight: var(--font-weight-bold);
            line-height: var(--line-height-tight);
        }

        .display-4 {
            font-size: var(--font-size-4xl);
            font-weight: var(--font-weight-bold);
            line-height: var(--line-height-tight);
        }

        .display-5 {
            font-size: var(--font-size-3xl);
            font-weight: var(--font-weight-bold);
            line-height: var(--line-height-tight);
        }

        /* Lead text */
        .lead {
            font-size: var(--font-size-lg);
            font-weight: var(--font-weight-normal);
            line-height: var(--line-height-relaxed);
        }

        /* Small text */
        small, .small {
            font-size: var(--font-size-sm);
            font-weight: var(--font-weight-normal);
        }

        /* Course page specific typography */
        .course-title {
            font-size: var(--font-size-4xl);
            font-weight: var(--font-weight-bold);
            line-height: var(--line-height-tight);
            color: #1a1a1a;
        }

        .course-description {
            font-size: var(--font-size-lg);
            font-weight: var(--font-weight-normal);
            line-height: var(--line-height-relaxed);
            color: #4a5568;
        }

        .course-info-label {
            font-size: var(--font-size-sm);
            font-weight: var(--font-weight-medium);
            color: #718096;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .course-info-value {
            font-size: var(--font-size-base);
            font-weight: var(--font-weight-semibold);
            color: #1a1a1a;
        }

        /* Card titles */
        .card-title {
            font-size: var(--font-size-xl);
            font-weight: var(--font-weight-semibold);
            line-height: var(--line-height-tight);
        }

        /* Button text */
        .btn {
            font-weight: var(--font-weight-medium);
            font-size: var(--font-size-base);
        }

        .btn-lg {
            font-size: var(--font-size-lg);
            padding: 0.75rem 1.5rem;
        }

        .btn-sm {
            font-size: var(--font-size-sm);
            padding: 0.375rem 0.75rem;
        }

        /* Course page specific styles matching lrnn.ai */
        .course-info-box {
            background: #f8f9fa;
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .course-info-box h6 {
            font-size: var(--font-size-xs);
            font-weight: var(--font-weight-semibold);
            color: #718096;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-bottom: 0.5rem;
        }

        .course-info-box h4 {
            font-size: var(--font-size-xl);
            font-weight: var(--font-weight-bold);
            color: #1a1a1a;
            margin-bottom: 0;
        }

        /* Breadcrumb styling */
        .breadcrumb {
            font-size: var(--font-size-sm);
            margin-bottom: 1.5rem;
        }

        .breadcrumb-item a {
            color: #4a5568;
            text-decoration: none;
        }

        .breadcrumb-item.active {
            color: #1a1a1a;
            font-weight: var(--font-weight-medium);
        }

        /* Course Hero Image */
        .course-hero-image {
            width: 100%;
            overflow: hidden;
        }

        .course-hero-image img {
            width: 100%;
            height: 400px;
            object-fit: cover;
        }

        /* Lesson Items with Numbers */
        .lesson-item {
            transition: all 0.3s ease;
        }

        .lesson-item:hover {
            background-color: #f8f9fa;
            border-radius: 8px;
            padding: 1rem !important;
            margin-left: -1rem;
            margin-right: -1rem;
        }

        .lesson-number .badge {
            font-size: 1.1rem;
            min-width: 48px;
            min-height: 48px;
            box-shadow: 0 2px 8px rgba(13, 110, 253, 0.2);
        }

        .lesson-title {
            font-size: var(--font-size-xl);
            font-weight: var(--font-weight-semibold);
            color: #1a1a1a;
            line-height: 1.4;
        }

        .lesson-details {
            line-height: 1.6;
        }

        .lesson-item {
            padding: 0.5rem;
            margin: 0 -0.5rem;
            border-radius: 8px;
        }

        /* Course Content Styling */
        .course-content-html h2,
        .course-content-html h3 {
            font-size: var(--font-size-xl);
            font-weight: var(--font-weight-semibold);
            margin-top: 2rem;
            margin-bottom: 1rem;
            color: #1a1a1a;
        }

        .course-content-html h2:first-child,
        .course-content-html h3:first-child {
            margin-top: 0;
        }

        .course-content-html ul,
        .course-content-html ol {
            padding-right: 1.5rem;
            margin-bottom: 1rem;
        }

        .course-content-html li {
            margin-bottom: 0.5rem;
            line-height: 1.75;
        }

        /* Card improvements */
        .card {
            border-radius: 12px;
            border: none;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .card-img-top {
            transition: transform 0.3s ease;
        }

        .card:hover .card-img-top {
            transform: scale(1.05);
        }

        /* Landing Page Hero Section */
        .course-hero-section {
            min-height: 600px;
            display: flex;
            align-items: center;
            position: relative;
        }

        .hero-background {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 1;
        }

        .hero-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .hero-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(13, 110, 253, 0.85) 0%, rgba(108, 117, 125, 0.75) 100%);
        }

        /* Info Boxes in Hero */
        .info-box {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            border-radius: 12px;
            padding: 1rem;
            text-align: center;
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: all 0.3s ease;
        }

        .info-box:hover {
            background: rgba(255, 255, 255, 0.25);
            transform: translateY(-5px);
        }

        .info-icon {
            font-size: 1.5rem;
            color: white;
            margin-bottom: 0.5rem;
        }

        .info-label {
            font-size: 0.75rem;
            color: rgba(255, 255, 255, 0.8);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 0.25rem;
        }

        .info-value {
            font-size: 1.1rem;
            font-weight: 700;
            color: white;
        }

        /* Enrollment Card Animation */
        .enrollment-card {
            position: sticky;
            top: 20px;
        }

        /* Animations */
        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideLeft {
            from {
                opacity: 0;
                transform: translateX(30px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .animate-fade-in {
            animation: fadeIn 0.8s ease-out;
        }

        .animate-slide-up {
            animation: slideUp 0.8s ease-out forwards;
            opacity: 0;
        }

        .animate-slide-left {
            animation: slideLeft 0.8s ease-out;
        }

        /* Lesson Items with Hover Effects */
        .lesson-hover {
            padding: 1rem;
            margin: 0 -1rem;
            border-radius: 12px;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .lesson-hover:hover {
            background-color: #f8f9fa;
            transform: translateX(-10px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .lesson-hover:hover .lesson-badge {
            transform: scale(1.1) rotate(5deg);
            box-shadow: 0 4px 15px rgba(13, 110, 253, 0.4);
        }

        /* Learn Item Cards */
        .learn-item-card {
            background: #f8f9fa;
            border-radius: 12px;
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }

        .learn-item-card:hover {
            background: white;
            border-color: #0d6efd;
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }

        /* Feature Items */
        .feature-item {
            transition: all 0.3s ease;
            padding: 0.5rem;
            border-radius: 8px;
        }

        .feature-item:hover {
            background-color: #f8f9fa;
            transform: translateX(-5px);
        }

        /* Instructor Cards */
        .instructor-card {
            transition: all 0.3s ease;
            padding: 0.5rem;
            border-radius: 12px;
        }

        .instructor-card:hover {
            background-color: #f8f9fa;
            transform: translateX(-5px);
        }

        /* Social Share Buttons */
        .social-share {
            transition: all 0.3s ease;
        }

        .social-share:hover {
            transform: translateY(-3px) scale(1.05);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        /* Related Course Cards */
        .related-course-card {
            transition: all 0.3s ease;
            overflow: hidden;
        }

        .related-course-card:hover {
            transform: translateX(-5px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .related-course-card:hover img {
            transform: scale(1.1);
        }

        .related-course-card img {
            transition: transform 0.3s ease;
        }

        /* Scroll Animations */
        @media (prefers-reduced-motion: no-preference) {
            .animate-on-scroll {
                opacity: 0;
                transform: translateY(30px);
                transition: all 0.6s ease-out;
            }

            .animate-on-scroll.visible {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Course Page Design - Matching Image Style */
        .course-page-wrapper {
            background: linear-gradient(135deg, #e3f2fd 0%, #bbdefb 100%);
            min-height: 100vh;
        }

        .course-header-card {
            background: white;
            border-radius: 16px;
            padding: 2rem;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        .course-illustration {
            flex-shrink: 0;
        }

        .illustration-box {
            position: relative;
            width: 120px;
            height: 120px;
        }

        .illustration-icon-box {
            width: 40px;
            height: 40px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            box-shadow: 0 2px 4px rgba(0,0,0,0.2);
        }

        .course-main-title {
            font-size: 2rem;
            font-weight: 700;
            color: #1a1a1a;
            line-height: 1.3;
        }

        .course-info-bar {
            display: flex;
            flex-wrap: wrap;
            gap: 1.5rem;
            padding: 1rem;
            background: #f5f5f5;
            border-radius: 12px;
            margin-top: 1.5rem;
        }

        .info-item {
            display: flex;
            align-items: center;
            color: #4a5568;
            font-size: 0.95rem;
        }

        .info-item i {
            color: #0d6efd;
            font-size: 1.1rem;
        }

        .course-price-display {
            margin-top: 1rem;
        }

        .price-amount {
            font-size: 1.5rem;
            font-weight: 700;
            color: #1a1a1a;
        }

        .course-content-card {
            background: white;
            border-radius: 16px;
            padding: 2rem;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            margin-bottom: 1.5rem;
        }

        .section-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 1rem;
        }

        .course-description-text {
            font-size: 1rem;
            line-height: 1.8;
            color: #4a5568;
            margin-bottom: 0;
        }

        .learn-list {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .learn-item {
            display: flex;
            align-items: flex-start;
            gap: 0.75rem;
        }

        .learn-number {
            font-weight: 700;
            color: #0d6efd;
            font-size: 1.1rem;
        }

        .learn-text {
            color: #4a5568;
            line-height: 1.6;
        }

        /* Enrollment Sidebar */
        .enrollment-sidebar {
            position: sticky;
            top: 20px;
        }

        .enrollment-card {
            background: white;
            border-radius: 16px;
            padding: 2rem;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }

        .price-header {
            border-bottom: 2px solid #e9ecef;
            padding-bottom: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .price-title {
            font-size: 1.25rem;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 0.5rem;
        }

        .price-display {
            margin-top: 0.5rem;
        }

        .price-value {
            font-size: 2rem;
            font-weight: 800;
            color: #1a1a1a;
        }

        .price-includes {
            margin-bottom: 1.5rem;
        }

        .includes-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: #1a1a1a;
            margin-bottom: 1rem;
        }

        .includes-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .include-item {
            display: flex;
            align-items: flex-start;
            margin-bottom: 1rem;
            color: #4a5568;
            line-height: 1.6;
        }

        .include-item i {
            color: #0d6efd;
            font-size: 1.2rem;
            margin-top: 0.2rem;
        }

        .btn-enroll {
            background: #ffc107;
            color: #1a1a1a;
            border: none;
            padding: 1rem 2rem;
            font-size: 1.2rem;
            font-weight: 700;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.3s ease;
            text-align: center;
        }

        .btn-enroll:hover:not(:disabled) {
            background: #ffb300;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(255, 193, 7, 0.4);
        }

        .btn-enroll:disabled {
            opacity: 0.6;
            cursor: not-allowed;
        }

        .countdown-section {
            text-align: center;
            padding: 1rem;
            background: #f8f9fa;
            border-radius: 12px;
        }

        .countdown-text {
            font-size: 0.95rem;
            color: #4a5568;
            margin-bottom: 0.5rem;
        }

        .countdown-text i {
            color: #0d6efd;
        }

        .countdown-date {
            font-size: 1rem;
            font-weight: 600;
            color: #1a1a1a;
        }

        .lesson-item {
            padding: 1rem;
            background: #f8f9fa;
            border-radius: 12px;
            margin-bottom: 1rem;
            transition: all 0.3s ease;
        }

        .lesson-item:hover {
            background: #e9ecef;
            transform: translateX(-5px);
        }

        .lesson-number-badge {
            width: 48px;
            height: 48px;
            background: #0d6efd;
            color: white;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 1.1rem;
            flex-shrink: 0;
        }

        .lesson-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: #1a1a1a;
            margin-bottom: 0.5rem;
        }

        .lesson-description {
            font-size: 0.9rem;
            line-height: 1.6;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .course-info-bar {
                flex-direction: column;
                gap: 0.75rem;
            }

            .course-main-title {
                font-size: 1.5rem;
            }

            .enrollment-sidebar {
                position: relative;
                top: 0;
                margin-top: 2rem;
            }
        }

        .card-body {
            padding: 2rem;
        }

        /* Price display */
        .course-price {
            font-size: var(--font-size-3xl);
            font-weight: var(--font-weight-bold);
            color: #0d6efd;
        }

        /* Section headings */
        .section-heading {
            font-size: var(--font-size-2xl);
            font-weight: var(--font-weight-bold);
            margin-bottom: 1.5rem;
            color: #1a1a1a;
        }

        /* Info icons styling */
        .info-icon-wrapper {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(13, 110, 253, 0.1);
        }

        .info-icon-wrapper i {
            font-size: 1.25rem;
            color: #0d6efd;
        }

        /* Learn items list */
        .learn-item {
            font-size: var(--font-size-base);
            line-height: var(--line-height-relaxed);
            color: #4a5568;
        }

        .learn-item i {
            color: #10b981;
            margin-left: 0.5rem;
        }

        /* Responsive typography */
        @media (max-width: 768px) {
            h1, .h1 {
                font-size: var(--font-size-3xl);
            }

            h2, .h2 {
                font-size: var(--font-size-2xl);
            }

            .display-5 {
                font-size: var(--font-size-2xl);
            }

            .course-title {
                font-size: var(--font-size-2xl);
            }
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
        }
        
        .whatsapp-float:hover {
            background-color: #128C7E;
            transform: scale(1.1);
            box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.3);
        }
        
        /* Reduced animation for better performance */
        @media (prefers-reduced-motion: no-preference) {
            .whatsapp-float {
                animation: pulse 2s infinite;
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




    <!-- WhatsApp Floating Button -->
    <a href="https://wa.me/201066843185" class="whatsapp-float" target="_blank" title="تحدث معنا الآن">
        <i class="fab fa-whatsapp"></i>
    </a>



    <!-- Scripts - Load non-critical scripts with defer -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" defer></script>
    
    @stack('scripts')
</body>
</html>
