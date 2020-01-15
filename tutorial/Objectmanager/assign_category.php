<?php
use Magento\Framework\App\Bootstrap;

require __DIR__ . '/app/bootstrap.php';
$params =  $_SERVER;
$bootstrap = Bootstrap::create(BP, $params);

$obj = $bootstrap->getObjectManager();

$state = $obj->get('Magento\Framework\App\State');
$state->setAreaCode('adminhtml');

$objectManager = \Magento\Framework\App\ObjectManager::getInstance();
// assign  product in specific category 


$CategoryLinkRepository = $objectManager->get('\Magento\Catalog\Api\CategoryLinkManagementInterface');
 $category_ids = array('8');
$sku = 'AD1-D';
 
$CategoryLinkRepository->assignProductToCategories($sku, $category_ids); 
// end  assign  product in specific category

// remove   asigned  product from specific category

/* $CategoryLinkRepository = $objectManager->get('\Magento\Catalog\Model\CategoryLinkRepository');
$categoryId = 3;
$sku = 'ADS-K1';
 $CategoryLinkRepository->deleteByIds($categoryId,$sku); 
// end remove   asigned  product from specific category


/*
//To preserve previous assign categories you first need to create an array of previously assigning category id along with a new category id
$productCollectionFactory = $objectManager->get('\Magento\Catalog\Model\ResourceModel\Product\CollectionFactory');
$collection = $productCollectionFactory->create();
$collection->setPageSize(50);
 
$CategoryLinkRepository = $objectManager->get('\Magento\Catalog\Api\CategoryLinkManagementInterface');
 
foreach ($collection as $product) {
     
    //previous category array
    $previous_category_ids = $product->getCategoryIds();
 
   //add new category id in previous category array
    $previous_category_id[] = 101;
 
    $CategoryLinkRepository->assignProductToCategories($product->getSku(), $previous_category_id);
 
}*/



?>
