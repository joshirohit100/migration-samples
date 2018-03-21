<?php

namespace Drupal\sample_mifration_module\EventSubscriber;

use Drupal\migrate\Event\MigrateEvents;
use Drupal\migrate\Event\MigratePostRowSaveEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class PostRowSaveEventSubscriber implements EventSubscriberInterface {

  /**
   * Send mail if node of a specific content type saved has specific title.
   *
   * @param \Drupal\migrate\Event\MigratePostRowSaveEvent $event
   *   The migrate post row save event.
   */
  public function onPostRowSave(MigratePostRowSaveEvent $event) {
    $row = $event->getRow();
    $destination = $row->getDestination();
    $send_mail = ($destination['bundle'] == 'page' && $destination['title'] == 'Test title') ? TRUE : FALSE;

    if ($send_mail) {
      $mailManager = \Drupal::service('plugin.manager.mail');
      $params['message'] = 'This is sample message';
      $params['title'] = 'node title here';
      $to = 'enter_ur_email_here';
      $mailManager->mail('sample_mifration_module', 'sample_mifration_module', $to, 'en', $params, NULL, TRUE);
    }

  }

  /**
   * {@inheritdoc}
   */
  public static function getSubscribedEvents() {
    $events = [];
    $events[MigrateEvents::POST_ROW_SAVE] = ['onPostRowSave'];
    return $events;
  }

}
