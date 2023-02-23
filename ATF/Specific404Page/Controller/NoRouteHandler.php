<?php
namespace ATF\Specific404Page\Controller;
use Magento\Framework\App\RequestInterface as Request;

class NoRouteHandler implements \Magento\Framework\App\Router\NoRouteHandlerInterface
{
    /**
     * @param Request $request
     * @return bool
     */
    public function process(Request $request)
    {
        $pathDetail = $request->getPathInfo();
        $urlSegment = explode('/', trim($pathDetail, '/'));

        $moduleName = isset($urlSegment[0]) ? $urlSegment[0] : '';
        $actionPath = isset($urlSegment[1]) ? $urlSegment[1] : '';
        $actionName = isset($urlSegment[2]) ? $urlSegment[2] : '';

        if($moduleName == 'catalog' && $actionPath == 'product' && $actionName == 'view') {
            $request->setModuleName('notfoundpages')
                ->setControllerName('noroute')
                ->setActionName('product');
        }else if($moduleName == 'catalog' && $actionPath == 'category' && $actionName == 'view') {
            $request->setModuleName('notfoundpages')
            ->setControllerName('noroute')
            ->setActionName('category');
        } else {
                $request->setModuleName('notfoundpages')
                    ->setControllerName('noroute')
                    ->setActionName('other');
        }
            return false;
        }
}
