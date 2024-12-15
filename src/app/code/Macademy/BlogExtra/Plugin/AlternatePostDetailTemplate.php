<?php declare(strict_types=1);

namespace Macademy\BlogExtra\Plugin;

use Macademy\Blog\Controller\Post\Detail;
use Magento\Framework\App\RequestInterface;

class AlternatePostDetailTemplate
{
    public function __construct(
        private RequestInterface $request,
    )
    {
    }

    public function afterExecute(
        Detail $subject,
               $result
    )
    {
        if ($this->request->getParam('alternate')) {
            $result->getLayout()
                ->getBlock('blog.post.detail')
                ->setTemplate('Macademy_BlogExtra::post/detail.phtml');
        }
        return $result;
    }
}
