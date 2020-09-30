<?php

declare(strict_types=1);

namespace Webjump\Pet\Controller\Index;

use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\Action;
use Webjump\Pet\Model\Data;
use Magento\Catalog\Model\Product\Attribute\Repository;

class Config extends Action
{

    protected $data;
    private $attribute;

    public function __construct(
        Context $context,
        Data $data,
        Repository $attribute
    )
    {
        $this->data = $data;
        $this->attribute = $attribute;
        return parent::__construct($context);
    }

    public function execute()
    {

        echo $this->data->getGeneralConfig('enable');
        echo $this->data->getGeneralConfig('display_text');
//        echo $this->attribute->getData('custom_attribute_pet');
        exit();

    }
}

