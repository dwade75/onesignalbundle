<?php

    namespace Dwade75\OnesignalBundle;

    use Symfony\Component\DependencyInjection\ContainerInterface;
    use Symfony\Component\HttpKernel\Bundle\Bundle;


    /**
     * Class Dwade75OnesignalBundle
     * @package Dwade75\OnesignalBundle
     * TODO Added the containerInterface for the bundle
     */
    class Dwade75OnesignalBundle extends Bundle
    {
        /**
         * @var null
         */
        private static $containerInstance = null;

        /**
         * @param ContainerInterface $container
         */
        public function setContainer(ContainerInterface $container = null)
        {
            parent::setContainer($container);
            self::$containerInstance = $container;
        }

        /**
         * @return null
         */
        public static function getContainer()
        {
            return self::$containerInstance;
        }
    }
