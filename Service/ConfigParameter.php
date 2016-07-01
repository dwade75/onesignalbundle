<?php

    namespace Dwade75\OnesignalBundle\Service;

    use Symfony\Component\DependencyInjection\ContainerInterface;

    class ConfigParameter
    {
        /**
         * @var ContainerInterface
         */
        private $containerInterface;

        public function __construct(ContainerInterface $containerInterface)
        {
            $this->containerInterface = $containerInterface;
        }

        public function authentification()
        {

            $auth = [
                'appId' => $this->containerInterface->getParameter('dwade75_onesignal.app_id'),
                'authKey' => $this->containerInterface->getParameter('dwade75_onesignal.auth_key'),
                'restApiKey' => $this->containerInterface->getParameter('dwade75_onesignal.rest_api_key')
            ];
           return (object)$auth;
        }
    }