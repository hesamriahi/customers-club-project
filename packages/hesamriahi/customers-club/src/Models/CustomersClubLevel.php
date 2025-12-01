<?php

namespace Hesamriahi\CustomersClub\Models;

use Illuminate\Database\Eloquent\Model;
/*
* @property int $id
* @property string $title
* @property int $min_score
* @property int $min_bon
* @property string $color_code
* @property int $priority
* @property string $icon_path
* @property string $image_path
* @property \Carbon\Carbon $created_at
* @property \Carbon\Carbon $updated_at
*/

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
        'min_score' => 'unsignedInteger',
        'min_bon' => 'unsignedInteger',
        'color_code' => 'string',
        'priority' => 'integer',
        'icon_path' => 'string|nullable',
        'image_path' => 'string|nullable',
    ];

    public static function getSuitableLevel(int $score, ?int $bon = null): CustomersClubLevel|null
    {
        $level = static::query()
            ->where('min_score', '<=', $score)
            ->when($bon, function ($query) use ($bon) {
                $query->where('min_bon', '<=', $bon);
            })
            ->first();

        if (!$level) {
            $level = static::query()
                ->orderByDesc('priority')
                ->first();
        }
        return $level;
    }
}
