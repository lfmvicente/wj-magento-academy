<?php

declare(strict_types=1);

namespace Webjump\Pet\Api;

use Webjump\Pet\Api\Data\PetInterface;

interface PetRepositoryInterface
{
    /**
     * Get pet by Pet Id
     *
     * @param int $petId
     *
     * @return PetInterface
     *
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getById($petId);

    /**
     * Create or Update Pet
     *
     * @param PetInterface $pet
     *
     * @return PetInterface
     */
    public function save(PetInterface $pet);

    /**
     * Delete pet by Pet ID.
     *
     * @param int $petId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($petId);

}
