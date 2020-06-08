<?php

declare(strict_types=1);

namespace Webjump\RouterExample\Controller\RouterController;

use Magento\Framework\App\Action\Action;

class Index extends Action
{
    public function execute()
    {
        echo "Route Works well";
    }
}
