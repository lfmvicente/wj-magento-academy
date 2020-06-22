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
        return $this->getData('pet_name');
    }

    public function setName(string $petName)
    {
        $this->setData('pet_name', $petName);
    }

    public function getOwner()
    {
        return $this->getData('pet_owner');
    }

    public function setOwner(string $petOwner)
    {
        $this->setData('pet_owner', $petOwner);
    }

    public function getCreatedAt()
    {
        return $this->getData('created_at');
    }

    public function setCreatedAt($createdAt)
    {
        $this->getData('created_at', $createdAt);
    }

    public function getOwnerTelephone()
    {
        return $this->getData('owner_telephone');
    }

    public function setOwnerTelephone(string $telephone)
    {
        $this->setData('owner_telephone', $telephone);
    }

    public function getOwnerId()
    {
        return $this->getData('owner_id');
    }

    public function setOwnerId(int $ownerId)
    {
        $this->setData('owner_id', $ownerId);
    }
}
