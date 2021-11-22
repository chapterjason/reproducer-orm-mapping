<?php
/*
 * This file is part of the SoureCode package.
 *
 * (c) Jason Schilling <jason@sourecode.dev>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Acme\Bundle\User\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Alias;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\PhpFileLoader;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

/**
 * @author Jason Schilling <jason@sourecode.dev>
 */
class AcmeUserExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container): void
    {
        $loader = new PhpFileLoader($container, new FileLocator(__DIR__.'/../../config'));

        $container->setParameter('acme.user.config.model_manager_name', null);
        $container->setParameter('acme.user.backend_type_orm', true);

        $loader->load('doctrine.php');

        $container->setAlias('acme.user.doctrine_registry', new Alias('doctrine', false));

        $definition = $container->getDefinition('acme.user.object_manager');
        $definition->setFactory(
            [
                new Reference('acme.user.doctrine_registry'),
                'getManager',
            ]
        );
    }
}
