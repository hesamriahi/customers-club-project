<?php

namespace Hesamriahi\CustomersClub\Models;

use Illuminate\Database\Eloquent\Model;

class CustomersClubScoreLevelClient extends Model
{
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->setConnection(config('customers-club.connection_name', env('DB_CONNECTION')));
    }
    
    protected $table = 'customers_club_score_level_clients';
    protected $fillable = [
        'client_id',
        'client_type',
        'level_id' => 'integer',
        'sum_score' => 'integer',
        'sum_bon' => 'integer',
    ];
}
