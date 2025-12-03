<?php

namespace Hesamriahi\CustomersClub\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Hesamriahi\CustomersClub\Models\CustomersClubClient;
use Hesamriahi\CustomersClub\Models\CustomersClubLevel;

/*
* @property int $client_id
* @property string $client_type
* @property int|null $level_id
* @property int $sum_score
* @property int $sum_bon
* @property \Carbon\Carbon $created_at
* @property \Carbon\Carbon $updated_at
*/

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

    public function level(): BelongsTo
    {
        return $this->belongsTo(CustomersClubLevel::class, 'level_id');
    }

    public static function updateOrCreate(CustomersClubClient $client, $newScore, $newBon)
    {
        /* @var CustomersClubScoreLevelClient $scoreLevelClient */
        $scoreLevelClient = static::query()
            ->where('client_id', $client->id)
            ->where('client_type', get_class($client))
            ->first();

        if (!$scoreLevelClient) {
            $scoreLevelClient = new static([
                'client_id' => $client->id,
                'client_type' => get_class($client),
                'sum_score' => 0,
                'sum_bon' => 0,
            ]);
        }

        $newSumScore = $scoreLevelClient->sum_score + $newScore;
        $newSumBon = $scoreLevelClient->sum_bon + $newBon;

        $level = CustomersClubLevel::getSuitableLevel($newSumScore, $newSumBon);

        $scoreLevelClient->sum_score = $newSumScore;
        $scoreLevelClient->sum_bon = $newSumBon;
        $scoreLevelClient->level_id = $level ? $level->id : null;
        $scoreLevelClient->save();
    }
}
