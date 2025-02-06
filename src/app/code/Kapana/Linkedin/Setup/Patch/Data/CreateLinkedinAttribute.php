<?php

namespace Kapana\Linkedin\Setup\Patch\Data;

use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface;
use Magento\Customer\Model\Customer;
use Magento\Eav\Model\Entity\Attribute\Set as AttributeSet;
use Magento\Eav\Model\Entity\Attribute\Group as AttributeGroup;

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

        // Create the 'linkedin_profile' attribute.
        $eavSetup->addAttribute(
            Customer::ENTITY,
            'linkedin_profile',
            [
                'type' => 'varchar',
                'label' => 'LinkedIn Profile',
                'input' => 'text',
                'required' => false, // We'll handle requirement logic via config.
                'unique' => true,
                'visible' => true,
                'position' => 999,
                'system' => false,
                'maxlength' => 250,
                // Additional validations could be set via 'frontend_class' => 'validate-url'
                // But we might do further server-side checks in Observer.

                'user_defined' => true,
                'visible_on_front' => true,
                'sort_order' => 999,

                'frontend_input' => 'text',
                'frontend_label' => 'LinkedIn Profile',

                // Make it an attribute customers can edit in front-end and admin.
                'used_in_forms' => [
                    'adminhtml_customer',
                    'customer_account_create',
                    'customer_account_edit'
                ],
            ]
        );

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
