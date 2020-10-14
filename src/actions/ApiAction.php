<?php

namespace manchenkov\yii\maker\actions;

use manchenkov\yii\maker\commands\MakeAction;
use yii\helpers\StringHelper;

class ApiAction extends MakeAction
{
    /**
     * Generates a new application module
     *
     * @param string $name
     *
     * @return int
     */
    public function run(string $name): int
    {
        // base namespace
        $namespace = "app\\modules\\";

        // module base name
        $module = stringy($name)->toLowerCase();

        // routes config name
        $routesConfig = StringHelper::basename($module);

        // append namespace parts
        $namespace .= $module->replace("/", "\\");

        // generate file content
        return $this->process(
            [
                "namespace" => $namespace,
                "routes" => $routesConfig,
                "module" => $module,
            ],
            [
                "modules/basic/controller.md" => "modules/{$module}/controllers/MainController.php",
                "modules/basic/module.md" => "modules/{$module}/Module.php",
                "modules/basic/routes.md" => "routes/{$routesConfig}.php",
            ]
        );
    }
}