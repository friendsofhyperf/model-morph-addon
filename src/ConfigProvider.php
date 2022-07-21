<?php

declare(strict_types=1);
/**
 * This file is part of friendsofhyperf/model-morph-addon.
 *
 * @link     https://github.com/friendsofhyperf/model-morph-addon
 * @document https://github.com/friendsofhyperf/model-morph-addon/blob/main/README.md
 * @contact  huangdijia@gmail.com
 */
namespace FriendsOfHyperf\ModelMorphAddon;

class ConfigProvider
{
    public function __invoke(): array
    {
        defined('BASE_PATH') or define('BASE_PATH', '');

        return [
            'dependencies' => [],
            'aspects' => [],
            'annotations' => [
                'scan' => [
                    'paths' => [
                        __DIR__,
                    ],
                ],
            ],
            'commands' => [],
            'listeners' => [],
            'publish' => [],
        ];
    }
}
