<?php

declare(strict_types=1);

namespace Webjump\Pet\Ui\Component\Data;

use Magento\Ui\DataProvider\AbstractDataProvider;
use Webjump\Pet\Model\ResourceModel\Collection\PetCollectionFactory;
use Webjump\Pet\Api\Data\PetInterface;

class DataProvider extends AbstractDataProvider
{

    public function __construct(
        string $name,
        string $primaryFieldName,
        string $requestFieldName,
        PetCollectionFactory $petCollectionFactory,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $petCollectionFactory->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }
    /**
     * Get Data
     *
     * @return array
     */
    public function getData()
    {
        $loadedData = [];
        /** @var PetInterface[] $items */
        $items = $this->collection->getItems();
        foreach ($items as $minQtyItem) {
            $loadedData[$minQtyItem->getPetId()] = $minQtyItem->getData();
        }
        return $loadedData;
    }
}