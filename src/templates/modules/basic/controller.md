<?php

declare(strict_types=1);

namespace {{namespace}}\controllers;

use manchenkov\yii\http\Controller;

class MainController extends Controller
{
    public function actionIndex(): string
    {
        return 'Module loaded!';
    }
}