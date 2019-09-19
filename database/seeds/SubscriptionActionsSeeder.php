<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubscriptionActionsSeeder extends Seeder
{
    public $actions = [
        [
            'title' => 'Bonus create',
            'enum'  => 'entity-create',
        ],
        [
            'title' => 'Invite new user',
            'enum'  => 'invite-new-user',
        ],
        [
            'title' => 'Withdrawal create',
            'enum'  => 'withdrawal-create',
        ],
    ];

    public function run()
    {
        for ($i = 0; $i < count($this->actions); $i++) {
            $action = $this->actions[$i];

            DB::table('subscriptionActions')
              ->insert([
                  'title'     => $action['title'],
                  'enum'      => $action['enum'],
//                  'createdAt' => Carbon::now(),
              ]);
        }
    }
}
