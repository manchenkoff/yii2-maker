<?php

declare(strict_types=1);

namespace {{namespace}};

use yii\base\BaseObject;
use yii\queue\JobInterface;
use yii\queue\Queue;
use yii\queue\RetryableJobInterface;

class {{class}} extends BaseObject implements JobInterface, RetryableJobInterface
{
    /**
     * @param Queue $queue which pushed and is handling the job
     */
    public function execute($queue): void
    {
        // Your code
    }

    /**
     * @return int time to reserve in seconds
     */
    public function getTtr(): int
    {
        // 5 minutes
        return 60 * 5;
    }

    /**
     * @param int $attempt number
     * @param \Exception|\Throwable $error from last execute of the job
     *
     * @return bool
     */
    public function canRetry($attempt, $error): bool
    {
        // Your code
        return true;
    }
}