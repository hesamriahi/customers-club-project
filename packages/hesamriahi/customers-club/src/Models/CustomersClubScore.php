<?php

namespace Hesamriahi\CustomersClub\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/*
* @property int $id
* @property int $client_id
* @property string $client_type
* @property int $mission_id
* @property int $score
* @property int $bon
* @property \Carbon\Carbon $created_at
* @property \Carbon\Carbon $updated_at
*/

class CustomersClubScore extends Model
{
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->setConnection(config('customers-club.connection_name', env('DB_CONNECTION')));
    }
    
    protected $table = 'customers_club_scores';
    protected $fillable = [
        'client_id',
        'client_type',
        'mission_id',
        'score',
        'bon',
    ];

    public function client(): MorphTo
    {
        return $this->morphTo();
    }

    public function mission(): BelongsTo
    {
        return $this->belongsTo(CustomersClubMission::class, 'mission_id');
    }
}
