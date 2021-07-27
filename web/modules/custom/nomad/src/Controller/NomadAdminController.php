<?php

namespace Drupal\nomad\Controller;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\file\Entity\File;

/**
 * Extending ControllerBase for creating our form.
 */
class NomadAdminController extends EntityListBuilder {

  public function buildHeader() {
    $header = [];
    $header['Avatar'] = $this->t('Avatar');
    $header['Name'] = $this->t('Name');
    $header['Date'] = $this->t('Date');
    $header['Message'] = $this->t('Message');
    $header['Image'] = $this->t('Image');
    $header['Email'] = $this->t('Email');
    $header['Phone'] = $this->t('Phone');
    return $header + parent::buildHeader();
}

  public function buildRow(EntityInterface $event) {
    /** @var \Drupal\nomad\Entity\Nomad $event */
    $row = [];
    $row['Avatar'] = $event->getAvatar();
    $row['Name'] = $event->getName();
    $row['Date'] = $event->getDate();
    $row['Message'] = $event->getFeedback();
    $row['Image'] = $event->getImage();
    if (isset($row['Avatar']) && $row['Avatar'] != 0) {
      $avatarfile = File::load($row['Avatar']);
      $avataruri = $avatarfile->getFileUri();
      $avatar_variables = [
        '#type' => 'image',
        '#theme' => 'image_style',
        '#style_name' => 'thumbnail',
        '#alt' => "User's pet's images",
        '#title' => "User's pet's images",
        '#uri' => $avataruri,
      ];
      $guestsavatar = \Drupal::service('renderer')->render($avatar_variables);
    }
    else {
      $avatar_variables = [
        '#markup' => '<img class="default-avatar" src="/modules/custom/nomad/photos/default_avatar.jpg" alt="Default avatar picture for users">',
      ];
      $guestsavatar = \Drupal::service('renderer')->render($avatar_variables);
    }
    // If there is set image upload it and get's it url for render,
    // else render empty url.
    if (isset($row['Image']) && $row['Image'] != 0) {
      $imgfile = File::load($row['Image']);
      $uri = $imgfile->getFileUri();
      $image_variables = [
        '#type' => 'image',
        '#theme' => 'image_style',
        '#style_name' => 'medium',
        '#alt' => "User's pet's images",
        '#title' => "User's pet's images",
        '#uri' => $uri,
      ];
      $guestsimage = \Drupal::service('renderer')->render($image_variables);
    }
    else {
      $guestsimage = '';
    }
    $row['Avatar'] = $guestsavatar;
    $row['Image'] = $guestsimage;
    $row['Email'] = $event->getEmail();
    $row['Phone'] = $event->getPhone();
    return $row + parent::buildRow($event);
  }

}
