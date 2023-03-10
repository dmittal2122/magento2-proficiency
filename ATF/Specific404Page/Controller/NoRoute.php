<?php
namespace ATF\Specific404Page\Controller;

use Magento\Framework\App\Action\Context as Context;
use Magento\Framework\View\Result\PageFactory as PageFactory;

class NoRoute extends \Magento\Framework\App\Action\Action
{
    protected $resultPageFactory;

    /**
     * NoRoute constructor.
     * @param Context $context
     * @param PageFactory $resultPageFactory
     */
    public function __construct(Context $context, PageFactory $resultPageFactory)
    {
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        $resultLayout = $this->resultPageFactory->create();
        $resultLayout->setStatusHeader(404, '1.1', 'Not Found');
        $resultLayout->setHeader('Status', '404 File not found');
        return $resultLayout;
    }
}
