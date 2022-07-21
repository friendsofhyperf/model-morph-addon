<?php

declare(strict_types=1);
/**
 * This file is part of friendsofhyperf/model-morph-addon.
 *
 * @link     https://github.com/friendsofhyperf/model-morph-addon
 * @document https://github.com/friendsofhyperf/model-morph-addon/blob/main/README.md
 * @contact  huangdijia@gmail.com
 */
namespace FriendsOfHyperf\ModelMorphAddon\Aspect;

use Hyperf\Database\Model\Concerns\QueriesRelationships;
use Hyperf\Database\Model\Model;
use Hyperf\Database\Model\Relations\Relation;
use Hyperf\Di\Annotation\Aspect;
use Hyperf\Di\Aop\AbstractAspect;
use Hyperf\Di\Aop\ProceedingJoinPoint;

#[Aspect()]
class QueriesRelationshipsAspect extends AbstractAspect
{
    public array $classes = [
        QueriesRelationships::class . '::hasMorph',
    ];

    public function process(ProceedingJoinPoint $proceedingJoinPoint)
    {
        $arguments = $proceedingJoinPoint->getArguments();

        if ($arguments[1] === ['*']) {
            /** @var Model $model */
            $model = $proceedingJoinPoint->getInstance()->getModel();

            $relation = Relation::noConstraints(fn () => $model->{$arguments[0]}());
            $types = $model->newModelQuery()->distinct()->pluck($relation->getMorphType())->filter()->all();

            foreach ($types as &$type) {
                $type = $model::getActualClassNameForMorph($type) ?? $type;
            }

            $proceedingJoinPoint->arguments[1] = $types;
        }

        return $proceedingJoinPoint->process();
    }
}
