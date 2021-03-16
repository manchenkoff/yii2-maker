<?php

declare(strict_types=1);

namespace {{namespace}};

use yii\base\BaseObject;
use yii\queue\JobInterface;
use yii\queue\Queue;
use yii\queue\RetryableJobInterface;

final class {{class}} extends BaseObject implements JobInterface, RetryableJobInterface
{
    private const TTR_IN_SECONDS = 3000; // 5 minutes

    /**
     * @param Queue $queue which pushed and is handling the job
     */
    public function execute($queue): void
    {
        // code ...
    }

    /**
     * @return int time to reserve in seconds
     */
    public function getTtr(): int
    {
        return self::TTR_IN_SECONDS;
    }

    /**
     * @param int $attempt number
     * @param \Exception|\Throwable $error from last execute of the job
     *
     * @return bool
     */
    public function canRetry($attempt, $error): bool
    {
        // code ...

        return true;
    }
}