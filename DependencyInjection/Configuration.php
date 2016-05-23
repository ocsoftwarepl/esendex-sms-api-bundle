<?php

namespace OCSoftwarePL\EsendexSmsApiBundle\DependencyInjection;

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
        $rootNode = $treeBuilder->root('ocs_esendex_smsapi');

        $rootNode->children()
            ->scalarNode('premium_sender_name')->defaultNull()
            ->scalarNode('username')->isRequired()->end()
            ->scalarNode('password')->isRequired()->end()
            ->scalarNode('account_reference')->isRequired()->end()
            ->end();

        return $treeBuilder;
    }
}
