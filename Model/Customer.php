<?php
namespace Mageplaza\CRUD\Model;
 
class Customer extends \Magento\Framework\Model\AbstractModel implements \Magento\Framework\DataObject\IdentityInterface
{
    const CACHE_TAG = 'mageplaza_crud_customer';

	protected $_cacheTag = 'mageplaza_crud_customer';

	protected $_eventPrefix = 'mageplaza_crud_customer';

        protected function _construct()
        {
                $this->_init('Mageplaza\CRUD\Model\ResourceModel\Customer');
        }
 
        public function getIdentities()
        {
                return [self::CACHE_TAG . '_' . $this->getId()];
        }
 
        public function getDefaultValues()
        {
                $values = [];
 
                return $values;
        }
}