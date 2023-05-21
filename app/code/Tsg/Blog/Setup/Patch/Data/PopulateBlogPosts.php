<?php declare(strict_types=1);

namespace Tsg\Blog\Setup\Patch\Data;

use Tsg\Blog\Api\PostRepositoryInterface;
use Tsg\Blog\Model\PostFactory;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\Patch\PatchInterface;

class PopulateBlogPosts implements DataPatchInterface
{
    private $moduleDataSetup;
    private $postFactory;
    private $postRepository;

    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        PostFactory $postFactory,
        PostRepositoryInterface $postRepository
    ){
        $this->moduleDataSetup = $moduleDataSetup;
        $this->postFactory = $postFactory;
        $this->postRepository = $postRepository;
    }

    public static function getDependencies(): array
    {
        return [];
    }

    public function getAliases(): array
    {
        return [];
    }

    public function apply()
    {
        $this->moduleDataSetup->startSetup();

        $post = $this->postFactory->create();
        $post->setData([
            'title' => 'An awesome post',
            'content' => 'This is totally awesome!'
        ]);
        $this->postRepository->save($post);

        $this->moduleDataSetup->endSetup();
    }
}
