<?php

declare(strict_types=1);

namespace Webjump\Pet\Model\ResourceModel\Collection;

class PetCollection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected function _construct()
    {
        $this->_init(
            \Webjump\Pet\Model\Pet::class,
            \Webjump\Pet\Model\ResourceModel\PetResource::class
        );
    }
}
