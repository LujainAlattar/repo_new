<?php

namespace App\Models;

use App\Models\Agent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Summary of Ticket
 */
class Ticket extends Model
{
    use HasFactory;
    /**
     * Summary of agent
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function agent()
    {
        return $this->belongsTo(Agent::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
