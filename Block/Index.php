<?php
namespace Mageplaza\CRUD\Block;
 
use Magento\Framework\App\Filesystem\DirectoryList;
 
class Index extends \Magento\Framework\View\Element\Template
{
     protected $_filesystem;
     protected $_postFactory;
     protected $_customerFactory;
 
     public function __construct(
          \Magento\Framework\View\Element\Template\Context $context,
          \Mageplaza\CRUD\Model\PostFactory $postFactory,
          \Mageplaza\CRUD\Model\CustomerFactory $customerFactory
          )
     {
          parent::__construct($context);
          $this->_postFactory = $postFactory;
          $this->_customerFactory = $customerFactory;
     }
 
     public function getResult()
     {
          $post = $this->_postFactory->create();
          $collection = $post->getCollection();
          return $collection;
     }

     public function getResultData()
     {
          $customer = $this->_customerFactory->create();
          $collection = $customer->getCollection();
          return $collection;
     }
}