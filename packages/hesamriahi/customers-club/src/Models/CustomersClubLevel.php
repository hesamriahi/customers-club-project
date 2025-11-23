<?php

namespace Hesamriahi\CustomersClub\Models;

use Illuminate\Database\Eloquent\Model;

class CustomersClubLevel extends Model
{
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->setConnection(config('customers-club.connection_name', env('DB_CONNECTION')));
    }
    
    protected $table = 'customers_club_levels';
    protected $fillable = [
        'title',
        'min_score' => 'integer',
        'max_score' => 'integer',
        'color_code' => 'string',
        'icon_path' => 'string|nullable',
        'image_path' => 'string|nullable',
    ];
}
