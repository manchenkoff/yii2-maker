<?php

namespace manchenkov\yii\maker\commands;

use manchenkov\yii\console\command\Command;
use manchenkov\yii\maker\actions\ApiAction;
use manchenkov\yii\maker\actions\BehaviorAction;
use manchenkov\yii\maker\actions\CommandAction;
use manchenkov\yii\maker\actions\ComponentAction;
use manchenkov\yii\maker\actions\ControllerAction;
use manchenkov\yii\maker\actions\FilterAction;
use manchenkov\yii\maker\actions\FormAction;
use manchenkov\yii\maker\actions\JobAction;
use manchenkov\yii\maker\actions\MigrationAction;
use manchenkov\yii\maker\actions\ModelAction;
use manchenkov\yii\maker\actions\ModuleAction;
use manchenkov\yii\maker\actions\QueryAction;
use manchenkov\yii\maker\actions\ResourceAction;
use manchenkov\yii\maker\actions\SeedAction;
use manchenkov\yii\maker\actions\ServiceAction;
use manchenkov\yii\maker\actions\ViewAction;
use manchenkov\yii\maker\actions\WorkerAction;
use Yii;
use yii\base\Exception;
use yii\base\InvalidRouteException;
use yii\helpers\FileHelper;

class MakeController extends Command
{
    /**
     * Key-value pairs to replace with content
     * @var array
     */
    public array $replacement = [];

    /**
     * 'Original => destination' pairs to write files
     * @var array
     */
    public array $filesMap = [];

    /**
     * Directory to write files
     * @var string
     */
    private string $baseDir;

    /**
     * Directory with templates files
     * @var string
     */
    private string $templatesDir;

    /**
     * Basic configuration of controller
     */
    public function init()
    {
        $this->baseDir = Yii::getAlias('@app');
        $this->templatesDir = dirname(__DIR__) . "/templates";

        parent::init();
    }

    /**
     * @param string $id
     * @param array $params
     *
     * @return int
     * @throws InvalidRouteException
     * @throws \yii\console\Exception
     */
    public function runAction($id, $params = []): int
    {
        return parent::runAction($id, $params);
    }

    /**
     * Generates new files
     * @throws Exception
     */
    public function process(): void
    {
        foreach ($this->filesMap as $source => $destination) {
            // build absolute file paths
            $originalFilePath = FileHelper::normalizePath("{$this->templatesDir}/{$source}");
            $destinationFilePath = FileHelper::normalizePath("{$this->baseDir}/{$destination}");

            // read content of a template file
            $content = stringy(file_get_contents($originalFilePath));

            // replace all values from '$replacement' array
            foreach ($this->replacement as $placeholder => $value) {
                $content = $content->replace("{{{$placeholder}}}", $value);
            }

            // write changes to the file
            if (!is_dir(dirname($destinationFilePath))) {
                FileHelper::createDirectory(dirname($destinationFilePath));
            }

            file_put_contents($destinationFilePath, $content);

            // show success message
            $this->info("Created: {$destinationFilePath}");
        }
    }

    /**
     * MakeController actions for scaffolding
     * @return array
     */
    public function actions(): array
    {
        return [
            // Controllers
            'controller' => ControllerAction::class,
            'command' => CommandAction::class,
            'worker' => WorkerAction::class,
            'resource' => ResourceAction::class,

            // Database
            'migration' => MigrationAction::class,
            'model' => ModelAction::class,
            'query' => QueryAction::class,
            'seeder' => SeedAction::class,

            // Core
            'behavior' => BehaviorAction::class,
            'component' => ComponentAction::class,
            'service' => ServiceAction::class,
            'filter' => FilterAction::class,
            'form' => FormAction::class,
            'job' => JobAction::class,
            'view' => ViewAction::class,

            // Modules
            'module' => ModuleAction::class,
            'api' => ApiAction::class,
        ];
    }
}