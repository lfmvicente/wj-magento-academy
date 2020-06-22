<?php

declare(strict_types=1);

namespace Webjump\Pet\Api\Data;

use Magento\Customer\Api\Data\CustomerInterface;

interface PetInterface
{

    /**
     * Get entity id
     *
     * @return int|null
     */
    public function getPetId();

    /**
     * Set entity id
     *
     * @param int|string $id
     *
     * @return $this
     */
    public function setPetId($id);

    /**
     * Get pet name
     *
     * @return string|null
     */
    public function getName();

    /**
     * Set pet name
     *
     * @param string $petName
     *
     * @return $this
     */
    public function setName(string $petName);

    /**
     * Get pet owner
     *
     * @return string|null
     */
    public function getOwner();

    /**
     * Set pet owner
     *
     * @param string $petOwner
     *
     * @return $this
     */
    public function setOwner(string $petOwner);

    /**
     * Get created at
     *
     * @return string|null
     */
    public function getCreatedAt();

    /**
     * Set created at
     *
     * @param string $date
     *
     * @return $this
     */
    public function setCreatedAt($createdAt);

    /**
     * Get owner telephone
     *
     * @return string|null
     */
    public function getOwnerTelephone();

    /**
     * Set owner telephone
     *
     * @param string $telephone
     *
     * @return $this
     */
    public function setOwnerTelephone(string $telephone);

    /**
     * Get owner id
     *
     * @return int|null
     */
    public function getOwnerId();

    /**
     * Set Owner id
     *
     * @param int $ownerId
     *
     * @return $this
     */
    public function setOwnerId(int $ownerId);
}
