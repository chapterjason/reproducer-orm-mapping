<?php

namespace Acme\Bundle\User;

use Doctrine\Bundle\DoctrineBundle\DependencyInjection\Compiler\DoctrineOrmMappingsPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class AcmeUserBundle extends Bundle
{
    public function getPath(): string
    {
        return \dirname(__DIR__);
    }

    public function build(ContainerBuilder $container): void
    {
        parent::build($container);

        $this->addRegisterMappingsPass($container);
    }

    private function addRegisterMappingsPass(ContainerBuilder $container): void
    {
        $configDirectory = \dirname(__DIR__).'/config/doctrine';
        $namespace = 'Acme\Component\User\Model';

        $namespaces = [
            $configDirectory => $namespace,
        ];

        $container->addCompilerPass(
            DoctrineOrmMappingsPass::createXmlMappingDriver(
                $namespaces,
                ['acme.user.model_manager_name'],
                'acme.user.backend_type_orm',
                ['AcmeUserBundle' => $namespace]
            )
        );
    }
}
