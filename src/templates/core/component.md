<?php

declare(strict_types=1);

namespace {{namespace}};

use yii\base\BootstrapInterface;
use yii\base\Component;

final class {{class}} extends Component implements BootstrapInterface
{
    public function bootstrap($app): void
    {
        // code ...
    }

    public function init(): void
    {
        parent::init();

        // code ...
    }
}