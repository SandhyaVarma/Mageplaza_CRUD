<?php
 
namespace Mageplaza\CRUD\Controller\Index;
 
class Save extends \Magento\Framework\App\Action\Action
{
     protected $_pageFactory;
     protected $_postFactory;
 
     public function __construct(
          \Magento\Framework\App\Action\Context $context,
          \Magento\Framework\View\Result\PageFactory $pageFactory,
          \Mageplaza\CRUD\Model\PostFactory $postFactory
     ){
          $this->_pageFactory = $pageFactory;
          $this->_postFactory = $postFactory;
          return parent::__construct($context);
     }
 
     public function execute()
     {
          try{
               if ($this->getRequest()->isPost()) {
                    $input = $this->getRequest()->getPostValue();
                    $post = $this->_postFactory->create();
                    if (isset($input['editRecordId'])) {
                         $id = $input['editRecordId'];
                    } else {
                         $id = 0;
                    }
                    if($id != 0){
                         $post->load($id);
                         $post->addData($input);
                         $post->setId($id);
                         $post->save();
                    }else{
                         $post->setData($input)->save();
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