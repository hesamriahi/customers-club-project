<?php

namespace Hesamriahi\CustomersClub\Models;

interface CustomersClubClient
{
    public function getScore();
    public function setScore(string $missionKey);
    public function returnScore(string $missionKey);
    
}