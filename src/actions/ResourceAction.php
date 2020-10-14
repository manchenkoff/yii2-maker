<?php

namespace manchenkov\yii\maker\actions;

use manchenkov\yii\maker\commands\MakeAction;
use yii\base\InvalidRouteException;
use yii\console\Exception;
use yii\helpers\StringHelper;

class ResourceAction extends MakeAction
{
    /**
     * Generates files for a new resource: migration, model, controller
     *
     * @param string $name
     *
     * @throws InvalidRouteException
     * @throws Exception
     */
    public function run(string $name)
    {
        // create a migration
        app()->runAction('make/migration', [StringHelper::basename($name)]);

        // create a model
        app()->runAction('make/model', [$name]);

        // create a controller
        app()->runAction('make/controller', [$name . 'Controller', true]);
    }
}