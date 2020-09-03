<?php

declare(strict_types=1);

namespace Webjump\Pet\Model\ResourceModel;

class PetResource extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{

    protected function _construct()
    {
        $this->_init('pet_kind', 'entity_id');
    }

}
