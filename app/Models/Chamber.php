<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chamber extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'approved_chamber_id',
        'name',
    ];

    /**
     * Get the approved chamber associated with the chamber.
     */
    public function approvedChamber()
    {
        return $this->belongsTo(ApprovedChamber::class);
    }
}
