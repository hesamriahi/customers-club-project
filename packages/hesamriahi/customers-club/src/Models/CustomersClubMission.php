<?php

namespace Hesamriahi\CustomersClub\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

/*
* @property int $id
* @property string $title
* @property string $key
* @property int $bon_value
* @property int $score_value
* @property boolean $is_active
* @property \Carbon\Carbon $created_at
* @property \Carbon\Carbon $updated_at
*/
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
        'key',
        'bon_value',
        'score_value',
        'is_active',
    ];

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', 1);
    }
}
