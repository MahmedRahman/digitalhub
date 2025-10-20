# WhatsApp Integration for DigitalHub

This document explains how to configure and use the WhatsApp integration for course registration in the DigitalHub platform.

## Features

- ✅ WhatsApp registration buttons on all course pages
- ✅ Automatic message generation with course details
- ✅ Configurable phone number and message templates
- ✅ Helper functions for easy customization
- ✅ Responsive design with WhatsApp branding

## Configuration

### 1. Environment Variables

Add the following to your `.env` file:

```env
# WhatsApp Configuration
WHATSAPP_PHONE_NUMBER=201066843185
```

### 2. Config File

The WhatsApp configuration is located in `config/whatsapp.php`:

```php
<?php

return [
    'phone_number' => env('WHATSAPP_PHONE_NUMBER', '201066843185'),
    'default_message' => 'مرحباً، أريد التسجيل في دورة',
    'message_template' => ':greeting :course_title - السعر: :price ج.م',
    'greeting' => 'مرحباً، أريد التسجيل في دورة',
    'button_text' => 'تسجيل عبر الواتساب',
    'button_icon' => 'fab fa-whatsapp',
    'button_class' => 'btn btn-success',
    'open_in_new_tab' => true,
];
```

## Usage

### Helper Functions

The `WhatsAppHelper` class provides several methods for generating WhatsApp links:

#### 1. Generate Course Registration URL

```php
use App\Helpers\WhatsAppHelper;

$url = WhatsAppHelper::generateCourseRegistrationUrl('Course Title', 100.50);
// Returns: https://wa.me/201066843185?text=مرحباً، أريد التسجيل في دورة Course Title - السعر: 101 ج.م
```

#### 2. Generate Custom Message Link

```php
$url = WhatsAppHelper::generateLink('Hello, I want to register for a course');
// Returns: https://wa.me/201066843185?text=Hello%2C%20I%20want%20to%20register%20for%20a%20course
```

#### 3. Generate Button HTML

```php
$button = WhatsAppHelper::generateButton('Course Title', 100.50);
// Returns: <a href="https://wa.me/..." target="_blank" class="btn btn-success">
//              <i class="fab fa-whatsapp me-1"></i>
//              تسجيل عبر الواتساب
//          </a>
```

### Blade Templates

In your Blade templates, you can use the helper functions:

```blade
<!-- Simple link -->
<a href="{{ \App\Helpers\WhatsAppHelper::generateCourseRegistrationUrl($course->title, $course->price) }}" 
   target="_blank" 
   class="btn btn-success">
    <i class="fab fa-whatsapp me-2"></i>
    تسجيل عبر الواتساب
</a>

<!-- Custom message -->
<a href="{{ \App\Helpers\WhatsAppHelper::generateLink('Custom message here') }}" 
   target="_blank" 
   class="btn btn-success">
    <i class="fab fa-whatsapp me-2"></i>
    تواصل معنا
</a>
```

## Implementation Details

### Pages with WhatsApp Integration

1. **Course Detail Page** (`/courses/{id}`)
   - Main registration button
   - Sidebar registration button

2. **Course List Page** (`/courses`)
   - Individual course cards

3. **Home Page** (`/`)
   - Featured courses section

4. **Category Page** (`/categories/{id}`)
   - Course cards within category

5. **Instructor Page** (`/instructors/{id}`)
   - Instructor's courses

### Message Template Variables

The message template supports the following variables:

- `:greeting` - The greeting message
- `:course_title` - The course title
- `:price` - The course price (rounded)

### Customization

#### 1. Change Phone Number

Update the environment variable:

```env
WHATSAPP_PHONE_NUMBER=201066843185
```

#### 2. Customize Message Template

Edit `config/whatsapp.php`:

```php
'message_template' => 'Hello! I want to register for :course_title - Price: :price EGP',
```

#### 3. Customize Button Styling

```php
'button_class' => 'btn btn-primary btn-lg',
'button_text' => 'Register via WhatsApp',
'button_icon' => 'fab fa-whatsapp',
```

## Testing

### 1. Test WhatsApp Links

```bash
# Test the helper function
php artisan tinker

# In tinker:
use App\Helpers\WhatsAppHelper;
WhatsAppHelper::generateCourseRegistrationUrl('Test Course', 100);
```

### 2. Test in Browser

1. Navigate to any course page
2. Click the WhatsApp button
3. Verify the message is correctly formatted
4. Test on mobile device

## Troubleshooting

### Common Issues

1. **Phone number not working**
   - Check the phone number format (should include country code)
   - Ensure the number is valid for WhatsApp

2. **Message not appearing**
   - Check URL encoding
   - Verify the message template variables

3. **Button not displaying**
   - Check if Font Awesome is loaded
   - Verify the CSS classes

### Debug Mode

Enable debug mode in `config/whatsapp.php`:

```php
'debug' => true,
```

This will log the generated URLs to the Laravel log.

## Security Considerations

1. **Phone Number Privacy**
   - Consider using a business phone number
   - Implement rate limiting for WhatsApp links

2. **Message Content**
   - Sanitize user input in custom messages
   - Avoid including sensitive information

3. **Spam Prevention**
   - Implement CAPTCHA for registration
   - Monitor for abuse patterns

## Future Enhancements

- [ ] WhatsApp Business API integration
- [ ] Automated message responses
- [ ] Analytics tracking for WhatsApp clicks
- [ ] Multi-language support
- [ ] Custom message templates per course
- [ ] WhatsApp QR code generation
- [ ] Integration with payment systems
- [ ] Automated follow-up messages
