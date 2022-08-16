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

use FriendsOfHyperf\ModelMorphAddon\Aspect\MorphToAspect;
use FriendsOfHyperf\ModelMorphAddon\Aspect\QueriesRelationshipsAspect;

class ConfigProvider
{
    public function __invoke(): array
    {
        return [
            'aspects' => [
                MorphToAspect::class,
                QueriesRelationshipsAspect::class,
            ],
        ];
    }
}
