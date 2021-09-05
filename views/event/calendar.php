<?php
use app\models\base\Event;
 
      $events  = Event::find()->all();
                  $eventos = [];
                  
                  foreach ($events as $event):
                      $Event        = new \yii2fullcalendar\models\Event();
                      $Event->id    = $event->id;
                      $Event->className = 'btn'; 
                      $Event->backgroundColor = 'green';
                      $Event->borderColor = 'blue';
                         if($event->title!='Availability'){
                        $Event->backgroundColor = 'red';
                        $Event->borderColor = 'red';
                      }
                      $Event->title = $event->title.'/'.$event->created_date;
                      $Event->start = $event->created_date;
                      
                      $eventos[]    = $Event;
                  endforeach;?>

        <?= \yii2fullcalendar\yii2fullcalendar::widget(array(
            'events'=> $eventos,

        ));

     