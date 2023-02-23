<?php
declare(strict_types=1);

namespace ATF\FreeGeoIp\Rewrite\Magento\Customer\Model\ResourceModel;

class Visitor extends \Magento\Customer\Model\ResourceModel\Visitor
{
    /**
     * @param \Magento\Framework\Model\ResourceModel\Db\Context $context
     * @param \Magento\Framework\Stdlib\DateTime\DateTime $date
     * @param \Magento\Framework\Stdlib\DateTime $dateTime
     * @param \ATF\FreeGeoIp\Helper\Country $countryHelper
     */
    public function __construct(
        \Magento\Framework\Model\ResourceModel\Db\Context $context,
        \Magento\Framework\Stdlib\DateTime\DateTime $date,
        \Magento\Framework\Stdlib\DateTime $dateTime,
        \ATF\FreeGeoIp\Helper\Country $countryHelper
    ) {
        $this->countryHelper = $countryHelper;
        parent::__construct($context, $date,$dateTime);
    }

    /**
     * Prepare data for save
     *
     * @param \Magento\Framework\Model\AbstractModel $visitor
     * @return array
     */
    protected function _prepareDataForSave(\Magento\Framework\Model\AbstractModel $visitor)
    {
        return [
            'customer_id' => $visitor->getCustomerId(),
            'last_visit_at' => $visitor->getLastVisitAt(),
            'country' => $this->countryHelper->getCountry()
        ];
    }
}

