<?php
declare(strict_types=1);

namespace ATF\VendorList\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Vendor extends AbstractDb
{

    /**
     * @inheritDoc
     */
    protected function _construct()
    {
        $this->_init('atf_vendor', 'vendor_id');
    }
}

