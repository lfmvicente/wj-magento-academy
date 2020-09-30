<?php
/**
 * Created by PhpStorm.
 * User: webjump-nb138
 * Date: 15/09/20
 * Time: 16:23
 */

declare(strict_types=1);

namespace Webjump\Pet\Model\Source;

use Magento\Eav\Model\Entity\Attribute\Source\AbstractSource;
use Webjump\Pet\Model\ResourceModel\GetAllPetTypeOptions;
use Magento\Framework\App\Config\ScopeConfigInterface;

class PetTypeSource extends AbstractSource
{

    private $getPetOptions;
    private $scopeConfig;

    public function __construct(GetAllPetTypeOptions $getPetOptions, ScopeConfigInterface $scopeConfig)
    {
        $this->getPetOptions = $getPetOptions;
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * Retrieve All options
     *
     * @return array
     */
    public function getAllOptions()
    {
        if ($this->_options === null) {

             $petKind = $this->getPetOptions->execute();

             if (count($petKind) <= 0) {
                 return [];
             }

             foreach ($petKind as $item) {
                 $this->_options[] = ['label' => $item['name'], 'value' => $item['entity_id']];
             }
        }
        return $this->_options;
    }
}