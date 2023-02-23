<?php
declare(strict_types=1);

namespace ATF\VendorList\Api\Data;

interface VendorInterface
{

    const NAME = 'name';
    const VENDOR_ID = 'vendor_id';

    /**
     * Get vendor_id
     * @return string|null
     */
    public function getVendorId();

    /**
     * Set vendor_id
     * @param string $vendorId
     * @return \ATF\VendorList\Vendor\Api\Data\VendorInterface
     */
    public function setVendorId($vendorId);

    /**
     * Get name
     * @return string|null
     */
    public function getName();

    /**
     * Set name
     * @param string $name
     * @return \ATF\VendorList\Vendor\Api\Data\VendorInterface
     */
    public function setName($name);
}

