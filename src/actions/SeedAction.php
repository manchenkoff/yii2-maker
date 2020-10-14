<?php

namespace manchenkov\yii\maker\actions;

use manchenkov\yii\maker\commands\MakeAction;
use yii\console\ExitCode;
use yii\helpers\StringHelper;

class SeedAction extends MakeAction
{
    /**
     * Generates a new database Seeder class
     *
     * @param string $name
     *
     * @return int
     */
    public function run(string $name): int
    {
        // base namespace
        $namespace = "app\\database\\seeders";

        // get class base name from full path
        $class = stringy(StringHelper::basename($name))->upperCamelize();

        // build file path in lower case and append class base name
        $filename = stringy($name)
            ->replace($class, false)
            ->toLowerCase()
            ->append($class);

        // check file name suffix
        if (!$class->endsWith("Seeder")) {
            $this->error("The file name must contain 'Seeder' suffix");

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
                "database/seed.md" => "database/seeders/{$filename}.php",
            ]
        );
    }
}