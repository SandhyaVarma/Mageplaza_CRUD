<?php
 
namespace Mageplaza\CRUD\Controller\Index;
 
class Savecustomer extends \Magento\Framework\App\Action\Action
{
     protected $_pageFactory;
     protected $_customerFactory;
 
     public function __construct(
          \Magento\Framework\App\Action\Context $context,
          \Magento\Framework\View\Result\PageFactory $pageFactory,
          \Mageplaza\CRUD\Model\CustomerFactory $customerFactory
     ){
          $this->_pageFactory = $pageFactory;
          $this->_customerFactory = $customerFactory;
          return parent::__construct($context);
     }
 
     public function execute()
     {
          try{
               if ($this->getRequest()->isPost()) {
                    $input = $this->getRequest()->getPostValue();
                    $customer = $this->_customerFactory->create();
                    if (isset($input['editId'])) {
                         $id = $input['editId'];
                    } else {
                         $id = 0;
                    }
                    if($id != 0){
                         $customer->load($id);
                         $customer->addData($input);
                         $customer->setId($id);
                         $customer->save();
                    }else{
                         $customer->setData($input)->save();
                    }
                    $this->messageManager->addSuccessMessage("Data added successfully!");
                    return $this->_redirect('crud/index/index');
               }
          }catch(\Exception $e){
               print_r($e->getMessage());
               exit();
          }
          return $this->_redirect('crud/index/index');
     }
}