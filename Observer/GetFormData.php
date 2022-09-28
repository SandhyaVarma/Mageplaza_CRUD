<?php

namespace Mageplaza\CRUD\Observer;

class GetFormData implements \Magento\Framework\Event\ObserverInterface
{
	public function execute(\Magento\Framework\Event\Observer $observer)
	{
		// $getData = $observer->getData('post');
		// $getName = $getData->getName();
        $getData = $observer->getEvent()->getPosts();
		
		$writer = new \Zend_Log_Writer_Stream(BP . '/var/log/form.log'); //custom log file
        $logger = new \Zend_Log();
        $logger->addWriter($writer);
        $logger->info(print_r($getData['name'],true));
       
		return $this;
	}
}
