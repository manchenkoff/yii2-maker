<?php

declare(strict_types=1);

namespace {{namespace}}\controllers;

use yii\web\Controller;

final class MainController extends Controller
{
    public function actionIndex(): string
    {
        return 'Module loaded!';
    }
}