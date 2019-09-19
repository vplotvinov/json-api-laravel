<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubscriptionChannelsSeeder extends Seeder
{
    public $channels = [
        [
            'title' => 'Slack',
            'enum'  => 'slack',
        ],
        [
            'title' => 'Email',
            'enum'  => 'email',
        ],
    ];

    public function run()
    {
        for ($i = 0; $i < count($this->channels); $i++) {
            $channel = $this->channels[$i];

            DB::table('subscriptionChannels')
              ->insert([
                  'title' => $channel['title'],
                  'enum'  => $channel['enum'],
//                  'createdAt' => Carbon::now(),
              ]);
        }
    }
}
