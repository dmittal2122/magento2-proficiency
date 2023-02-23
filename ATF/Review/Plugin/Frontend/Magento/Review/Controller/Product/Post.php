<?php
/**
 * Copyright © Copyright By ATF All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace ATF\Review\Plugin\Frontend\Magento\Review\Controller\Product;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\App\ResponseFactory;
use Magento\Framework\App\Response\RedirectInterface;
use Magento\Framework\Message\ManagerInterface;

class Post
{
    /**
     * @var RequestInterface
     */
    protected $request;

    /**
     * @param RequestInterface $request
     * @param ResponseFactory $responseFactory
     * @param RedirectInterface $redirect
     * @param ManagerInterface $messageManager
     */
    public function __construct(
        RequestInterface $request,
        ResponseFactory $responseFactory,
        RedirectInterface $redirect,
        ManagerInterface $messageManager
    )
    {
        $this->request = $request;
        $this->responseFactory = $responseFactory;
        $this->redirect = $redirect;
        $this->messageManager = $messageManager;
    }

    /**
     * check dash exist in nickname and throw error
     *
     * @param ProductRepositoryInterface $subject
     */
    public function beforeExecute(
        \Magento\Review\Controller\Product\Post $subject
    ) {
        $postData = $this->request->getPostValue();
        if(!empty($postData['nickname'])){
            if(str_contains($postData['nickname'], "-")) {
                $this->messageManager->addErrorMessage(__('Please remove dash from nickname.'));
                $this->responseFactory->create()->setRedirect($this->redirect->getRefererUrl())->sendResponse();
            }
        }
    }
}

