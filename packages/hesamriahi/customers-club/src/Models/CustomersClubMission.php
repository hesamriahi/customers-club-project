<?php

namespace Hesamriahi\CustomersClub\Models;

use Illuminate\Database\Eloquent\Model;

class CustomersClubMission extends Model
{
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->setConnection(config('customers-club.connection_name', env('DB_CONNECTION')));
    }
    
    protected $table = 'customers_club_missions';
    protected $fillable = [
        'title',
        'bon_value',
        'score_value',
        'is_active',
    ];
}
