<?php

namespace Hesamriahi\CustomersClub\Traits;

use Hesamriahi\CustomersClub\Models\CustomersClubScore;
use Hesamriahi\CustomersClub\Models\CustomersClubScoreLevelClient;
use Hesamriahi\CustomersClub\Models\CustomersClubMission;
use Illuminate\Support\Facades\DB;


trait CustomersClubClientMethods
{
    protected static function bootMyTrait()
    {
        static::retrieved(function ($model) {
            $model->append('customersClubDetails');
        });
    }
    // attributes =================================
    public function getCustomersClubDetailsAttribute():array
    {
        $scoreLevelClient = $this->customersClubScoreLevelClient->load('level');
        return [
            'score' => $scoreLevelClient->sum_score,
            'bon' => $scoreLevelClient->sum_bon,
            'level_title' => $scoreLevelClient->level->title,
            'level_color_code' => $scoreLevelClient->level->color_code,
            'level_icon_path' => $scoreLevelClient->level->icon_url,
            'level_image_path' => $scoreLevelClient->level->image_url,
            'level' => $scoreLevelClient->level
        ];
    }
    // relations =================================
    public function scores():\Illuminate\Database\Eloquent\Relations\MorphMany
    {
        return $this->morphMany(CustomersClubScore::class, 'client');
    }

    public function customersClubScoreLevelClient():\Illuminate\Database\Eloquent\Relations\MorphOne
    {
        return $this->morphOne(CustomersClubScoreLevelClient::class, 'client');
    }

    // methods =================================

    public function setScore(string $missionKey)
    {
        $mission = CustomersClubMission::query()
            ->where('key', $missionKey)
            ->active()
            ->first();
        
        if (!$mission) throw new \Exception('Mission not found');


        try {
            DB::beginTransaction();
            $score = $this->scores()->create([
                'mission_id' => $mission->id,
                'score' => $mission->score_value,
                'bon' => $mission->bon_value,
            ]);

            CustomersClubScoreLevelClient::updateOrCreate(
                $this, 
                $mission->score_value, 
                $mission->bon_value
            );

            DB::commit();

        } catch (\Exception $e) {
            DB::rollBack();
            throw new \Exception('Failed to set score');
        }
    }

    public function returnScore(string|int $missionKey)
    {
        if (is_numeric($missionKey)) {
            $score = $this->scores()->find($missionKey);
        } else {
            $mission = CustomersClubMission::query()
                ->where('key', $missionKey)
                ->active()
                ->first();
            
            if (!$mission) throw new \Exception('Mission not found');
            $score = $this->scores()->where('mission_id', $mission->id)->orderByDesc('id')->first();
        }

        if (!$score) throw new \Exception('Score not found');
        $score->delete();

        CustomersClubScoreLevelClient::updateOrCreate(
            $this, 
            -$score->score, 
            -$score->bon
        );
    }
}