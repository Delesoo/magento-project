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
                'label' => 'LinkedIn Profile',
                'input' => 'text',
                'required' => false,
                'unique' => false,
                'visible' => true,
                'position' => 999,
                'system' => false,
                'validate_rules' => '{"max_text_length":250,"min_text_length":0}',
                'user_defined' => true,
                'visible_on_front' => true,
                'sort_order' => 999,
                'frontend_input' => 'text',
                'frontend_label' => 'LinkedIn Profile',
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
