<?php
/**
 * Created by Artyom Manchenkov
 * artyom@manchenkoff.me
 * manchenkoff.me © 2019
 */

namespace manchenkov\yii\maker\actions;

use manchenkov\yii\maker\commands\MakeAction;

class MigrationAction extends MakeAction
{
    /**
     * Generates a new database migration
     *
     * @param string $name
     *
     * @return int|void
     */
    public function run(string $name)
    {
        $timestamp = "m" . date('ymd_His_') . strtolower($name);

        return $this->process(
            ["class" => $timestamp],
            ["database/migration.md" => "database/migrations/{$timestamp}.php"]
        );
    }
}