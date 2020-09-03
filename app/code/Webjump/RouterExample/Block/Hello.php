<?php

declare(strict_types=1);

namespace Webjump\RouterExample\Block;

use Magento\Framework\View\Element\Template;

class Hello extends Template
{
    public function getHello()
    {
        return 'Hello World';
    }
}
