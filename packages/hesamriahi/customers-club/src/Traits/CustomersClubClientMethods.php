<?php

namespace Hesamriahi\CustomersClub\Traits;

use Hesamriahi\CustomersClub\Models\CustomersClubScore;
use Hesamriahi\CustomersClub\Models\CustomersClubScoreLevelClient;

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
    
}