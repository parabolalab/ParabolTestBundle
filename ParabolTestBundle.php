<?php

namespace Parabol\TestBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Doctrine\Bundle\DoctrineBundle\DependencyInjection\Compiler\DoctrineOrmMappingsPass;
use Doctrine\Bundle\MongoDBBundle\DependencyInjection\Compiler\DoctrineMongoDBMappingsPass;
use Parabol\TestBundle\Model;

class ParabolTestBundle extends Bundle
{
	public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $this->addRegisterMappingsPass($container);
    }

    private function addRegisterMappingsPass(ContainerBuilder $container)
    {
    	$mappings = array(
            realpath(__DIR__ . '/Resources/config/doctrine-mapping') => Model::class,
        );

        if (class_exists(DoctrineOrmMappingsPass::class)) {
        	$container->addCompilerPass(DoctrineOrmMappingsPass::createYamlMappingDriver($mappings, array('parabol_test.model_manager_name'), 'parabol_test.backend_type_orm', array('ParabolTestBundle' => Model::class)));
        }

        if (class_exists(DoctrineMongoDBMappingsPass::class)) {
            $container->addCompilerPass(DoctrineMongoDBMappingsPass::createYamlMappingDriver($mappings, array('parabol_test.model_manager_name'), 'parabol_test.backend_type_mongodb', array('ParabolTestBundle' => Model::class)));
        }
    }
}
