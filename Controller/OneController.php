<?php
    /**
     * Date: 20/06/2016
     * Time: 00:23
     */

    namespace Dwade75\OnesignalBundle\Controller;

    use Dwade75\OnesignalBundle\Controller\Apps\AppsController;
    use Dwade75\OnesignalBundle\Controller\Notifications\NotificationsController;
    use Dwade75\OnesignalBundle\Controller\Players\PlayersController;
    use Symfony\Bundle\FrameworkBundle\Controller\Controller;
    use Symfony\Component\HttpFoundation\Response;

    class OneController extends Controller
    {


        /**
         * test Controller
         */
        public function oooAction()
        {
            $app = new AppsController();
            var_dump($app->getApps());
            //var_dump($app->getAppById());
            //var_dump($app->createApp(array('name' => 'Api testing','apns_env' => 'sandbox')));
            //var_dump($app->editAppById(array('name' => 'update update Api testing','apns_env' => 'sandbox')));


            $notification = new NotificationsController();
            //var_dump($notification->createNotification(['contents' => ['en' => 'Super message from api'], 'included_segments' => 'All', 'send_after' => '2016-07-01 10:00:00 GMT-0700']));
            //var_dump($notification->editNotificationById('5dba5289-0b74-4379-bcb7-fd87668404fc'));
            //var_dump($notification->removeNotificationById('5dba5289-0b74-4379-bcb7-fd87668404fc'));


            $players = new PlayersController();
            //var_dump($players->getPlayersDevices());
            //var_dump($players->getPlayerDevicesById('32dc08b1-6c71-4a8a-af0a-8ee79c9bf1b5'));
            //var_dump($players->createPlayerDevices(['device_type' => 0]));
            //var_dump($players->editPlayerDevices('9ae055c8-955b-4450-8a96-4a81f97e293a', ['device_type' => 1]));
            //var_dump($players->createPlayerOnSession('9ae055c8-955b-4450-8a96-4a81f97e293a',['timezone' => '-28800', 'game_version' => '1.0', 'device_os' => '7.0.4']));
            //var_dump($players->createPlayerOnPurchase('9ae055c8-955b-4450-8a96-4a81f97e293a', ['sku' => 'SKU123', 'iso' => 'USD', 'amount' => '0.99']));
            //var_dump($players->createPlayerOnFocus('9ae055c8-955b-4450-8a96-4a81f97e293a', ['state' => 'ping', 'active_time' => 60]));
            //var_dump($players->createPlayerCsvExport());



            return new Response('test controller');
        }


    }