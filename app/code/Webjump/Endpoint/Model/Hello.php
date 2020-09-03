<?php

declare(strict_types=1);

namespace Webjump\Endpoint\Model;

use Webjump\Endpoint\Api\HelloInterface;

class Hello implements HelloInterface
{
    public function name(?string $name = ''): string
    {
        return 'Hello ' . $name;
    }
}
