<?php
use Magento\Framework\App\Bootstrap;

require __DIR__ . '/app/bootstrap.php';
$params =  $_SERVER;
$bootstrap = Bootstrap::create(BP, $params);

$obj = $bootstrap->getObjectManager();

$state = $obj->get('Magento\Framework\App\State');
$state->setAreaCode('adminhtml');

//$objectManager = \Magento\Framework\App\ObjectManager::getInstance();

$om =   \Magento\Framework\App\ObjectManager::getInstance();
$cartData = $om->create('Magento\Checkout\Model\Cart')->getQuote()->getAllVisibleItems();
$cartDataCount = count( $cartData );

?>
<div class="bagDrop" id="bagDrop">
    <h4><a href="<?php echo $block->getShoppingCartUrl(); ?>">Quote Basket</a></h4>
    <?php if( $cartDataCount > 1 ): ?>
        <a href="#" class="arr up off" id="bagDropScrollUp"></a>
    <?php endif; ?>
    <div class="bagDropWindow">
    <?php if( $cartDataCount > 0 ): ?>
        <div class="bagDropList" id="bagDropList">
            <?php foreach( $cartData as $item ): ?>
            	echo "<pre>";
            	print_r($item->getData());
            	echo "</pre>";
                <?php $product = $item->getProduct(); ?>
                <?php $image = $product['small_image'] == '' ? '/pub/static/frontend/Clear/usb2u/en_GB/images/default-category-image_1.png' : '/pub/media/catalog/product' . $product['small_image']; ?>
                <a href="<?php echo $product['request_path']; ?>" class="bagDropListItem">
                    <img src="<?php echo $image; ?>">
                    <p>
                        <span class="name"><?php echo $product['name']; ?></span><br>
                        <span class="qty">x <?php echo $item->getQty(); ?></span>
                    </p>
                </a>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <div class="emptyList">No products in your basket.</div>
    <?php endif; ?>
    </div>
    <?php if( $cartDataCount > 1 ): ?>
        <a href="#" class="arr dn" id="bagDropScrollDown"></a>
    <?php endif; ?>
</div>
