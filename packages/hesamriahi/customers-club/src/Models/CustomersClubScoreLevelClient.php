<?php

namespace Hesamriahi\CustomersClub\Models;

use Illuminate\Database\Eloquent\Model;

class CustomersClubScoreLevelClient extends Model
{
    protected $table = 'customers_club_score_level_clients';
    protected $fillable = [
        'client_id',
        'client_type',
        'level_id' => 'integer',
        'sum_score' => 'integer',
        'sum_bon' => 'integer',
    ];
}
