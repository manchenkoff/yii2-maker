<?php

namespace manchenkov\yii\maker\actions;

use manchenkov\yii\maker\commands\MakeAction;
use yii\helpers\StringHelper;

class ViewAction extends MakeAction
{
    /**
     * Generates a Twig view file
     *
     * @param string $name
     */
    public function run(string $name)
    {
        $path = "views/{$name}";
        $view = StringHelper::basename($name);

        $this->process(
            ["name" => strtolower($view)],
            ["core/view.md" => "../resources/{$path}.php"]
        );
    }
}