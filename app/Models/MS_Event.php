<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MS_Event extends Model
{
    use HasFactory;

    protected $table = 'events';

    protected $fillable = [
        'title',
        'description',
        'start_date',
        'end_date',
        'place',
        'price',
        'is_free',
        'capacity',
        'image',
        'status',
        'category_id',
        'created_by',
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date'   => 'datetime',
        'is_free'    => 'boolean',
    ];

    /* ================= RELATIONS ================= */

    public function category()
    {
        return $this->belongsTo(MS_Category::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function registrations()
    {
        return $this->hasMany(MS_Registration::class, 'event_id');
    }

    /* ================= BUSINESS LOGIC ================= */

    public function remainingPlaces()
    {
        return $this->capacity - $this->registrations()->count();
    }
}
