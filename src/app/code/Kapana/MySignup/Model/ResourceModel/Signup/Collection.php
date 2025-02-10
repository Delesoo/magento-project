<?php
/**
 * Collection.php
 *
 * @category  Kapana
 * @package   Kapana_MySignup
 */

namespace Kapana\MySignup\Model\ResourceModel\Signup;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Kapana\MySignup\Model\Signup as SignupModel;
use Kapana\MySignup\Model\ResourceModel\Signup as SignupResource;

/**
 * Signup Collection
 */
class Collection extends AbstractCollection
{
    /**
     * Define model & resource model.
     *
     * This method is called by Magento to initialize the collection
     * with the model and resource model classes.
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(SignupModel::class, SignupResource::class);
    }
}
