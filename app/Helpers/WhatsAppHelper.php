<?php

namespace App\Helpers;

class WhatsAppHelper
{
    /**
     * Generate WhatsApp URL for course registration
     *
     * @param string $courseTitle
     * @param float $price
     * @param string|null $customMessage
     * @return string
     */
    public static function generateCourseRegistrationUrl($courseTitle, $price, $customMessage = null)
    {
        $phoneNumber = config('whatsapp.phone_number');
        $greeting = config('whatsapp.greeting');
        
        if ($customMessage) {
            $message = $customMessage;
        } else {
            $message = config('whatsapp.message_template');
            $message = str_replace(':greeting', $greeting, $message);
            $message = str_replace(':course_title', $courseTitle, $message);
            $message = str_replace(':price', round($price), $message);
        }
        
        $encodedMessage = urlencode($message);
        
        return "https://wa.me/{$phoneNumber}?text={$encodedMessage}";
    }
    
    /**
     * Generate WhatsApp button HTML
     *
     * @param string $courseTitle
     * @param float $price
     * @param string $buttonText
     * @param string $buttonClass
     * @param string $iconClass
     * @param bool $openInNewTab
     * @return string
     */
    public static function generateButton($courseTitle, $price, $buttonText = null, $buttonClass = null, $iconClass = null, $openInNewTab = true)
    {
        $buttonText = $buttonText ?: config('whatsapp.button_text');
        $buttonClass = $buttonClass ?: config('whatsapp.button_class');
        $iconClass = $iconClass ?: config('whatsapp.button_icon');
        $openInNewTab = $openInNewTab && config('whatsapp.open_in_new_tab');
        
        $url = self::generateCourseRegistrationUrl($courseTitle, $price);
        $target = $openInNewTab ? ' target="_blank"' : '';
        
        return "<a href=\"{$url}\"{$target} class=\"{$buttonClass}\">
                    <i class=\"{$iconClass} me-1\"></i>
                    {$buttonText}
                </a>";
    }
    
    /**
     * Generate WhatsApp link for any message
     *
     * @param string $message
     * @return string
     */
    public static function generateLink($message)
    {
        $phoneNumber = config('whatsapp.phone_number');
        $encodedMessage = urlencode($message);
        
        return "https://wa.me/{$phoneNumber}?text={$encodedMessage}";
    }
}

