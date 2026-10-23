<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MS_Registration extends Model
{
    use HasFactory;

    protected $table = 'registrations';

    protected $fillable = ['user_id', 'event_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function event()
    {
        return $this->belongsTo(MS_Event::class);
    }
}
