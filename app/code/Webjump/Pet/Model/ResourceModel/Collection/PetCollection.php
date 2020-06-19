<?php

declare(strict_types=1);

namespace Webjump\Pet\Model\ResourceModel\Collection;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Webjump\Pet\Model\Pet;

class PetCollection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(
            'Webjump\Pet\Model\Pet',
            'Webjump\Pet\Model\ResourceModel\PetResource'
        );
    }
}
