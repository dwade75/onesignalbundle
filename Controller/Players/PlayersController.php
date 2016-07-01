<?php
    /**
     * Date: 20/06/2016
     * Time: 00:26
     */

    namespace Dwade75\OnesignalBundle\Controller\Players;

    use Dwade75\OnesignalBundle\Dwade75OnesignalBundle;
    use Dwade75\OnesignalBundle\Helper\Constant;
    use Dwade75\OnesignalBundle\Helper\Curl;
    use Symfony\Bundle\FrameworkBundle\Controller\Controller;

    class PlayersController extends Controller
    {
        public function __construct()
        {
            $this->container = Dwade75OnesignalBundle::getContainer();
            $this->authConfig = $this->container->get('dwade75_onesignal.config_parameter_service')->authentification();
        }

        public function getPlayersDevices($limit = 50, $offset = 0)
        {
            if (null !== $this->authConfig->restApiKey && null !== $this->authConfig->appId) {
                $players = Curl::CurlGet(Constant::ONESIGNAL_URL. '/players?app_id=' . $this->authConfig->appId . '&limit=' . $limit . '&offset=' . $offset, $this->authConfig->restApiKey);
                return json_decode($players);
            } else {
                throw $this->createNotFoundException('Sorry App id or Rest Api Key missing, check up your config file');
            }
        }

        public function getPlayerDevicesById($playersId)
        {
            if (isset($playersId)) {
                $players = Curl::curlGet(Constant::ONESIGNAL_URL. '/players/' . $playersId);
                return json_decode($players);
            } else {
                throw $this->createNotFoundException('Sorry players Id missing');
            }
        }

        public function createPlayerDevices($fields)
        {
            if (null !== $this->authConfig->appId) {
                if (is_array($fields)) {
                    $fieldsAppId = ['app_id' => $this->authConfig->appId];
                    $fieldsMerge = array_merge($fields, $fieldsAppId);
                    $data = json_encode($fieldsMerge);
                    $players = Curl::curlPost(Constant::ONESIGNAL_URL. '/players', null, $data);
                    return json_decode($players);
                } else {
                    throw $this->createNotFoundException('createPlayerDevices parameters must be an array');
                }
            } else {
                throw $this->createNotFoundException('Sorry App id missing, check up your config file');
            }
        }


        public function editPlayerDevices($playersId, $fields)
        {
            if (null !== $this->authConfig->appId) {
                if (is_array($fields)) {
                    $fieldsAppId = ['app_id' => $this->authConfig->appId];
                    $fieldsMerge = array_merge($fields, $fieldsAppId);
                    $data = json_encode($fieldsMerge);
                    $players = Curl::curlPut(Constant::ONESIGNAL_URL. '/players/' . $playersId, null, $data);
                    return json_decode($players);
                } else {
                    throw $this->createNotFoundException('editPlayerDevices parameters must be an array');
                }
            } else {
                throw $this->createNotFoundException('Sorry App id missing, check up your config file');
            }
        }


        public function createPlayerOnSession($playersId, $fields = null)
        {
            if(isset($playersId)) {
                if ($fields == null) {
                    $players = Curl::curlPost(Constant::ONESIGNAL_URL. '/players/' . $playersId . '/on_session', null, null);
                    return json_decode($players);
                } elseif (is_array($fields)){
                    $fields = json_encode($fields);
                    $players = Curl::curlPost(Constant::ONESIGNAL_URL. '/players/' . $playersId . '/on_session', null, $fields);
                    return json_decode($players);
                } else {
                    throw $this->createNotFoundException('createPlayerOnSession function parameters must be an array');
                }
            } else {
                throw $this->createNotFoundException('Sorry Players id missing');
            }

        }


        public function createPlayerOnPurchase($playersId, $fields)
        {
            if(isset($playersId)) {
                if (is_array($fields)) {
                    //var_dump($fields); die();
                    $fields = json_encode($fields);
                    $players = Curl::curlPost(Constant::ONESIGNAL_URL. '/players/' . $playersId . '/on_purchase', null, $fields);
                    return json_decode($players);
                } else {
                    return 'createPlayerOnSession parameters must be an array';
                }
            } else {
                throw $this->createNotFoundException('Sorry Players id missing');
            }
        }


        public function createPlayerOnFocus($playersId, $fields)
        {
            if(isset($playersId)) {
                if (is_array($fields)) {
                    $fields = json_encode($fields);
                    $players = Curl::curlPost(Constant::ONESIGNAL_URL. '/players/' . $playersId . '/on_focus', null, $fields);
                    return json_decode($players);
                } else {
                    return 'createPlayerOnFocus parameters must be an array';
                }
            } else {
                throw $this->createNotFoundException('Sorry Players id missing');
            }
        }


        public function createPlayerCsvExport()
        {
            if (null !== $this->authConfig->restApiKey && null !== $this->authConfig->appId) {
                $players = Curl::curlPost(Constant::ONESIGNAL_URL. '/players/csv_export?app_id='.$this->authConfig->appId, $this->authConfig->restApiKey);
                return json_decode($players);
            } else {
                return 'Sorry you need the App Id';
            }
        }
    }