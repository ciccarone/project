<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class ApprovedChamber extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'random_code', 'accepted_access'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->random_code = Str::random(6);
        });
    }
}
