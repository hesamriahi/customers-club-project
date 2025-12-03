<?php

namespace Hesamriahi\CustomersClub\Models;

interface CustomersClubClient
{
    public function setScore(string $missionKey);
    public function returnScore(string $missionKey);
    // attributes
    public function getCustomersClubDetailsAttribute():array;
    // relations
    public function scores():\Illuminate\Database\Eloquent\Relations\MorphMany;
    public function customersClubScoreLevelClient():\Illuminate\Database\Eloquent\Relations\MorphOne;
}