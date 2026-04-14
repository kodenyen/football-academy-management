<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    protected $fillable = [
        'academy_name', 'academy_logo', 'primary_color', 'secondary_color', 'background_color',
        'phone_number', 'whatsapp_number', 'address', 'email', 'about_us_content', 'footer_text', 
        'social_links', 'navigation_menu', 'paystack_public_key', 'paystack_secret_key',
        'mail_host', 'mail_port', 'mail_username', 'mail_password', 'mail_encryption', 
        'mail_from_address', 'mail_from_name',
        'about_vision', 'about_mission', 'about_video_id',
        'heading_font', 'body_font', 'hero_heading_size', 'hero_subheading_size', 'section_heading_size'
    ];}
