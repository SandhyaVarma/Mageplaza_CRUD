<?php
namespace Mageplaza\CRUD\Controller\Index;
 
class Search extends \Magento\Framework\App\Action\Action
{
     protected $_pageFactory;
     protected $_customdataCollection;
 
     public function __construct(
          \Magento\Framework\App\Action\Context $context,
          \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory,
          \Mageplaza\CRUD\Model\ResourceModel\Post\CollectionFactory $customdataCollection,
          )
     {
          $this->_customdataCollection = $customdataCollection;
          $this->resultJsonFactory = $resultJsonFactory;
          return parent::__construct($context);
     }
 
     public function execute()
     {
          $search_text = $this->getRequest()->getPost('search_text');

          $post = $this->_customdataCollection->create();
          $collection = $post->addFieldToFilter('name',['like' => '%'.$search_text.'%']);
          $resultJson = $this->resultJsonFactory->create();
          return $resultJson->setData([
                'data' => $collection->getData()
            ]);
       

     }
}
?>