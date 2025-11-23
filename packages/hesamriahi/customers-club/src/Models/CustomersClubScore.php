<?php

namespace Hesamriahi\CustomersClub\Models;

use Illuminate\Database\Eloquent\Model;

class CustomersClubScore extends Model
{
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->setConnection(config('customers-club.connection_name', env('DB_CONNECTION')));
    }
    
    protected $table = 'customers_club_scores';
    protected $fillable = [
        'client_id' => 'integer',
        'client_type' => 'string',
        'mission_id' => 'integer',
        'score' => 'integer',
        'bon' => 'integer',
    ];
}
