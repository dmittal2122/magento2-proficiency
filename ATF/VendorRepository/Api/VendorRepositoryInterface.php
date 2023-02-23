<?php
declare(strict_types=1);

namespace ATF\VendorRepository\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

interface VendorRepositoryInterface
{

    /**
     * Save Vendor
     * @param \ATF\VendorList\Api\Data\VendorInterface $vendor
     * @return \ATF\VendorList\Api\Data\VendorInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(
        \ATF\VendorList\Api\Data\VendorInterface $vendor
    );


    /**
     * Retrieve Vendor matching the specified criteria.
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \ATF\VendorList\Api\Data\VendorSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

    /**
     * Retrieve Vendor
     * @param string $vendorId
     * @return \ATF\VendorList\Api\Data\VendorInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function load($vendorId);

    /**
     * Retrieve Vendor
     * @param string $vendorId
     * @return \ATF\VendorList\Api\Data\VendorInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getAssociatedProductIds($vendorId);
}

