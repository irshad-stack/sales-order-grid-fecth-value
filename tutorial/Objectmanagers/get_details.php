 <?php
use Magento\Framework\App\Bootstrap;

require __DIR__ . '/app/bootstrap.php';
$params =  $_SERVER;
$bootstrap = Bootstrap::create(BP, $params);

$obj = $bootstrap->getObjectManager();

$state = $obj->get('Magento\Framework\App\State');
$state->setAreaCode('adminhtml');

$productId = "1"; //Product Id

$objectManager = \Magento\Framework\App\ObjectManager::getInstance();
$product = $objectManager->create('Magento\Catalog\Model\Product')->load($productId); 
 
/** start product details */
echo "name:"   .$product->getName()      ."<br>";
echo "id:"     .$product->getid()        ."<br>";
echo "category".$product->getCategory()  ."<br>";
echo "price:"  .$product->getPrice()     ."<br>";
echo 'sku:'    .$product->getSku()       .'<br>'; 
/** End product details */

echo "<pre>"; print_r($product->debug());  // get full details of product with array


/** start get category details*/ 
categoryLoop(1);  // enter your category id here
function categoryLoop($id){
    $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
    $categories = $objectManager->create('Magento\Catalog\Model\Category')->load($id);

    if($categories->hasChildren()){
    echo "<ul>";
        $subcategories = explode(',', $categories->getChildren());
        foreach ($subcategories as $category) {
            $subcategory = $objectManager->create('Magento\Catalog\Model\Category')->load($category);
            echo "<li>";
            echo $subcategory->getName();
            echo "</li>";
            //echo "<br>";
            if($subcategory->hasChildren()){ categoryLoop($category); }
        }
    echo "</ul>";
    }
}
/** End get category details */ 
       
    /** start  product images  details  */
        $objectmanager = \Magento\Framework\App\ObjectManager::getInstance();
        $product_id = 2; //Replace with your product Id
        $product = $objectmanager ->create('Magento\Catalog\Model\Product')->load($product_id);
        $productimages = $product->getMediaGalleryImages();
        foreach($productimages as $productimage)

        {
            echo "<img src = ".$productimage['url']. " height=100 width=100 />";
             echo "<pre>"; print_r($productimage->debug()); 
        }
    /** End  product images  details  */
    $urlInterface = \Magento\Framework\App\ObjectManager::getInstance()->get('Magento\Framework\UrlInterface');
    $urlInterface->getCurrentUrl();
/** start store current page url,,  can use in phtml also inside <?php ?>*/
$objectManager = \Magento\Framework\App\ObjectManager::getInstance();
$storeManager = $objectManager->get('\Magento\Store\Model\StoreManagerInterface');
echo $baseurl = $storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_WEB). "</br>"; 
echo $secureBaseUrl = $storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_WEB,true); 
 /** end  store current page url */
 die("dead");

// $productId = "10"; //Product Id
// $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
// $product = $objectManager->create('Magento\Catalog\Model\Product')->load($productId);

// echo $product->getName(); //Get Product Name
// echo $product->getPrice()."<br>"; //G
// echo $product->getcolor()."<br>"; //G



/**
// * ~ delete out of  stockp product programatically ~* 
$objectManager = \Magento\Framework\App\ObjectManager::getInstance();
$objectManager->get('Magento\Framework\Registry')->register('isSecureArea', true);

$productRepository = $objectManager->create('Magento\Catalog\Model\ProductRepository');
$productCollectionFactory = $objectManager->get('\Magento\Catalog\Model\ResourceModel\Product\CollectionFactory');
$productcollection = $productCollectionFactory->create()
                        ->addAttributeToSelect('*')
                        ->joinField('stock_item', 'cataloginventory_stock_item', 'qty', 'product_id=entity_id', 'qty=0')
                        //->setPageSize(8) //Set limit
                        ->load();

foreach ($productcollection as $product) {
    try {
        echo "Product ".$product->getId()." deleted";
        $product->delete();
    } catch (\Exception $e) {
        echo 'Failed to remove product '.$product->getName() .PHP_EOL;
        echo $e->getMessage() . "\n" .PHP_EOL;

    } 
}
*/
/**
/* ~  remove images fro product */
/*
$productId = 2; // Id of product
$product = $objectManager->create('Magento\Catalog\Model\Product')->load($productId);
$productRepository = $objectManager->create('Magento\Catalog\Api\ProductRepositoryInterface');
$existingMediaGalleryEntries = $product->getMediaGalleryEntries();
foreach ($existingMediaGalleryEntries as $key => $entry) {
    unset($existingMediaGalleryEntries[$key]);
}
$product->setMediaGalleryEntries($existingMediaGalleryEntries);
$productRepository->save($product);
*/
// /*Add Images To The Product*/
// $imagePath = "sample.png"; // path of the image
// $product->addImageToMediaGallery($imagePath, array('image', 'small_image', 'thumbnail'), false, false);
// $product->save();