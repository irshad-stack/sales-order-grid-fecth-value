<?php
use Magento\Framework\App\Bootstrap;

require __DIR__ . '/app/bootstrap.php';
$params =  $_SERVER;
$bootstrap = Bootstrap::create(BP, $params);

$obj = $bootstrap->getObjectManager();

$state = $obj->get('Magento\Framework\App\State');
$state->setAreaCode('adminhtml');

$objectManager = \Magento\Framework\App\ObjectManager::getInstance();
$customerFactory = $objectManager->get('\Magento\Customer\Model\CustomerFactory')->create();

$customerId = 1;

$customer = $customerFactory->load($customerId);

$billingAddressId = $customer->getDefaultBilling();
$address = $objectManager->get('Magento\Customer\Model\AddressFactory')->create()->load($billingAddressId);

echo $address->getData('firstname')."<br>";
echo $address->getData('lastname')."<br>";
echo $address->getData('street')."<br>";
echo $address->getData('city')."<br>";
echo $address->getData('region')."<br>";
echo $address->getData('postcode')."<br>";
echo $address->getData('country_id')."<br>";