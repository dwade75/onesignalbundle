<?php

namespace Dwade75\OnesignalBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files.
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/configuration.html}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('dwade75_onesignal');

        // Here you should define the parameters that are allowed to
        // configure your bundle. See the documentation linked above for
        // more information on that topic.

        $rootNode->children()->scalarNode('app_id')->defaultNull()->end();
        $rootNode->children()->scalarNode('auth_key')->defaultNull()->end();
        $rootNode->children()->scalarNode('rest_api_key')->defaultNull()->end();

        return $treeBuilder;
    }
}
