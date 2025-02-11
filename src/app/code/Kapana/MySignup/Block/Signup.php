<?php

namespace Kapana\MySignup\Block;

use Magento\Framework\View\Element\Template;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;

class Signup extends Template
{
    /**
     * @var ScopeConfigInterface
     */
    protected $scopeConfig;

    public function __construct(
        Template\Context     $context,
        ScopeConfigInterface $scopeConfig,
        array                $data = []
    )
    {
        $this->scopeConfig = $scopeConfig;
        parent::__construct($context, $data);
    }

    /**
     * Check if the signup form is enabled.
     *
     * @return bool
     */
    public function isSignupEnabled()
    {
        return (bool)$this->scopeConfig->getValue(
            'kapana_mysignup/general/enabled',
            ScopeInterface::SCOPE_STORE
        );
    }
}
