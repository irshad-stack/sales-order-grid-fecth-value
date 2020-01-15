<?php
namespace Ahmad\OrderGrid\Plugin;

/**
 * Class AddDataToOrdersGrid
 */
class AddDataToOrdersGrid
{
    /**
     * @var \Psr\Log\LoggerInterface
     */
    private $logger;

    /**
     * AddDataToOrdersGrid constructor.
     *
     * @param \Psr\Log\LoggerInterface $customLogger
     * @param array $data
     */
    public function __construct(
        \Psr\Log\LoggerInterface $customLogger,
        array $data = []
    ) {
        $this->logger   = $customLogger;
    }

    /**
     * @param \Magento\Framework\View\Element\UiComponent\DataProvider\CollectionFactory $subject
     * @param \Magento\Sales\Model\ResourceModel\Order\Grid\Collection $collection
     * @param $requestName
     * @return mixed
     */
    public function afterGetReport($subject, $collection, $requestName)
    {
        if ($requestName !== 'sales_order_grid_data_source') {
            return $collection;
        }

         if ($collection->getMainTable() === $collection->getResource()->getTable('sales_order_grid')) {
            try {
                $orderAddressTableName           = $collection->getResource()->getTable('sales_order_address');
                $directoryCountryRegionTableName = $collection->getResource()->getTable('directory_country_region');
                
                $collection->getSelect()->joinLeft(
                    ['soat' => $orderAddressTableName],
                    'soat.parent_id = main_table.entity_id AND soat.address_type = \'shipping\'',
                    ['telephone']
                );
                $collection->getSelect()->joinLeft(
                    ['dcrt' => $directoryCountryRegionTableName],
                    'soat.region_id = dcrt.region_id',
                    ['code']
                );

                $collection->getSelect()
             ->join(array('ce1' => 'customer_entity'), 'ce1.entity_id=main_table.customer_id', array('firstname' => 'firstname', 'lastname' => 'lastname'))
            ->columns(new \Zend_Db_Expr("CONCAT(`ce1`.`firstname`, ' ',`ce1`.`lastname`) AS fullname"));

             $collection->getSelect()->joinLeft(
                    ["soa" => "sales_order_address"],
                    'main_table.entity_id = soa.parent_id AND soa.address_type="shipping"',
                    array( 'postcode', 'street', 'email', 'billing_company')
                )
                    ->distinct();

            } catch (\Zend_Db_Select_Exception $selectException) {
                // Do nothing in that case
                $this->logger->log(100, $selectException);
            }
        }


        return $collection;
    }
}

