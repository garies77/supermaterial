<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class WebInformation extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'site_name',
        'site_logo',
        'site_favicon',
        'email',
        'phone',
        'address',
        'about_us',
        'privacy_policy',
        'terms_conditions',
        'facebook_link',
        'twitter_link',
        'instagram_link',
        'youtube_link',
        'whatsapp_number',
        'meta_title',
        'meta_description',
        'meta_keywords',
    ];
}
