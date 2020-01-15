<?php
use Magento\Framework\App\Bootstrap;
require 'app/bootstrap.php';
$bootstrap = Bootstrap::create(BP, $_SERVER);
$objectManager = $bootstrap->getObjectManager();
$state = $objectManager->get('\Magento\Framework\App\State');
$state->setAreaCode('frontend');
$product = $objectManager->create('Magento\Catalog\Model\Product');
$objectManager = \Magento\Framework\App\ObjectManager::getInstance(); // instance of object manager
$product = $objectManager->create('\Magento\Catalog\Model\Product');
$storeManager = $objectManager->create("\Magento\Store\Model\StoreManagerInterface");
$stores = $storeManager->getStores(true, false);
foreach($stores as $store){
    echo "store id:" . " " . $store->getId()." ; " .  " store code:" . $store->getCode(). " ; " . "storewebsite:" . $store->getWebsiteId() . " ; " . "store enable status: " . " " .
     $store->isActive(). ";" . " store current url". " " .   $store->getCurrentUrl(true)  . "\n" . "</br>";
}