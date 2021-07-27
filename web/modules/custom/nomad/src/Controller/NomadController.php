<?php

namespace Drupal\nomad\Controller;

use Drupal\Core\Url;
use Drupal\Core\Controller\ControllerBase;
use Drupal\file\Entity\File;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Extending ControllerBase for creating our form.
 */
class NomadController extends ControllerBase {
  /**
   * Marking variable for dependency injection use.
   *
   * @var \Component\DependencyInjection\ContainerInterface
   */
  protected $formbuild;

  /**
   * Marking variable for dependency injection use.
   *
   * @var \Component\DependencyInjection\EntityTypeManager
   */
  protected $entitymanager;

  /**
   * Using form-builder to create a from pulled with dependency injection.
   */
  public static function create(ContainerInterface $container) {
    $instance = parent::create($container);
    $instance->formbuild = $container->get('entity.form_builder');
    $instance->entitymanager = $container->get('entity_type.manager');
    return $instance;
  }

  /**
   * Getting before created form, from Nomadform.php.
   */
  public function myform() {
    $entity = $this->entitymanager->getStorage("nomad")->create([
      'entity_type' => "node",
      'entity' => "nomad",
    ]);
    $nomadform = $this->formbuild->getForm($entity, "add");
    return $nomadform;
  }

  /**
   * Created function for load info from database.
   */
  protected function load() {
    // Create connection, select the specific fields for the output.
    $db = \Drupal::service('database');
    $select = $db->select('nomad', 'r');
    $select->fields('r', ['Avatar__target_id', 'Name', 'Email',
      'Phone', 'Date', 'Feedback__value',
      'Image__target_id', 'id',
    ]);
    $select->orderBy('Date', 'DESC');
    $entries = $select->execute()->fetchall();
    return $entries;
  }

  /**
   * Created function for load info from database.
   */
  public function report() {
    // Added function to create markup and render information.
    $content = [];
    $contents = $this->load();
    $rows = json_decode(json_encode($contents), TRUE);
    // Using foreach to decode and put images in every row.
    foreach ($rows as $key => $entry) {
      // Formatting time from database.
      $timecreate = $entry['Date'];
      $timeformat = date('d/m/Y H:i:s', $timecreate);
      // If there is set avatar upload and get's it url for render,
      // else use default avatar that stores in module.
      if (isset($entry['Avatar__target_id']) && $entry['Avatar__target_id'] != 0) {
        $avatarfile = File::load($entry['Avatar__target_id']);
        $avataruri = $avatarfile->getFileUri();
        $avatarurl = file_url_transform_relative(Url::fromUri(file_create_url($avataruri))->toString());
      }
      else {
        $avatarurl = '/' . drupal_get_path('module', 'nomad') . "/photos/default_avatar.jpg";
      }
      // If there is set image upload it and get's it url for render,
      // else render empty url.
      if (isset($entry['Image__target_id']) && $entry['Image__target_id'] != 0) {
        $imgfile = File::load($entry['Image__target_id']);
        $uri = $imgfile->getFileUri();
        $url = file_url_transform_relative(Url::fromUri(file_create_url($uri))->toString());
      }
      else {
        $url = '';
      }
      $rows[$key]['Image__target_id'] = $url;
      $rows[$key]['Avatar__target_id'] = $avatarurl;
      $rows[$key]['Date'] = $timeformat;
    }
    // Use my form, by loaded by dependency injection,
    // and get destination for redirect after form submit.
    $content['form'] = $this->myform();
    $value = $this->getDestinationArray();
    $dest = $value['destination'];
    return [
      '#theme' => 'nomad_twig',
      '#form' => $content['form'],
      '#items' => $rows,
      '#title' => $this->t("Hello! You can share with us your opinion here."),
      '#markup' => $this->t('Below is a list af all guests that taking part in opinion exchange'),
      '#root' => $dest,
    ];
  }

}
