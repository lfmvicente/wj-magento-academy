<?php

declare(strict_types=1);

namespace Webjump\Pet\Api\Data;

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
     * Get pet description
     *
     * @return string|null
     */
    public function getDescription();

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
}
