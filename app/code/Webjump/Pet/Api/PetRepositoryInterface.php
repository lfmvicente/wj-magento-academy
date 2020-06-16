<?php

declare(strict_types=1);

namespace Webjump\Pet\Api;

use Webjump\Pet\Api\Data\PetInterface;

interface PetRepositoryInterface
{
    /**
     * @param int $petId
     *
     * @return \Webjump\Pet\Api\Data\PetInterface
     *
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getById($petId);

    /**
     * @param \Webjump\Pet\Api\Data\PetInterface $pet
     *
     * @return \Webjump\Pet\Api\Data\PetInterface
     */
    public function save(PetInterface $pet);
}
