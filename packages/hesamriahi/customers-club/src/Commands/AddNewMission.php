<?php

namespace Hesamriahi\CustomersClub\Commands;

use Illuminate\Console\Command;
use Hesamriahi\CustomersClub\Models\CustomersClubMission;

class AddNewMission extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'customers-club:add-new-mission';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add a new mission to the customers club';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $title = $this->ask('Enter the title of the mission');
        $key = $this->ask('Enter the key of the mission');
        $bonValue = $this->ask('Enter the bon value of the mission', 0);
        $scoreValue = $this->ask('Enter the score value of the mission', 0);

        if (CustomersClubMission::where('key', $key)->exists()) {
            $this->error('Mission with key ' . $key . ' already exists');
            return;
        }

        CustomersClubMission::create([
            'title' => $title,
            'key' => $key,
            'bon_value' => $bonValue,
            'score_value' => $scoreValue,
            'is_active' => 1,
        ]);

        $this->info('Mission added successfully');
    }
}
