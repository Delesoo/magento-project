<?php

namespace Kapana\Linkedin\Model\Config\Source;

use Magento\Framework\Option\ArrayInterface;

class FieldMode implements ArrayInterface
{
    public function toOptionArray()
    {
        return [
            ['value' => 'hidden', 'label' => __('Hidden')],
            ['value' => 'optional', 'label' => __('Optional')],
            ['value' => 'required', 'label' => __('Required')],
        ];
    }
}
