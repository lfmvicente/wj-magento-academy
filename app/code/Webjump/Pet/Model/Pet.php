<?php

declare(strict_types=1);

namespace Webjump\Pet\Model;

use Webjump\Pet\Api\Data\PetInterface;

class Pet extends \Magento\Framework\Model\AbstractModel implements PetInterface
{
    private $id;
    private $name;
    private $owner;
    private $createdAt;
    private $ownerTelephone;
    private $ownerId;

    protected function _construct()
    {
        $this->_init('Webjump\Pet\Model\ResourceModel\PetResource');
    }

    public function getPetId()
    {
        return $this->id;
    }

    public function setPetId(int $id)
    {
        $this->id = $id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName(string $petName)
    {
        $this->name = $petName;
    }

    public function getOwner()
    {
        return $this->owner;
    }

    public function setOwner(string $petOwner)
    {
        $this->owner = $petOwner;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function setCreatedAt()
    {
        $this->createdAt = date('Y/m/d H:i:s');
    }

    public function getOwnerTelephone()
    {
        return $this->ownerTelephone;
    }

    public function setOwnerTelephone(string $telephone)
    {
        $this->ownerTelephone = $telephone;
    }

    public function getOwnerId()
    {
        return $this->ownerId;
    }

    public function setOwnerId(int $ownerId)
    {
        $this->ownerId = $ownerId;
    }
}
