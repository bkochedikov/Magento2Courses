<?php declare(strict_types=1);

namespace Tsg\Blog\Setup\Patch\Data;

use Tsg\Blog\Api\PostRepositoryInterface;
use Tsg\Blog\Model\PostFactory;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\Patch\PatchInterface;

class PopulateBlogPosts1 implements DataPatchInterface
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

        $posts = [
            [
                'title' => 'Today is sunny',
                'content' => 'The weather has been great all week.',
            ],
            [
                'title' => 'My movie review',
                'content' => 'I give this movie 5 out of 5 stars!',
            ],
        ];
        foreach ($posts as $postData) {
            $post = $this->postFactory->create();
            $post->setData($postData);
            $this->postRepository->save($post);
        }

        $this->moduleDataSetup->endSetup();
    }
}
