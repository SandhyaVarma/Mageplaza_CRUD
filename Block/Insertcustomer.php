<?php
namespace Mageplaza\CRUD\Block;
 
class Insertcustomer extends \Magento\Framework\View\Element\Template
{
     protected $_pageFactory;
     protected $_customerLoader;
 
     public function __construct(
          \Magento\Framework\View\Element\Template\Context $context,
          \Magento\Framework\View\Result\PageFactory $pageFactory
          )
     {
          $this->_pageFactory = $pageFactory;
          return parent::__construct($context);
     }
 
     public function execute()
     {
          return $this->_pageFactory->create();
     }
}