<?php
namespace Mageplaza\CRUD\Block;
 
class Editcustomer extends \Magento\Framework\View\Element\Template
{
     protected $_pageFactory;
     protected $_coreRegistry;
     protected $_customerLoader;
 
     public function __construct(
          \Magento\Framework\View\Element\Template\Context $context,
          \Magento\Framework\View\Result\PageFactory $pageFactory,
          \Magento\Framework\Registry $coreRegistry,
          \Mageplaza\CRUD\Model\CustomerFactory $customerLoader,
          array $data = []
          )
     {
          $this->_pageFactory = $pageFactory;
          $this->_coreRegistry = $coreRegistry;
          $this->_customerLoader = $customerLoader;
          return parent::__construct($context,$data);
     }
 
     public function execute()
     {
          return $this->_pageFactory->create();
     }
 
     public function getCustomerEditRecord()
     {
          $id = $this->_coreRegistry->registry('editId');
          $customer = $this->_customerLoader->create();
          $result = $customer->load($id);
          $result = $result->getData();
          return $result;
     }
}