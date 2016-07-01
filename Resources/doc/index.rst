1) Download

Download or clone into the vendor file

2) Install
Add in your app/autoload.php

    $loader->add('Dwade75\\OnesignalBundle', __DIR__.'/../vendor');

AppKernel.php
    public function registerBundles()
    {
        $bundles = [
            new Dwade75\OnesignalBundle\Dwade75OnesignalBundle(),
        ];
    }


Example :

Apps:
$app = new AppsController();
$app->getApps();
$app->getAppById();
$app->createApp(array('name' => 'Api testing','apns_env' => 'sandbox'));
$app->editAppById(array('name' => 'update update Api testing','apns_env' => 'sandbox'));

Notifications:
$notification = new NotificationsController();
$notification->createNotification(['contents' => ['en' => 'Super message from api'], 'included_segments' => 'All', 'send_after' => '2016-07-01 10:00:00 GMT-0700']);
$notification->editNotificationById('5dba5289-0b74-4379-bcb7-fd87668404fc');
$notification->removeNotificationById('5dba5289-0b74-4379-bcb7-fd87668404fc');

Players:
$players = new PlayersController();
$players->getPlayersDevices();
$players->getPlayerDevicesById('32dc08b1-6c71-4a8a-af0a-8ee79c9bf1b5');
$players->createPlayerDevices(['device_type' => 0]);
$players->editPlayerDevices('9ae055c8-955b-4450-8a96-4a81f97e293a', ['device_type' => 1]);
$players->createPlayerOnSession('9ae055c8-955b-4450-8a96-4a81f97e293a',['timezone' => '-28800', 'game_version' => '1.0', 'device_os' => '7.0.4']);
$players->createPlayerOnPurchase('9ae055c8-955b-4450-8a96-4a81f97e293a', ['sku' => 'SKU123', 'iso' => 'USD', 'amount' => '0.99']);
$players->createPlayerOnFocus('9ae055c8-955b-4450-8a96-4a81f97e293a', ['state' => 'ping', 'active_time' => 60]);
$players->createPlayerCsvExport();

For more visit https://documentation.onesignal.com/docs/server-api-overview

by Dwade75