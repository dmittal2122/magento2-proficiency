<?php
declare(strict_types=1);

namespace ATF\Vendor\Block;
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
            $productId =  $this->_registry->registry('current_product')->getId();
            $connection = $this->resourceConnection->getConnection();
            $table      = $connection->getTableName('atf_vendor2product');
            $query = "Select `atf_vendor`.name FROM " . $table." left join atf_vendor on atf_vendor.vendor_id=atf_vendor2product.parent_id where atf_vendor2product.parent_id=$productId";
            $vendors = $connection->fetchAll($query);
        } catch (\Exception $e) {
            $vendors = [];
        }
        return $vendors;
    }
}

