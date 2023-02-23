<?php
declare(strict_types=1);

namespace ATF\VendorList\Block\Adminhtml\Vendor\View;
use Magento\Framework\App\ResourceConnection;

class Vendor extends \Magento\Framework\View\Element\Template
{

    /**
     * Constructor
     *
     * @param \Magento\Framework\View\Element\Template\Context  $context
     * @param \Magento\Framework\Registry $registry  $registry
     * @param array $data
     */

    protected $_registry;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Framework\Registry $registry,
        ResourceConnection $resourceConnection,
        array $data = []
    ) {
        $this->resourceConnection = $resourceConnection;
        $this->_registry = $registry;
        parent::__construct($context, $data);
    }

    /**
     * @return array
     */
    public function execute()
    {
        try {
            $this->getRequest()->getParams();
            $vendorId =  $this->getRequest()->getParam('vendor_id');
            $connection = $this->resourceConnection->getConnection();
            $table      = $connection->getTableName('atf_vendor2product');
           $query = "Select `catalog_product_entity_varchar`.value FROM " . $table." inner join catalog_product_entity_varchar on catalog_product_entity_varchar.entity_id=atf_vendor2product.product_id where atf_vendor2product.parent_id=$vendorId and catalog_product_entity_varchar.attribute_id = (
                    SELECT attribute_id FROM eav_attribute
                    WHERE entity_type_id=4 AND attribute_code='name'
                )";
            $products = $connection->fetchAll($query);
        } catch (\Exception $e) {
            $products = [];
        }
        return $products;
    }
}

