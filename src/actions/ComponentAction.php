<?php

namespace manchenkov\yii\maker\actions;

use manchenkov\yii\maker\commands\MakeAction;
use yii\helpers\StringHelper;

class ComponentAction extends MakeAction
{
    /**
     * Generates a new app Component class
     *
     * @param string $name
     *
     * @return int
     */
    public function run(string $name): int
    {
        // base namespace
        $namespace = "app\\core\\components";

        // get class base name from full path
        $class = stringy(StringHelper::basename($name))->upperCamelize();

        // build file path in lower case and append class base name
        $filename = stringy($name)
            ->replace($class, false)
            ->toLowerCase()
            ->append($class);

        // append namespace parts if exists
        if ($name != $class) {
            $namespace .= stringy($name)
                ->replace($class, false)
                ->trimRight("/")
                ->replace("/", "\\")
                ->prepend("\\")
                ->toLowerCase();
        }

        // generate file content
        return $this->process(
            [
                "namespace" => $namespace,
                "class" => $class,
            ],
            [
                "core/component.md" => "core/components/{$filename}.php",
            ]
        );
    }
}