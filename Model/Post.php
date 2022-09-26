<?php
namespace Mageplaza\CRUD\Model;
 
class Post extends \Magento\Framework\Model\AbstractModel implements \Magento\Framework\DataObject\IdentityInterface
{
        const CACHE_TAG = 'post';

	protected $_cacheTag = 'post';

	protected $_eventPrefix = 'post';

        protected function _construct()
        {
                $this->_init('Mageplaza\CRUD\Model\ResourceModel\Post');
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