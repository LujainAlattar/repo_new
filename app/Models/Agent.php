<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Ticket;

class Agent extends Model
{
    use HasFactory;

    public function tickets()
    {
        return $this->hasMany(Ticket::class, 'agent_id');
    }
}
