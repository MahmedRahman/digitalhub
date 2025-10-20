<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Contact Information
    |--------------------------------------------------------------------------
    |
    | Here you may configure your contact information for the website.
    |
    */

    'email' => env('CONTACT_EMAIL', 'info@digitalhubegypt.com'),
    
    'phone' => env('CONTACT_PHONE', '01066843185'),
    
    'phone_formatted' => env('CONTACT_PHONE_FORMATTED', '+201066843185'),
    
    'address' => env('CONTACT_ADDRESS', 'القاهرة، مصر'),
    
    'social_media' => [
        'facebook' => 'https://www.facebook.com/digitalhubteam/',
        'instagram' => 'https://www.instagram.com/digitalhubegy/#',
        'linkedin' => 'https://www.linkedin.com/company/digital-hub-egypt/',
        'youtube' => 'https://www.youtube.com/@Digitalhubegypt',
        'tiktok' => 'https://www.tiktok.com/@digital_hub_egypt',
    ],
    
    'whatsapp' => [
        'phone' => env('WHATSAPP_PHONE', '201066843185'),
        'message' => 'مرحباً، أريد الاستفسار عن الدورات المتاحة',
    ],
];
