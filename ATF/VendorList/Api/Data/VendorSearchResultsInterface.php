<?php
declare(strict_types=1);

namespace ATF\VendorList\Api\Data;

interface VendorSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{

    /**
     * Get Vendor list.
     * @return \ATF\VendorList\Api\Data\VendorInterface[]
     */
    public function getItems();

    /**
     * Set name list.
     * @param \ATF\VendorList\Api\Data\VendorInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}

