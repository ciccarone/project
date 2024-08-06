<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'chamber_id',
        'group_manager_id',
    ];

    /**
     * Get the chamber that owns the group.
     */
    public function chamber()
    {
        return $this->belongsTo(Chamber::class);
    }

    /**
     * Get the user that manages the group.
     */
    public function groupManager()
    {
        return $this->belongsTo(User::class, 'group_manager_id');
    }
}
