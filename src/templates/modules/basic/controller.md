<?php

namespace {{namespace}}\controllers;

use manchenkov\yii\http\Controller;

class MainController extends Controller
{
    public function actionIndex()
    {
        return 'Module loaded!';
    }
}