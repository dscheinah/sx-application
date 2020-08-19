<?php
namespace Sx\ApplicationTest\Mock;

use Sx\Log\LogInterface;

class Log implements LogInterface
{
    public $logged = [];

    public function log(string $message): void
    {
        $this->logged[$message] = true;
    }
}
