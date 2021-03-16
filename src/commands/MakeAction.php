<?php

namespace manchenkov\yii\maker\commands;

use Exception;
use manchenkov\yii\console\command\Command;
use yii\base\Action;
use yii\base\InvalidConfigException;
use yii\console\ExitCode;

/**
 * Class MakeAction
 * @package manchenkov\yii\maker\actions
 */
abstract class MakeAction extends Action
{
    /**
     * @var MakeController|Command
     */
    public $controller;

    /**
     * {@inheritdoc}
     * @throws InvalidConfigException
     */
    public function init()
    {
        if (!$this->controller instanceof MakeController) {
            throw new InvalidConfigException('This action must be in a MakeController only!');
        }

        parent::init();
    }

    /**
     * Shows error message
     *
     * @param string $message
     */
    public function error(string $message): void
    {
        $this->controller->error($message);
    }

    /**
     * Shows info message
     *
     * @param string $message
     */
    public function info(string $message): void
    {
        $this->controller->info($message);
    }

    /**
     * Runs controller process method
     *
     * @param array $replacement
     * @param array $filesMap
     *
     * @return int
     */
    public function process(array $replacement, array $filesMap): int
    {
        $this->controller->replacement = $replacement;
        $this->controller->filesMap = $filesMap;

        try {
            $this->controller->process();
        } catch (Exception $exception) {
            $this->controller->error($exception->getMessage());

            return ExitCode::UNSPECIFIED_ERROR;
        }

        return ExitCode::OK;
    }
}