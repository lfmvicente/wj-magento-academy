<?php

declare(strict_types=1);

namespace Webjump\Pet\Model\ResourceModel;

use Webjump\Pet\Api\PetRepositoryInterface;

class PetResource extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected function _construct()
    {
        $this->_init('pet_table', 'entity_id');
    }
}
