<?php

declare(strict_types=1);

namespace Webjump\Pet\Model;

use Webjump\Pet\Api\Data\PetInterface;

class Pet extends \Magento\Framework\Model\AbstractModel implements PetInterface
{

    protected function _construct()
    {
        $this->_init(\Webjump\Pet\Model\ResourceModel\PetResource::class);
    }

    public function getPetId()
    {
        return $this->getData('entity_id');
    }

    public function setPetId($id)
    {
        $this->setData('entity_id', $id);
    }

    public function getName()
    {
        return $this->getData('name');
    }

    public function setName(string $name)
    {
        $this->setData('name', $name);
    }

    public function getDescription()
    {
        return $this->getData('description');
    }

    public function setDescription(string $description)
    {
        $this->setData('description', $description);
    }

    public function getCreatedAt()
    {
        return $this->getData('created_at');
    }

    public function setCreatedAt($createdAt)
    {
        $this->getData('created_at', $createdAt);
    }
}
