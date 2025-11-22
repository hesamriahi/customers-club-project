<?php

namespace Hesamriahi\CustomersClub\Models;

use Illuminate\Database\Eloquent\Model;

class CustomersClubScore extends Model
{
    protected $table = 'customers_club_scores';
    protected $fillable = [
        'client_id' => 'integer',
        'client_type' => 'string',
        'mission_id' => 'integer',
        'score' => 'integer',
        'bon' => 'integer',
    ];
}
