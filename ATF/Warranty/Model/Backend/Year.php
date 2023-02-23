<?php
declare(strict_types=1);

namespace ATF\Warranty\Model\Backend;

class Year extends \Magento\Eav\Model\Entity\Attribute\Backend\AbstractBackend
{
    /**
     * Before save method
     *
     * @param \Magento\Framework\DataObject $object
     * @return $this
     */
    public function beforeSave($object)
    {
        $attrCode = $this->getAttribute()->getAttributeCode();
        if (!$object->hasData($attrCode) && $this->getDefaultValue() !== '') {
            $object->setData($attrCode, $this->getDefaultValue());
        }
        $object->setData('warranty',$object->getWarranty().' Year');
        return $this;
    }
}

