<?php

namespace Hesamriahi\CustomersClub\Models;

use Illuminate\Database\Eloquent\Model;

class CustomersClubMission extends Model
{
    protected $table = 'customers_club_missions';
    protected $fillable = [
        'title',
        'bon_value',
        'score_value',
        'is_active',
    ];
}
