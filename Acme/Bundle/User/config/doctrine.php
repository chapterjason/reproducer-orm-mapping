<?php
/*
 * This file is part of the SoureCode package.
 *
 * (c) Jason Schilling <jason@sourecode.dev>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Doctrine\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use function Symfony\Component\DependencyInjection\Loader\Configurator\param;

return function (ContainerConfigurator $container) {
    $services = $container->services();

    $services->set('acme.user.object_manager', ObjectManager::class)
        ->args(
            [
                param('acme.user.config.model_manager_name'),
            ]
        );
};
