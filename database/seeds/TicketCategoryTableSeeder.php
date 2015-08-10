<?php

use Faker\Generator;
use TeachMe\Entities\TicketCategory;

class TicketCategoryTableSeeder extends BaseSeeder
{
    protected $total = 26;

    public function getModel()
    {
        return new TicketCategory();
    }

    public function getDummyData(Generator $faker, array $customValues = array())
    {
        return [
            'description' => $faker->sentence,
        ];
    }
}
