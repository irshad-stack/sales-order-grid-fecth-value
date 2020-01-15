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
$product->setSku('Benzo-b-1'); // Set your sku here
$product->setName('Mouth Benzo'); // Name of Product
$product->setAttributeSetId(4); // Attribute set id
$product->setStatus(1); // Status on product enabled/ disabled 1/0
$product->setWeight(50); // weight of product
$product->setVisibility(4); // visibilty of product (catalog / search / catalog, search / Not visible individually)
$product->setTaxClassId(0); // Tax class id
$product->setTypeId('simple'); // type of product (simple/virtual/downloadable/configurable)
$product->setPrice(110); // price of product
$product->setStockData(
                        array(
                            'use_config_manage_stock' => 0,
                            'manage_stock' => 1,
                            'is_in_stock' => 1,
                            'qty' => 100
                        )
                    );
 
  $product->save();
$imagePath = "import/cat-12.jpg"; // path of the image
$product->addImageToMediaGallery($imagePath, array('image', 'small_image', 'thumbnail'), false, false);
$product->save();
// Adding Image to product
// $imagePath = "opt/lampp/htdocs/mage-2/media/"."aboutus.jpg"; // path of the image
// $product->addImageToMediaGallery($imagePath, array('image', 'small_image', 'thumbnail'), false, false);
// $product->save();

// Adding Custom option to product
// $options = array(
//                 array(
//                     "sort_order"    => 1,
//                     // "title"         => "Custom Option 1",
//                     "price_type"    => "fixed",
//                     // "price"         => "10",
//                     "type"          => "field",
//                     "is_require"    => 0
//                 ),
//                 array(
//                     "sort_order"    => 2,
//                     // "title"         => "Custom Option 2",
//                     "price_type"    => "fixed",
//                     // "price"         => "20",
//                     "type"          => "field",
//                     "is_require"    => 0
//                 )
//             );
// foreach ($options as $arrayOption) {
//     $product->setHasOptions(1);
//     $product->getResource()->save($product);
//     $option = $objectManager->create('\Magento\Catalog\Model\Product\Option')
//                     ->setProductId($product->getId())
//                     ->setStoreId($product->getStoreId())
//                     ->addData($arrayOption);
                     
//     $option->save();

//     $product->addOption($option);

// }