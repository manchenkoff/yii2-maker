<?php
/**
 * Created by Artyom Manchenkov
 * artyom@manchenkoff.me
 * manchenkoff.me © 2019
 */

namespace manchenkov\yii\maker\actions;

use manchenkov\yii\maker\commands\MakeAction;
use yii\helpers\StringHelper;

class FormAction extends MakeAction
{
    /**
     * Generates a Form model class
     *
     * @param string $name
     *
     * @return int|void
     */
    public function run(string $name)
    {
        // base namespace
        $namespace = "app\\forms";
        // get class base name from full path
        $class = stringy(StringHelper::basename($name))->upperCamelize();
        // build file path in lower case and append class base name
        $filename = stringy($name)
            ->replace($class, false)
            ->toLowerCase()
            ->append($class);

        // check file name suffix
        if (!$class->endsWith("Form")) {
            return $this->error("The file name must contain 'Form' suffix");
        }

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
                "core/form.md" => "forms/{$filename}.php",
            ]
        );
    }
}