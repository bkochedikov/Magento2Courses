<?php declare(strict_types=1);

namespace Tsg\Blog\Api;

use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Tsg\Blog\Api\Data\PostInterface;

/**
 * Blog post CRUD interface
 * @api
 * @since 1.0.0
 */
interface PostRepositoryInterface
{
    /**
     * @param int $id
     * @return PostInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getById(int $id): PostInterface;

    /**
     * @param PostInterface $post
     * @return PostInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(PostInterface $post): PostInterface;

    /**
     * @param int $id
     * @return bool
     * @throws \Magento\Framework\Exception\LocalizedException
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function deleteById(int $id): bool;
}
