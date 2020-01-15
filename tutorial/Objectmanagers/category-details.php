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
// $categoryCollection = $objectManager->get('\Magento\Catalog\Model\ResourceModel\Category\CollectionFactory');
// $categories = $categoryCollection->create();
// $categories->addAttributeToSelect('*');

// foreach ($categories as $category) {
//     echo $category->getId() . '<br />';
//     echo $category->getName() . '<br />';
//     echo $category->getUrl() . '<br />';
// }

// // get current store’s categories
// $categoryHelper = $objectManager->get('\Magento\Catalog\Helper\Category');
// $categories = $categoryHelper->getStoreCategories();

// foreach ($categories as $category) {
//     echo $category->getId() . '<br />';
//     echo $category->getName() . '<br />';
// }

$productId = 29;
$objectManager = \Magento\Framework\App\ObjectManager::getInstance();
$product = $objectManager->get('Magento\Catalog\Model\Product')->load($productId);
$productType = $product->getTypeID();
if($productType == 'simple')
{   
  echo "Simple Product";
} 
if($productType == 'configurable')
{   
  echo "Configurable Product";
} 