<?php

namespace Kapana\Linkedin\Setup\Patch\Data;

use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Customer\Model\Customer;

class CreateLinkedinAttribute implements DataPatchInterface
{
    /**
     * @var ModuleDataSetupInterface
     */
    private $moduleDataSetup;

    /**
     * @var EavSetupFactory
     */
    private $eavSetupFactory;

    /**
     * @param ModuleDataSetupInterface $moduleDataSetup
     * @param EavSetupFactory $eavSetupFactory
     */
    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        EavSetupFactory          $eavSetupFactory
    )
    {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->eavSetupFactory = $eavSetupFactory;
    }

    /**
     * {@inheritdoc}
     */
    public function apply()
    {
        $this->moduleDataSetup->getConnection()->startSetup();

        /** @var \Magento\Eav\Setup\EavSetup $eavSetup */
        $eavSetup = $this->eavSetupFactory->create(['setup' => $this->moduleDataSetup]);

        $eavSetup->addAttribute(
            Customer::ENTITY,
            'linkedin_profile',
            [
                'type' => 'varchar',
                'input' => 'text',
                'label' => 'LinkedIn Profile',
                'required' => false,
                'visible' => true,
                'system' => false,
                'position' => 999,
                'user_defined' => true,
                'sort_order' => 999,
                'backend' => '',
                'source' => '',
                'is_used_in_grid' => true,
                'is_visible_in_grid' => true,
                'is_filterable_in_grid' => true,
                'is_searchable_in_grid' => true,
                'used_in_forms' => [
                    'adminhtml_customer',
                    'customer_account_create',
                    'customer_account_edit'
                ],
                'backend_type' => 'static'
            ]
        );
        $attribute = $eavSetup->getEavConfig()->getAttribute(Customer::ENTITY, 'linkedin_profile');
        $attribute->setData(
            'used_in_forms',
            [
                'adminhtml_customer',
                'customer_account_create',
                'customer_account_edit'
            ]
        );
        $attribute->save();

        $this->moduleDataSetup->getConnection()->endSetup();
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public static function getDependencies()
    {
        return [];
    }

    /**
     * {@inheritdoc}
     */
    public function getAliases()
    {
        return [];
    }
}
