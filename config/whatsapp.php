<?php

return [
    /*
    |--------------------------------------------------------------------------
    | WhatsApp Configuration
    |--------------------------------------------------------------------------
    |
    | Here you may configure your WhatsApp settings for course registration.
    |
    */

    'phone_number' => env('WHATSAPP_PHONE_NUMBER', '201066843185'),
    
    'default_message' => 'مرحباً، أريد التسجيل في دورة',
    
    'message_template' => ':greeting :course_title - السعر: :price ج.م',
    
    'greeting' => 'مرحباً، أريد التسجيل في دورة',
    
    'button_text' => 'تسجيل عبر الواتساب',
    
    'button_icon' => 'fab fa-whatsapp',
    
    'button_class' => 'btn btn-success',
    
    'open_in_new_tab' => true,
];
