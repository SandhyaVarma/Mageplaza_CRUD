<?php
namespace Mageplaza\CRUD\Controller\Index;
 
class Deletecustomer extends \Magento\Framework\App\Action\Action
{
     protected $_pageFactory;
     protected $_request;
     protected $_customerFactory;
 
     public function __construct(
          \Magento\Framework\App\Action\Context $context,
          \Magento\Framework\View\Result\PageFactory $pageFactory,
          \Magento\Framework\App\Request\Http $request,
          \Mageplaza\CRUD\Model\CustomerFactory $customerFactory
          )
     {
          $this->_pageFactory = $pageFactory;
          $this->_request = $request;
          $this->_customerFactory = $customerFactory;
          return parent::__construct($context);
     }
 
     public function execute()
     {
          $id = $this->_request->getParam('id');
          $customer = $this->_customerFactory->create();
          $result = $customer->setId($id);
          $result = $result->delete();
          return $this->_redirect('crud/index/index');
     }
}