<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserMeta extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'business_id',
        'group_id',
        'role_id',
        'approved',
    ];

    /**
     * Get the user associated with the user meta.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the business associated with the user meta.
     */
    public function business()
    {
        return $this->belongsTo(Business::class);
    }

    /**
     * Get the group associated with the user meta.
     */
    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    /**
     * Get the role associated with the user meta.
     */
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

}
