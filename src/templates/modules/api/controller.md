<?php

declare(strict_types=1);

namespace app\modules\api\controllers;

use manchenkov\yii\http\Controller;
use manchenkov\yii\http\rest\Middleware;

class MainController extends Controller
{
    use Middleware;

    /**
     * AccessControl rules
     * @return array
     *
     * @example
     * ```php
     * return [
     *     [
     *         'allow' => true|false,
     *         'roles' => ['?'],
     *         'action' => ['index', 'action']
     *     ],
     * ];
     * ```
     */
    protected function accessRules(): array
    {
        return [];
    }

    /**
     * Array of actions without authentication
     * @return array
     */
    protected function publicActions(): array
    {
        return [];
    }

    public function actionIndex(): string
    {
        return 'API module loaded!';
    }
}