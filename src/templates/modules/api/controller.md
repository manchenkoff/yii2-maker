<?php

declare(strict_types=1);

namespace app\modules\api\controllers;

use yii\web\Controller;

final class MainController extends Controller
{
    public function actionIndex(): string
    {
        return 'API module loaded!';
    }
}