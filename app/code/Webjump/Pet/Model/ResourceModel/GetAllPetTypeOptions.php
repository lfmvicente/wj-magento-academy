<?php
/**
 * Created by PhpStorm.
 * User: webjump-nb138
 * Date: 15/09/20
 * Time: 16:25
 */

namespace Webjump\Pet\Model\ResourceModel;

use Webjump\Pet\Model\ResourceModel\PetResourceFactory;
use Magento\Framework\App\Config\ScopeConfigInterface;

class GetAllPetTypeOptions
{
    private $petResourceFactory;
    private $scopeConfig;

    public function __construct(PetResourceFactory $petResourceFactory, ScopeConfigInterface $scopeConfig)
    {
        $this->petResourceFactory = $petResourceFactory;
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * @return array
     */
    public function execute()
    {
        if ($this->scopeConfig->getValue('pet/general/enable')) {

            $petResource = $this->petResourceFactory->create();

            $connection = $petResource->getConnection();

            $select = $connection->select()
                ->from(['pk' => $connection->getTableName('pet_kind')], ['entity_id', 'name']);

            return $connection->fetchAssoc($select);
        }
        return [];
    }
}
