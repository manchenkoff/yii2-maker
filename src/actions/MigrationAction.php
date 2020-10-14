<?php

namespace manchenkov\yii\maker\actions;

use manchenkov\yii\maker\commands\MakeAction;

class MigrationAction extends MakeAction
{
    /**
     * Generates a new database migration
     *
     * @param string $name
     *
     * @return int
     */
    public function run(string $name): int
    {
        $timestamp = "m" . date('ymd_His_') . strtolower($name);

        return $this->process(
            ["class" => $timestamp],
            ["database/migration.md" => "database/migrations/{$timestamp}.php"]
        );
    }
}