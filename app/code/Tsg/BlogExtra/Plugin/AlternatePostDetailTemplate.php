<?php declare(strict_types=1);

namespace Tsg\BlogExtra\Plugin;

use Magento\Framework\App\RequestInterface;
use Tsg\Blog\Controller\Post\Detail;

class AlternatePostDetailTemplate
{
    private $request;

    public function __construct(
        RequestInterface $request
    )
    {
        $this->request = $request;
    }

    public function afterExecute(
        Detail $subject,
        $result
    ){
        if ($this->request->getParam('alternate')) {
            $result->getLayout()
                ->getBlock('blog.post.detail')
                ->setTemplate('Tsg_BlogExtra::post/detail.phtml');
        }

        return $result;
    }
}
