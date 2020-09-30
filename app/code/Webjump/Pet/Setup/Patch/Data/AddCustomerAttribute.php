<?php
/**
 * Created by PhpStorm.
 * User: webjump-nb138
 * Date: 08/09/20
 * Time: 19:26
 */

declare(strict_types=1);

namespace Webjump\Pet\Setup\Patch\Data;


use Magento\Customer\Model\Customer;
use Magento\Customer\Setup\CustomerSetupFactory;
use Magento\Framework\App\ResourceConnection;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\Patch\PatchVersionInterface;
use Magento\Eav\Model\Config;

class AddCustomerAttribute implements DataPatchInterface
{
    private const USED_IN_FORM = [
        'adminhtml_customer',
        'checkout_register',
        'customer_account_create',
        'customer_account_edit',
        'adminhtml_checkout',
    ];

    private $moduleDataSetup;

    private $customerSetupFactory;

    private $eavConfig;

    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        CustomerSetupFactory $customerSetupFactory,
        Config $eavConfig
    ) {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->customerSetupFactory = $customerSetupFactory;
        $this->eavConfig = $eavConfig;
    }

    public function apply()
    {
        $customerSetup = $this->customerSetupFactory->create(['setup' => $this->moduleDataSetup]);
        $customerSetup->addAttribute(
            Customer::ENTITY,
            'custom_attribute_pet',
            [
                'type' => 'varchar',
                'label' => 'Pet Kind',
                'input' => 'select',
                'required' => false,
                'source' => \Webjump\Pet\Model\Source\PetTypeSource::class,
                'sort_order' => 10,
                'group' => 'General Information',
            ]
        );
        $customAttributePet = $this->eavConfig->getAttribute(Customer::ENTITY, 'custom_attribute_pet');
        $customAttributePet->setData('used_in_forms', self::USED_IN_FORM)
            ->setData('is_used_for_customer_segment', true)
            ->setData('is_system', 0)
            ->setData('is_user_defined', 1)
            ->setData('is_visible', 1)
            ->setData('sort_order', 44);
        $customAttributePet->save();
    }

    public static function getDependencies()
    {
        return [];
    }

    public function getAliases()
    {
        return [];
    }
}
