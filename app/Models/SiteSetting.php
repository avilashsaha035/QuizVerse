<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'logo',
        'banners',
        'address',
        'email',
        'contact_number',
        'facebook_link',
        'linkedin_link',
        'instagram_link',
        'whatsapp_link',
    ];

    protected $casts = [
        'banners' => 'array',
    ];
}
