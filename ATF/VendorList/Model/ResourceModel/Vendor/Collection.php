<?php
declare(strict_types=1);

namespace ATF\VendorList\Model\ResourceModel\Vendor;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{

    /**
     * @inheritDoc
     */
    protected $_idFieldName = 'vendor_id';

    /**
     * @inheritDoc
     */
    protected function _construct()
    {
        $this->_init(
            \ATF\VendorList\Model\Vendor::class,
            \ATF\VendorList\Model\ResourceModel\Vendor::class
        );
    }
}

