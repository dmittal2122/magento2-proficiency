<?php
declare(strict_types=1);

namespace ATF\OrderController\Controller\Index;

use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\Controller\Result\JsonFactory;
use PHPUnit\Util\Json;
use Psr\Log\LoggerInterface;
use Magento\Framework\App\RequestInterface;

class Index implements HttpGetActionInterface
{

    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * @var \Magento\Framework\Controller\Result\JsonFactory
     */
    private $jsonResultFactory;

    /**
     * Constructor
     *
     * @param PageFactory $resultPageFactory
     * @param LoggerInterface $logger
     * @param JsonFactory $jsonResultFactory
     * @param \Magento\Sales\Api\OrderRepositoryInterface $orderRepository
     * @param RequestInterface $request
     * @param \ATF\OrderController\Helper\Data $helper
     */
    public function __construct(
        PageFactory $resultPageFactory,
        LoggerInterface $logger,
        JsonFactory $jsonResultFactory,
        \Magento\Sales\Api\OrderRepositoryInterface $orderRepository,
        RequestInterface $request,
        \ATF\OrderController\Helper\Data $helper
    ){
        $this->resultPageFactory = $resultPageFactory;
        $this->logger = $logger;
        $this->jsonResultFactory = $jsonResultFactory;
        $this->orderRepository = $orderRepository;
        $this->request = $request;
        $this->helper = $helper;
    }

    /**
     * Execute view action
     *
     * @return Json
     */
    public function execute()
    {
        $orderId = $this->request->getParam('id');
        try {
            $orderDetail = $this->helper->getOrderDetail($orderId);
            $orderDetail = array('orderDetail' => $orderDetail);
            $data = ['orderDetail' => $orderDetail];
        } catch (LocalizedException $e) {
            $data = ['success' => false,'message' => $e->getMessage()];
        } catch (\Exception $e) {
            $data = ['success' => false,'message' => $e->getMessage()];
        }
        $result = $this->jsonResultFactory->create();
        $result->setData($data);
        return $result;
    }
}
