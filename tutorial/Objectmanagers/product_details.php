<?php
use Magento\Framework\App\Bootstrap;

require __DIR__ . '/app/bootstrap.php';
$params =  $_SERVER;
$bootstrap = Bootstrap::create(BP, $params);

$obj = $bootstrap->getObjectManager();

$state = $obj->get('Magento\Framework\App\State');
$state->setAreaCode('adminhtml');

$objectManager = \Magento\Framework\App\ObjectManager::getInstance();
 
// get the list of all categories
$categoryCollection = $objectManager->get('\Magento\Catalog\Model\ResourceModel\Category\CollectionFactory');
$categories = $categoryCollection->create();
$categories->addAttributeToSelect('*');
  
foreach ($categories as $category) {
    echo $category->getId() . '<br />';
    echo $category->getName() . '<br />';
    echo $category->getUrl() . '<br />';
}
 
// get current store’s categories 
$categoryHelper = $objectManager->get('\Magento\Catalog\Helper\Category');
$categories = $categoryHelper->getStoreCategories();
  
foreach ($categories as $category) {
    echo $category->getId() . '<br />';
    echo $category->getName() . '<br />';
}
// echo  "get produuct  details" . "</br>";
// $objectManager = \Magento\Framework\App\ObjectManager::getInstance(); 
  
// $productCollectionFactory = $objectManager->get('\Magento\Catalog\Model\ResourceModel\Product\CollectionFactory');
// $collection = $productCollectionFactory->create();
// $collection->addAttributeToSelect('*');
 
// // filter current website products
// $collection->addWebsiteFilter();
 
// // filter current store products
// $collection->addStoreFilter();
 
// // set visibility filter
// $collection->setVisibility($objectManager->get('\Magento\Catalog\Model\Product\Visibility')->getVisibleInSiteIds());
 
// // fetching only 5 products
// $collection->setPageSize(10); 
//     foreach ($collection as $product) { 
//     echo $product->getId() . '<br />';
//     echo $product->getName() . '<br />';
// }