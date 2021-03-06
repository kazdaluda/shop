<?php

namespace shop\jobs;


abstract class Job implements \zhuravljov\yii\queue\Job
{


    public function execute($queue): void
    {
        $listener = $this->resolveHandler();

        $listener($this, $queue);

    }

    private function resolveHandler()
    {

       return  [\Yii::createObject(static::class . 'Handler'), 'handle'];

    }
}