<?php

namespace manchenkov\yii\maker\actions;

use manchenkov\yii\maker\commands\MakeAction;
use yii\console\ExitCode;
use yii\helpers\StringHelper;

class ControllerAction extends MakeAction
{
    /**
     * Generates a new HTTP controller class
     *
     * @param string $name
     * @param bool $isResource
     *
     * @return int
     */
    public function run(string $name, bool $isResource = false): int
    {
        // base namespace
        $namespace = "app\\controllers";

        // get class base name from full path
        $class = stringy(StringHelper::basename($name))->upperCamelize();

        // build file path in lower case and append class base name
        $filename = stringy($name)
            ->replace($class, false)
            ->toLowerCase()
            ->append($class);

        // check controller name suffix
        if (!$class->endsWith("Controller")) {
            $this->error("The file name must contain 'Controller' suffix");

            return ExitCode::UNSPECIFIED_ERROR;
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

        // select controller template
        $template = $isResource ? "resource" : "http";

        // generate file content
        return $this->process(
            [
                "namespace" => $namespace,
                "class" => $class,
            ],
            [
                "controllers/{$template}.md" => "controllers/{$filename}.php",
            ]
        );
    }
}