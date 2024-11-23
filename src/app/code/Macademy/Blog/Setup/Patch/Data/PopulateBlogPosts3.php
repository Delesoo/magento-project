<?php declare(strict_types=1);

namespace Macademy\Blog\Setup\Patch\Data;

use Macademy\Blog\Api\PostRepositoryInterface;
use Macademy\Blog\Model\PostFactory;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;

class PopulateBlogPosts3 implements DataPatchInterface
{

    public function __construct(
        private ModuleDataSetupInterface $moduleDataSetup,
        private PostFactory              $postFactory,
        private PostRepositoryInterface  $postRepository,

    )
    {
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
                'title' => 'visi bijixar?',
                'content' => 'mamikosi',
            ],
            [
                'title' => 'imena chemikai',
                'content' => 'hooo',
            ],
            [
                'title' => 'yeeeee booody',
                'content' => 'lightweeeeight',
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
