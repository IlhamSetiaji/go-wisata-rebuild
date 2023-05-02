<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $table = 'tickets';
    protected $guarded = ['id'];

    public function tour()
    {
        return $this->belongsTo(Tour::class, 'tour_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'ticket_user', 'ticket_id', 'user_id')->withPivot('quantity', 'total_price', 'status')->withTimestamps();
    }
}
