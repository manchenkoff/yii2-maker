<?php

namespace manchenkov\yii\maker\actions;

use manchenkov\yii\maker\commands\MakeAction;
use yii\console\ExitCode;
use yii\helpers\StringHelper;

class JobAction extends MakeAction
{
    /**
     * Generates a queue Job class
     *
     * @param string $name
     *
     * @return int
     */
    public function run(string $name): int
    {
        // base namespace
        $namespace = "app\\commands\\jobs";

        // get class base name from full path
        $class = stringy(StringHelper::basename($name))->upperCamelize();

        // build file path in lower case and append class base name
        $filename = stringy($name)
            ->replace($class, false)
            ->toLowerCase()
            ->append($class);

        // check file name suffix
        if (!$class->endsWith("Job")) {
            $this->error("The file name must contain 'Job' suffix");

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

        // generate file content
        return $this->process(
            [
                "namespace" => $namespace,
                "class" => $class,
            ],
            [
                "core/job.md" => "commands/jobs/{$filename}.php",
            ]
        );
    }
}