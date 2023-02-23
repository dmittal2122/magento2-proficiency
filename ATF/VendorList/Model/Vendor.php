<?php
declare(strict_types=1);

namespace ATF\VendorList\Model;

use ATF\VendorList\Api\Data\VendorInterface;
use Magento\Framework\Model\AbstractModel;

class Vendor extends AbstractModel implements VendorInterface
{

    /**
     * @inheritDoc
     */
    public function _construct()
    {
        $this->_init(\ATF\VendorList\Model\ResourceModel\Vendor::class);
    }

    /**
     * @inheritDoc
     */
    public function getVendorId()
    {
        return $this->getData(self::VENDOR_ID);
    }

    /**
     * @inheritDoc
     */
    public function setVendorId($vendorId)
    {
        return $this->setData(self::VENDOR_ID, $vendorId);
    }

    /**
     * @inheritDoc
     */
    public function getName()
    {
        return $this->getData(self::NAME);
    }

    /**
     * @inheritDoc
     */
    public function setName($name)
    {
        return $this->setData(self::NAME, $name);
    }
}

