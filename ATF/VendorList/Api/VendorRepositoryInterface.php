<?php
declare(strict_types=1);

namespace ATF\VendorList\Api;

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
     * Retrieve Vendor
     * @param string $vendorId
     * @return \ATF\VendorList\Api\Data\VendorInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function get($vendorId);

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
     * Delete Vendor
     * @param \ATF\VendorList\Api\Data\VendorInterface $vendor
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(
        \ATF\VendorList\Api\Data\VendorInterface $vendor
    );

    /**
     * Delete Vendor by ID
     * @param string $vendorId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($vendorId);
}

