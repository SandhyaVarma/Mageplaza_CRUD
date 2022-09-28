<?php

namespace Mageplaza\CRUD\Block;

use Magento\Framework\View\Element\Template;

class Index extends Template
{
    protected $_customFactory;
    protected $_customdataCollection;
    protected $_customerFactory;
    protected $_customerdataCollection;
 
    public function __construct(
        Template\Context $context,
        \Mageplaza\CRUD\Model\PostFactory $customFactory,
        \Mageplaza\CRUD\Model\CustomerFactory $customerFactory,
        \Mageplaza\CRUD\Model\ResourceModel\Post\CollectionFactory $customdataCollection,
        \Mageplaza\CRUD\Model\ResourceModel\Customer\CollectionFactory $customerdataCollection,  
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->_customFactory = $customFactory;
        $this->_customerFactory = $customerFactory;
        $this->_customdataCollection = $customdataCollection;
        $this->_customerdataCollection = $customerdataCollection;

    }
    public function getResult()
     {
          $post = $this->_customFactory->create();
          $collection = $post->getCollection();
          return $collection;
     }

     public function getResultData()
     {
          $customer = $this->_customerFactory->create();
          $collection = $customer->getCollection();
          return $collection;
     }

    protected function _prepareLayout()
    {
        $this->pageConfig->getTitle()->set(__('My Custom Pagination'));
        parent::_prepareLayout();
        $page_size = $this->getPagerCount();
        $customer_page_size=$this->getCustomerPagerCount();
        $page_data = $this->getCustomData();
        $customer_data=$this->getCustomerData();
        if ($this->getCustomData()) {
            $pager = $this->getLayout()->createBlock(
                \Magento\Theme\Block\Html\Pager::class,
                'custom.pager.name'
            )
                ->setAvailableLimit($page_size)
                ->setShowPerPage(true)
                ->setCollection($page_data);
            $this->setChild('pager', $pager);
            $this->getCustomData()->load();
        }
        if ($this->getCustomerData()) {
            $Customerpager = $this->getLayout()->createBlock(
                \Magento\Theme\Block\Html\Pager::class,
                'customer.pager.name'
            )
                ->setAvailableLimit($customer_page_size)
                ->setShowPerPage(true)
                ->setCollection($customer_data);
            $this->setChild('customerpager', $Customerpager);
            $this->getCustomerData()->load();
        }
        return $this;

    }

    public function getPagerHtml()
    {
        return $this->getChildHtml('pager');
    }
    public function getCustomerPagerHtml()
    {
        return $this->getChildHtml('customerpager');
    }

    public function getCustomData()
    {
        // get param values
        $page = ($this->getRequest()->getParam('p')) ? $this->getRequest()->getParam('p') : 1;
        $pageSize = ($this->getRequest()->getParam('limit')) ? $this->getRequest()->getParam('limit') : 5; // set minimum records
        // get custom collection
        $post = $this->_customFactory->create();
        $collection = $post->getCollection();
        $collection->setPageSize($pageSize);
        $collection->setCurPage($page);
        return $collection;
    }

    public function getCustomerData()
    {
        // get param values
        $page = ($this->getRequest()->getParam('p')) ? $this->getRequest()->getParam('p') : 1;
        $pageSize = ($this->getRequest()->getParam('limit')) ? $this->getRequest()->getParam('limit') : 5; // set minimum records
        $customer = $this->_customerFactory->create();
        $collection = $customer->getCollection();
        $collection->setPageSize($pageSize);
        $collection->setCurPage($page);
        return $collection;
    }

    public function getPagerCount()
    {
        // get collection
        $minimum_show = 5; // set minimum records
        $page_array = [];
        $list_data = $this->_customdataCollection->create();
        $list_count = ceil(count($list_data->getData()));
        $show_count = $minimum_show + 1;
        if (count($list_data->getData()) >= $show_count) {
            $list_count = $list_count / $minimum_show;
            $page_nu = $total = $minimum_show;
            $page_array[$minimum_show] = $minimum_show;
            for ($x = 0; $x <= $list_count; $x++) {
                $total = $total + $page_nu;
                $page_array[$total] = $total;
            }
        } else {
            $page_array[$minimum_show] = $minimum_show;
            $minimum_show = $minimum_show + $minimum_show;
            $page_array[$minimum_show] = $minimum_show;
        }
        return $page_array;
    }

    public function getCustomerPagerCount()
    {
        // get collection
        $minimum_show = 5; // set minimum records
        $page_array = [];
        $list_data = $this->_customerdataCollection->create();
        $list_count = ceil(count($list_data->getData()));
        $show_count = $minimum_show + 1;
        if (count($list_data->getData()) >= $show_count) {
            $list_count = $list_count / $minimum_show;
            $page_nu = $total = $minimum_show;
            $page_array[$minimum_show] = $minimum_show;
            for ($x = 0; $x <= $list_count; $x++) {
                $total = $total + $page_nu;
                $page_array[$total] = $total;
            }
        } else {
            $page_array[$minimum_show] = $minimum_show;
            $minimum_show = $minimum_show + $minimum_show;
            $page_array[$minimum_show] = $minimum_show;
        }
        return $page_array;
    }
}