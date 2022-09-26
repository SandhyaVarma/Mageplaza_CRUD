<?php
namespace Mageplaza\CRUD\Model\ResourceModel\Customer;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
	protected $_idFieldName = 'id';
	protected $_eventPrefix = 'mageplaza_crud_collection';
	protected $_eventObject = 'crud_collection';

	/**
	 * Define resource model
	 *
	 * @return void
	 */
	protected function _construct()
	{
		$this->_init('Mageplaza\CRUD\Model\Customer', 'Mageplaza\CRUD\Model\ResourceModel\Customer');
	}

}
