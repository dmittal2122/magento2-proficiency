<?php
declare(strict_types=1);

namespace ATF\VendorRepository\Model;

use ATF\VendorList\Api\Data\VendorInterface;
use ATF\VendorList\Api\Data\VendorInterfaceFactory;
use ATF\VendorList\Api\Data\VendorSearchResultsInterfaceFactory;
use ATF\VendorRepository\Api\VendorRepositoryInterface;
use ATF\VendorList\Model\ResourceModel\Vendor as ResourceVendor;
use ATF\VendorList\Model\ResourceModel\Vendor\CollectionFactory as VendorCollectionFactory;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\App\ResourceConnection;


class VendorRepository implements VendorRepositoryInterface
{

    /**
     * @var ResourceVendor
     */
    protected $resource;

    /**
     * @var VendorInterfaceFactory
     */
    protected $vendorFactory;

    /**
     * @var VendorCollectionFactory
     */
    protected $vendorCollectionFactory;

    /**
     * @var Vendor
     */
    protected $searchResultsFactory;

    /**
     * @var CollectionProcessorInterface
     */
    protected $collectionProcessor;


    /**
     * @param ResourceVendor $resource
     * @param VendorInterfaceFactory $vendorFactory
     * @param VendorCollectionFactory $vendorCollectionFactory
     * @param VendorSearchResultsInterfaceFactory $searchResultsFactory
     * @param CollectionProcessorInterface $collectionProcessor
     */
    public function __construct(
        ResourceVendor $resource,
        VendorInterfaceFactory $vendorFactory,
        VendorCollectionFactory $vendorCollectionFactory,
        VendorSearchResultsInterfaceFactory $searchResultsFactory,
        CollectionProcessorInterface $collectionProcessor,
        ResourceConnection $resourceConnection
    ) {
        $this->resource = $resource;
        $this->vendorFactory = $vendorFactory;
        $this->vendorCollectionFactory = $vendorCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->collectionProcessor = $collectionProcessor;
        $this->resourceConnection = $resourceConnection;
    }

    /**
     * @inheritDoc
     */
    public function save(VendorInterface $vendor)
    {
        try {
            $this->resource->save($vendor);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the vendor: %1',
                $exception->getMessage()
            ));
        }
        return $vendor;
    }

    /**
     * @inheritDoc
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $criteria
    ) {
        $collection = $this->vendorCollectionFactory->create();

        $this->collectionProcessor->process($criteria, $collection);

        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);

        $items = [];
        foreach ($collection as $model) {
            $items[] = $model;
        }

        $searchResults->setItems($items);
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults;
    }

    /**
     * @inheritDoc
     */
    public function load($vendorId)
    {
        $vendor = $this->vendorFactory->create();
        $this->resource->load($vendor, $vendorId);
        if (!$vendor->getId()) {
            throw new NoSuchEntityException(__('Vendor with id "%1" does not exist.', $vendorId));
        }
        return $vendor;
    }

    public function getAssociatedProductIds($vendorId)
    {
        $connection = $this->resourceConnection->getConnection();
        $tableName = $connection->getTableName('atf_vendor2product');
        $query = "Select `product_id` FROM ".$tableName." where `parent_id`='".$vendorId."' ";
        $productIds = $connection->fetchAll($query);
        $p = [];
        foreach ($productIds as $productId){
            $p[] = $productId;
        }
        return $p;
    }
}

