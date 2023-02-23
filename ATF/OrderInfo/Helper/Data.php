<?php
declare(strict_types=1);

namespace ATF\OrderInfo\Helper;

use Magento\Framework\App\Helper\AbstractHelper;

class Data extends AbstractHelper
{
    protected $orderRepository;

    /**
     * @param \Magento\Framework\App\Helper\Context $context
     * @param \Magento\Sales\Api\OrderRepositoryInterface $orderRepository
     */
    public function __construct(
        \Magento\Framework\App\Helper\Context $context,
        \Magento\Sales\Api\OrderRepositoryInterface $orderRepository
    ) {
        $this->orderRepository = $orderRepository;
        parent::__construct($context);
    }

    /**
     * @return Array
     */
    public function getOrderDetail($orderId){
        $order = $this->orderRepository->get($orderId);
        $status = $order->getStatus();
        $total = $order->getSubtotal();
        $totalInvoice = $order->getGrandTotal();
        $orderItems = $order->getAllItems();

        $items = array();
        foreach ($orderItems as $item){
            $items[] = array(
                'sku' =>  $item->getSku(),
                'item_id' => $item->getId(),
                'price' => $item->getPrice()
            );
        }

        $orderDetail = array(
            'status' => $status,
            'total' => $total,
            'items' => $items,
            'totalInvoice' => $totalInvoice
        );

        return $orderDetail;
    }
}
