<?php
declare(strict_types=1);

namespace ATF\Warranty\Model\Product\Attribute\Source;

class Warranty extends \Magento\Eav\Model\Entity\Attribute\Source\AbstractSource
{

    /**
     * getAllOptions
     *
     * @return array
     */
    public function getAllOptions()
    {
        $this->_options = [
        ['value' => '1', 'label' => __('1')],
        ['value' => '2', 'label' => __('2')],
        ['value' => '3', 'label' => __('3')],
        ['value' => '4', 'label' => __('4')],
        ['value' => '5', 'label' => __('5')],
        ['value' => '6', 'label' => __('6')]
        ];
        return $this->_options;
    }

    /**
     * @return array
     */
    public function getFlatColumns()
    {
        $attributeCode = $this->getAttribute()->getAttributeCode();
        return [
        $attributeCode => [
        'unsigned' => false,
        'default' => null,
        'extra' => null,
        'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
        'length' => 255,
        'nullable' => true,
        'comment' => $attributeCode . ' column',
        ],
        ];
    }

    /**
     * @return array
     */
    public function getFlatIndexes()
    {
        $indexes = [];
        
        $index = 'IDX_' . strtoupper($this->getAttribute()->getAttributeCode());
        $indexes[$index] = ['type' => 'index', 'fields' => [$this->getAttribute()->getAttributeCode()]];
        
        return $indexes;
    }

    /**
     * @param int $store
     * @return \Magento\Framework\DB\Select|null
     */
    public function getFlatUpdateSelect($store)
    {
        return $this->eavAttrEntity->create()->getFlatUpdateSelect($this->getAttribute(), $store);
    }
}

