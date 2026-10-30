<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebsiteInquiry extends Model
{
    use HasFactory;

    protected $table = 'website_inquiries';

    protected $fillable = [
        'name',
        'business_name',
        'email',
        'phone',
        'wa_number',
        'message',
        'status',
    ];
}
