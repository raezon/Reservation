<?php 
namespace app\controllers;
use yii\helpers\Url;
use yii\web\Controller;
use Google_Client;
use Google_Service_Calendar;
use PHP;




//use bitcko\googlecalendar\GoogleCalendarApi;

/**
 * GoogleApi controller.
 *
 * @package app\controllers
 * @author  Mhmd Backer shehadi (bitcko) <www.bitcko.com>

 */
class GoogleApiController extends Controller
{
function getClient()
{
    $client = new Google_Client();
    $client->setApplicationName('Google Calendar API PHP Quickstart');
    $client->setScopes(Google_Service_Calendar::CALENDAR_READONLY);
    $client->setAuthConfig('credentials.json');
    $client->setAccessType('offline');
    $client->setPrompt('select_account consent');

    // Load previously authorized token from a file, if it exists.
    // The file token.json stores the user's access and refresh tokens, and is
    // created automatically when the authorization flow completes for the first
    // time.
    $tokenPath = 'token.json';
    if (file_exists($tokenPath)) {
        $accessToken = json_decode(file_get_contents($tokenPath), true);
        $client->setAccessToken($accessToken);
    }

    // If there is no previous token or it's expired.
    if ($client->isAccessTokenExpired()) {
        // Refresh the token if possible, else fetch a new one.
        if ($client->getRefreshToken()) {
            $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
        } else {
            // Request authorization from the user.
            $authUrl = $client->createAuthUrl();
            printf("Open the following link in your browser:\n%s\n", $authUrl);
            print 'Enter verification code: ';
            define('STDIN', fopen('php://stdin', 'r'));

            $authCode = trim(fgets(STDIN));

            // Exchange authorization code for an access token.
            //$accessToken = $client->fetchAccessTokenWithAuthCode($authCode);
            //$client->setAccessToken($accessToken);

            // Check to see if there was an error.
           /* if (array_key_exists('error', $accessToken)) {
                throw new Exception(join(', ', $accessToken));
            }*/
        }
        // Save the token to a file.
        if (!file_exists(dirname($tokenPath))) {
            mkdir(dirname($tokenPath), 0700, true);
        }
        file_put_contents($tokenPath, json_encode($client->getAccessToken()));
    }
    return $client;
}

    public function actionAuth(){




// Get the API client and construct the service object.
$client = $this->getClient();;
$service = new Google_Service_Calendar($client);

// Print the next 10 events on the user's calendar.
$calendarId = 'primary';
$optParams = array(
  'maxResults' => 10,
  'orderBy' => 'startTime',
  'singleEvents' => true,
  'timeMin' => date('c'),
);
$results = $service->events->listEvents($calendarId, $optParams);
$events = $results->getItems();

if (empty($events)) {
    print "No upcoming events found.\n";
} else {
    print "Upcoming events:\n";
    foreach ($events as $event) {
        $start = $event->start->dateTime;
        if (empty($start)) {
            $start = $event->start->date;
        }
        printf("%s (%s)\n", $event->getSummary(), $start);
    }
    }
}
    public function actionCreateEvent(){
      /*  $calendarId = 'primary';
        $username="any_name";
        $googleApi = new GoogleCalendarApi($username,$calendarId);
        if($googleApi->checkIfCredentialFileExists()){
            $event = array(
                'summary' => 'Google I/O 2018',
                'location' => '800 Howard St., San Francisco, CA 94103',
                'description' => 'A chance to hear more about Google\'s developer products.',
                'start' => array(
                    'dateTime' => '2018-06-14T09:00:00-07:00',
                    'timeZone' => 'America/Los_Angeles',
                ),
                'end' => array(
                    'dateTime' => '2018-06-14T17:00:00-07:00',
                    'timeZone' => 'America/Los_Angeles',
                ),
                'recurrence' => array(
                    'RRULE:FREQ=DAILY;COUNT=2'
                ),
                'attendees' => array(
                    array('email' => 'lpage@example.com'),
                    array('email' => 'sbrin@example.com'),
                ),
                'reminders' => array(
                    'useDefault' => FALSE,
                    'overrides' => array(
                        array('method' => 'email', 'minutes' => 24 * 60),
                        array('method' => 'popup', 'minutes' => 10),
                    ),
                ),
            );

           $calEvent = $googleApi->createGoogleCalendarEvent($event);
            \Yii::$app->response->data = "New event added with id: ".$calEvent->getId();
        }else{
            return $this->redirect(['auth']);
        }*/
    }


    public function actionDeleteEvent(){
      /*  $calendarId = 'primary';
        $username="any_name";
        $googleApi = new GoogleCalendarApi($username,$calendarId);
        if($googleApi->checkIfCredentialFileExists()){
            $eventId ='event_id' ;

             $googleApi->deleteGoogleCalendarEvent($eventId);
            \Yii::$app->response->data = "Event deleted";
        }else{
            return $this->redirect(['auth']);
        }*/
    }

    public function actionCalendarsList(){
        /*$calendarId = 'primary';
        $username="any_name";
        $googleApi = new GoogleCalendarApi($username,$calendarId);
        if($googleApi->checkIfCredentialFileExists()){
          $calendars =    $googleApi->calendarList();
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            \Yii::$app->response->data = $calendars;
        }else{
            return $this->redirect(['auth']);
        }*/
    }

}

