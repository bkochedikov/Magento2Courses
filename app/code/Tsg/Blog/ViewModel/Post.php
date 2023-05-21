<?php declare(strict_types=1);

namespace Tsg\Blog\ViewModel;

use Magento\Framework\App\RequestInterface;
use Magento\Framework\View\Element\Block\ArgumentInterface;
use Tsg\Blog\Api\Data\PostInterface;
use Tsg\Blog\Api\PostRepositoryInterface;
use Tsg\Blog\Model\ResourceModel\Post\Collection;

class Post implements ArgumentInterface
{
    private $collection;
    private $postRepository;
    private $request;

    public function __construct(
        Collection $collection,
        PostRepositoryInterface $postRepository,
        RequestInterface $request,
    ){
        $this->collection = $collection;
        $this->postRepository = $postRepository;
        $this->request = $request;
    }

    public function getList(): array
    {
        return $this->collection->getItems();
    }

    public function getCount(): int
    {
        return $this->collection->count();
    }

    public function getDetail(): PostInterface
    {
        $id = (int) $this->request->getParam('id');
        return $this->postRepository->getById($id);
    }
}
