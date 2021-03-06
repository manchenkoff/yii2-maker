<?php

declare(strict_types=1);

namespace {{namespace}};

use tebazil\yii2seeder\Seeder;
use yii\base\Action;
use Exception;

final class {{class}} extends Action
{
    public function run(Seeder $seeder): void
    {
        // get generator and faker providers
        $generator = $seeder->getGeneratorConfigurator();
        $faker = $generator->getFakerConfigurator();
        
        // describe filling process of tables
        $seeder
            ->table('REPLACE_THIS_TABLE_NAME')
            ->columns([
                'id',
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
            ])
            ->rowQuantity(10);
            
        // save data
        try {
            $seeder->refill();
        } catch (Exception $e) {
            alert($e->getMessage());
        }
    }
}