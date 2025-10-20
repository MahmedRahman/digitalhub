<?php

namespace App\Helpers;

class ContactHelper
{
    /**
     * Get contact email
     *
     * @return string
     */
    public static function getEmail()
    {
        return config('contact.email');
    }
    
    /**
     * Get contact phone
     *
     * @return string
     */
    public static function getPhone()
    {
        return config('contact.phone');
    }
    
    /**
     * Get formatted contact phone
     *
     * @return string
     */
    public static function getFormattedPhone()
    {
        return config('contact.phone_formatted');
    }
    
    /**
     * Get contact address
     *
     * @return string
     */
    public static function getAddress()
    {
        return config('contact.address');
    }
    
    /**
     * Get social media links
     *
     * @return array
     */
    public static function getSocialMedia()
    {
        return config('contact.social_media');
    }
    
    /**
     * Generate email link
     *
     * @param string|null $email
     * @param string|null $subject
     * @param string|null $body
     * @return string
     */
    public static function generateEmailLink($email = null, $subject = null, $body = null)
    {
        $email = $email ?: self::getEmail();
        $url = "mailto:{$email}";
        
        $params = [];
        if ($subject) {
            $params[] = 'subject=' . urlencode($subject);
        }
        if ($body) {
            $params[] = 'body=' . urlencode($body);
        }
        
        if (!empty($params)) {
            $url .= '?' . implode('&', $params);
        }
        
        return $url;
    }
    
    /**
     * Generate phone link
     *
     * @param string|null $phone
     * @return string
     */
    public static function generatePhoneLink($phone = null)
    {
        $phone = $phone ?: self::getFormattedPhone();
        return "tel:{$phone}";
    }
    
    /**
     * Generate WhatsApp link
     *
     * @param string|null $message
     * @param string|null $phone
     * @return string
     */
    public static function generateWhatsAppLink($message = null, $phone = null)
    {
        $phone = $phone ?: config('contact.whatsapp.phone');
        $message = $message ?: config('contact.whatsapp.message');
        
        $encodedMessage = urlencode($message);
        return "https://wa.me/{$phone}?text={$encodedMessage}";
    }
    
    /**
     * Generate social media link
     *
     * @param string $platform
     * @return string|null
     */
    public static function getSocialMediaLink($platform)
    {
        $socialMedia = self::getSocialMedia();
        return $socialMedia[$platform] ?? null;
    }
}



