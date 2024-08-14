<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'address',
        'website_url',
        'social_profiles',
        'logo_image',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'social_profiles' => 'array',
    ];

    public function services()
    {
        return $this->belongsToMany(Service::class, 'business_service');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
