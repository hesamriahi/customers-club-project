<?php

namespace Hesamriahi\CustomersClub\Traits;

use Hesamriahi\CustomersClub\Models\CustomersClubScore;
use Hesamriahi\CustomersClub\Models\CustomersClubScoreLevelClient;
use Hesamriahi\CustomersClub\Models\CustomersClubMission;
use Illuminate\Support\Facades\DB;


trait CustomersClubClientMethods
{
    // relations =================================
    public function scores()
    {
        return $this->morphMany(CustomersClubScore::class, 'client');
    }

    public function score()
    {
        return $this->morphOne(CustomersClubScoreLevelClient::class, 'client');
    }

    public function getScore()
    {
        return $this->score->sum_score;
    }

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

    public function returnScore(string $missionKey)
    {
        $mission = CustomersClubMission::query()
            ->where('key', $missionKey)
            ->active()
            ->first();
        
        if (!$mission) throw new \Exception('Mission not found');

        $score = $this->scores()->where('mission_id', $mission->id)->first();
        if (!$score) throw new \Exception('Score not found');

        $score->delete();

        CustomersClubScoreLevelClient::updateOrCreate(
            $this, 
            -$score->score, 
            -$score->bon
        );
    }
}