<?php
    /**
     * Date: 20/06/2016
     * Time: 00:23
     */

    namespace Dwade75\OnesignalBundle\Controller\Apps;

    use Dwade75\OnesignalBundle\Dwade75OnesignalBundle;
    use Dwade75\OnesignalBundle\Helper\Constant;
    use Dwade75\OnesignalBundle\Helper\Curl;
    use Symfony\Bundle\FrameworkBundle\Controller\Controller;
    use Symfony\Component\DependencyInjection\ContainerAwareInterface;

    class AppsController extends Controller
    {

        public function __construct()
        {
            $this->container = Dwade75OnesignalBundle::getContainer();
            $this->authConfig = $this->container->get('dwade75_onesignal.config_parameter_service')->authentification();
        }

        /**
         *
         */
        public function getApps()
        {
            if (null !== $this->authConfig->authKey) {
                $apps = Curl::curlGet(Constant::ONESIGNAL_URL . '/apps', $this->authConfig->authKey);
                $apps = json_decode($apps);
                return $apps;
            } else {
                throw $this->createNotFoundException('Sorry you need the Auth Key');
            }
        }

        /**
         *
         */
        public function getAppById()
        {
            if (null !== $this->authConfig->appId && null !== $this->authConfig->authKey) {
                $appId = Curl::curlGet(Constant::ONESIGNAL_URL . '/apps/' . $this->authConfig->appId, $this->authConfig->authKey);
                return json_decode($appId);
            } else {
                throw $this->createNotFoundException('Sorry app id or auth key missing');
            }
        }

        /**
         * @param array $fields
         */
        public function createApp($fields = [])
        {
            if (null !== $this->authConfig->authKey) {
                if (is_array($fields)) {
                    $fields = json_encode($fields);
                    $app = Curl::curlPost(Constant::ONESIGNAL_URL . '/apps', $this->authConfig->authKey, $fields);
                    return json_decode($app);
                } else {
                    throw $this->createNotFoundException('createApp parameters must be an array');
                }
            } else {
                throw $this->createNotFoundException('Sorry App Id or Auth Key missing');
            }

        }

        /**
         * @param array $fields
         */
        public function editAppById($fields = [])
        {
            if (null !== $this->authConfig->appId && null !== $this->authConfig->authKey) {
                if (is_array($fields)) {
                    $fields = json_encode($fields);
                    $app = Curl::curlPut(Constant::ONESIGNAL_URL . '/apps/' . $this->authConfig->appId, $this->authConfig->authKey, $fields);
                    return json_decode($app);
                } else {
                    throw $this->createNotFoundException('editAppById parameters must be an array');
                }
            } else {
                throw $this->createNotFoundException('Sorry App Id or Auth Key missing');
            }
        }
    }