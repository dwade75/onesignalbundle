<?php
    /**
     * Date: 20/06/2016
     * Time: 00:25
     */

    namespace Dwade75\OnesignalBundle\Controller\Notifications;


    use Dwade75\OnesignalBundle\Dwade75OnesignalBundle;
    use Symfony\Bundle\FrameworkBundle\Controller\Controller;
    use Dwade75\OnesignalBundle\Helper\Constant;
    use Dwade75\OnesignalBundle\Helper\Curl;

    class NotificationsController extends Controller
    {
        public function __construct()
        {
            $this->container = Dwade75OnesignalBundle::getContainer();
            $this->authConfig = $this->container->get('dwade75_onesignal.config_parameter_service')->authentification();
        }


        /**
         * @param int $limit
         * @param int $offset
         */
        public function getNotifications($limit = 50, $offset = 0)
        {
            if (null !== $this->authConfig->restApiKey && null !== $this->authConfig->appId) {
                $notifications = Curl::curlGet(Constant::ONESIGNAL_URL . '/notifications?app_id=' . $this->authConfig->appId . '&limit=' . $limit . '&offset=' . $offset, $this->authConfig->restApiKey);
                return json_decode($notifications);
            } else {
                throw $this->createNotFoundException('Sorry App id or Rest Api Key missing, check up your config file');
            }
        }


        /**
         * @param $notificationId
         * @param int $limit
         * @param int $offset
         */
        public function getNotificationById($notificationId, $limit = 50, $offset = 0)
        {
            if (null !== $this->authConfig->restApiKey && null !== $this->authConfig->appId) {
                if (isset($notificationId)) {
                    $notifications = Curl::curlGet(Constant::ONESIGNAL_URL . '/notifications/' . $notificationId . '/?app_id=' . $this->authConfig->appId . '&limit=' . $limit . '&offset=' . $offset, $this->authConfig->restApiKey);
                    return json_decode($notifications);
                } else {
                    throw $this->createNotFoundException('Sorry notification id missing');
                }
            } else {
                throw $this->createNotFoundException('Sorry App id or Rest Api Key missing, check up your config file');
            }
        }

        /**
         * @param array $fields
         */
        public function createNotification($fields = [])
        {
            if (null !== $this->authConfig->restApiKey && null !== $this->authConfig->appId) {
                if (is_array($fields)) {
                    $fieldsAppId = ['app_id' => $this->authConfig->appId];
                    $fieldsMerge = array_merge($fields, $fieldsAppId);
                    $data = json_encode($fieldsMerge);
                    $notifications = Curl::curlPost(Constant::ONESIGNAL_URL . '/notifications', $this->authConfig->restApiKey, $data);
                    return json_decode($notifications);
                } else {
                    throw $this->createNotFoundException('createNotification parameters must be an array');
                }
            } else {
                throw $this->createNotFoundException('Sorry Rest Api Key missing, check up your config file');
            }
        }

        /**
         * @param $notificationId
         * @param array $fields
         * @param bool $opened
         */
        public function editNotificationById($notificationId, $fields = [], $opened = true)
        {
            if (null !== $this->authConfig->restApiKey && null !== $this->authConfig->appId) {
                if (is_array($fields)) {
                    $fieldsAppId = ['app_id' => $this->authConfig->appId, 'opened' => $opened];
                    $fieldsMerge = array_merge($fields, $fieldsAppId);
                    $data = json_encode($fieldsMerge);
                    $notifications = Curl::curlPut(Constant::ONESIGNAL_URL . '/notifications/' . $notificationId, $this->authConfig->restApiKey, $data);
                    return json_decode($notifications);
                } else {
                    throw $this->createNotFoundException('createNotification parameters must be an array');
                }
            } else {
                throw $this->createNotFoundException('Sorry Rest Api Key or App Id missing, check up your config file');
            }
        }


        /**
         * @param $notificationId
         */
        public function removeNotificationById($notificationId)
        {
            if (null !== $this->authConfig->restApiKey && null !== $this->authConfig->appId) {
                if (isset($notificationId)) {
                    $notifications = Curl::curlDelete(Constant::ONESIGNAL_URL. '/notifications/' . $notificationId . '/?app_id=' . $this->authConfig->appId, $this->authConfig->restApiKey);
                    return json_decode($notifications);
                } else {
                    throw $this->createNotFoundException('Sorry notification Id missing');
                }
            } else {
                throw $this->createNotFoundException('Sorry App id or Rest Api Key missing, check up your config file');
            }
        }
    }