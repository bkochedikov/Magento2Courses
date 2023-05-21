<?php declare(strict_types=1);

namespace Tsg\Blog\Model;

use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Tsg\Blog\Api\Data\PostInterface;
use Tsg\Blog\Api\PostRepositoryInterface;
use Tsg\Blog\Model\ResourceModel\Post as PostResourceModel;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;

class PostRepository implements PostRepositoryInterface
{
    private $postFactory;
    private $postResourceModel;

    public function __construct(
        PostFactory $postFactory,
        PostResourceModel $postResourceModel
    ){
        $this->postFactory = $postFactory;
        $this->postResourceModel = $postResourceModel;
    }

    public function getById(int $id): PostInterface
    {
        $post = $this->postFactory->create();
        $this->postResourceModel->load($post, $id);

        if (!$post->getId()){
            throw new NoSuchEntityException(__('The blog post with "%1" ID doesn\'t exist.', $id));
        }

        return $post;
    }

    public function save(PostInterface $post): PostInterface
    {
        try {
            $this->postResourceModel->save($post);
        } catch (\Exception $exception){
            throw new CouldNotSaveException(__($exception->getMessage()));
        }

        return $post;
    }

    public function deleteById(int $id): bool
    {
        $post = $this->getById($id);

        try {
            $this->postResourceModel->delete($post);
        } catch (\Exception $exception){
            throw new CouldNotDeleteException(__($exception->getMessage()));
        }

        return true;
    }
}
