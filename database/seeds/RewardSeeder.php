<?php

use Illuminate\Database\Seeder;

class RewardSeeder extends Seeder
{
    protected const MAX_PAY = 1000;
    protected const MIN_PAY = 100;
    protected const GIFT_LIST = [
        'PS 2,8', 'iPhone 3', 'Broken car', 'Boeing 747', 'Тickets to Ryazan', 'Milk', 'Sofa', 'Cat', 'Batman'
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rewards = [
            [
                'name' => 'bonus',
                'type' => 1,
                'count' => 50,
                'can_use' => 1,
                'weight' => 13
            ],
            [
                'name' => 'money',
                'type' => 2,
                'count' => mt_rand(self::MIN_PAY, self::MAX_PAY),
                'can_use' => 1,
                'weight' => 11
            ],
            [
                'name' => self::GIFT_LIST[mt_rand(0, count(self::GIFT_LIST) - 1)],
                'type' => 3,
                'count' => 1,
                'can_use' => 1,
                'weight' => 9
            ],
            [
                'name' => 'money',
                'type' => 2,
                'count' => mt_rand(self::MIN_PAY, self::MAX_PAY),
                'can_use' => 1,
                'weight' => 12
            ],
            [
                'name' => self::GIFT_LIST[mt_rand(0, count(self::GIFT_LIST) - 1)],
                'type' => 3,
                'count' => 1,
                'can_use' => 1,
                'weight' => 8
            ],
            [
                'name' => 'money',
                'type' => 2,
                'count' => mt_rand(self::MIN_PAY, self::MAX_PAY),
                'can_use' => 1,
                'weight' => 1
            ],
            [
                'name' => self::GIFT_LIST[mt_rand(0, count(self::GIFT_LIST) - 1)],
                'type' => 3,
                'count' => 1,
                'can_use' => 1,
                'weight' => 7
            ],
            [
                'name' => 'money',
                'type' => 2,
                'count' => mt_rand(self::MIN_PAY, self::MAX_PAY),
                'can_use' => 1,
                'weight' => 3
            ],
            [
                'name' => self::GIFT_LIST[mt_rand(0, count(self::GIFT_LIST) - 1)],
                'type' => 3,
                'count' => 1,
                'can_use' => 1,
                'weight' => 7
            ],
            [
                'name' => 'money',
                'type' => 2,
                'count' => mt_rand(self::MIN_PAY, self::MAX_PAY),
                'can_use' => 1,
                'weight' => 2
            ],
            [
                'name' => self::GIFT_LIST[mt_rand(0, count(self::GIFT_LIST) - 1)],
                'type' => 3,
                'count' => 1,
                'can_use' => 1,
                'weight' => 1
            ],
            [
                'name' => self::GIFT_LIST[mt_rand(0, count(self::GIFT_LIST) - 1)],
                'type' => 3,
                'count' => 1,
                'can_use' => 1,
                'weight' => 5
            ],
            [
                'name' => 'money',
                'type' => 2,
                'count' => mt_rand(self::MIN_PAY, self::MAX_PAY),
                'can_use' => 1,
                'weight' => 1
            ],
            [
                'name' => self::GIFT_LIST[mt_rand(0, count(self::GIFT_LIST) - 1)],
                'type' => 3,
                'count' => 1,
                'can_use' => 1,
                'weight' => 4
            ],
            [
                'name' => self::GIFT_LIST[mt_rand(0, count(self::GIFT_LIST) - 1)],
                'type' => 3,
                'count' => 1,
                'can_use' => 1,
                'weight' => 6
            ],
            [
                'name' => 'money',
                'type' => 2,
                'count' => mt_rand(self::MIN_PAY, self::MAX_PAY),
                'can_use' => 1,
                'weight' => 10
            ],
        ];

        foreach ($rewards as $reward) {
            \App\Rewards::create($reward);
        }
    }
}
