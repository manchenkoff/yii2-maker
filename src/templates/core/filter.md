<?php

declare(strict_types=1);

namespace {{namespace}};

use yii\base\ActionFilter;

final class {{class}} extends ActionFilter
{
    public function beforeAction($action)
    {
        // code ...

        return parent::beforeAction($action);
    }

    public function afterAction($action, $result)
    {
        // code ...

        return parent::afterAction($action, $result);
    }
}