<?php

namespace Drupal\nomad\Entity;

use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityPublishedInterface;
use Drupal\Core\Entity\EntityPublishedTrait;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\user\EntityOwnerInterface;
use Drupal\user\EntityOwnerTrait;

/**
 * Create content entity with it attributes for my module.
 *
 * @ContentEntityType(
 *   id = "nomad",
 *   label = @Translation("Nomad"),
 *   label_collection = @Translation("Nomads"),
 *   label_singular = @Translation("nomad"),
 *   label_plural = @Translation("nomads"),
 *   base_table = "nomad",
 *   entity_keys = {
 *     "id" = "id",
 *     "uuid" = "uuid",
 *     "owner" = "author",
 *     "published" = "published",
 *   },
 *   handlers = {
 *     "access" = "Drupal\Core\Entity\EntityAccessControlHandler",
 *     "form" = {
 *       "add" = "Drupal\nomad\Form\NomadForm",
 *       "edit" = "Drupal\nomad\Form\NomadForm",
 *       "delete" = "Drupal\Core\Entity\ContentEntityDeleteForm",
 *     },
 *     "permission_provider" = "Drupal\Core\Entity\EntityPermissionProvider",
 *     "route_provider" = {
 *       "default" = "Drupal\Core\Entity\Routing\DefaultHtmlRouteProvider",
 *     },
 *     "list_builder" = "Drupal\nomad\Controller\NomadAdminController",
 *     "local_action_provider" = {
 *       "collection" = "Drupal\entity\Menu\EntityCollectionLocalActionProvider",
 *     },
 *   },
 *   links = {
 *     "canonical" = "/nomad/guests/{nomad}",
 *     "collection" = "/admin/content/nomads",
 *     "add-form" = "/admin/content/nomad/add",
 *     "edit-form" = "/admin/content/nomad/manage/{nomad}",
 *     "delete-form" = "/admin/content/nomad/manage/delete/{nomad}",
 *   },
 *   admin_permission = "access content",
 * )
 */
class Nomad extends ContentEntityBase implements EntityOwnerInterface, EntityPublishedInterface {

  use EntityOwnerTrait, EntityPublishedTrait;

  /**
   * Creating static function, for fields definition.
   */
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {
    // Get the field definitions for 'id' and 'uuid' from the parent.
    $fields = parent::baseFieldDefinitions($entity_type);

    $fields['Avatar'] = BaseFieldDefinition::create('image')
      ->setDescription(t('You can add avatar here.'))
      ->setRevisionable(TRUE)
      ->setSettings([
        'file_extensions' => 'png jpg jpeg',
        'file_directory' => 'public://photos',
        'alt_field' => FALSE,
        'alt_field_required' => FALSE,
        'max_filesize' => '2097152',
        'max_resolution' => '1200x800',
        'min_resolution' => '60x60',
      ])
      ->setDisplayOptions('form', [
        'weight' => 0,
      ])
      ->setDisplayOptions('view', [
        'label' => 'inline',
        'weight' => 0,
      ])
      ->setRequired(FALSE);

    $fields['Name'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Name'))
      ->setDescription(t('Your name must consist from latin alphabet letters, and have at least 2 characters, and
      maximum 100.'))
      ->setRevisionable(TRUE)
      ->setTranslatable(TRUE)
      ->setSettings([
        'max_length' => '100',
        'size' => '101',
      ])
      ->setDisplayOptions('form', [
        'weight' => 1,
      ])
      ->setDisplayOptions('view', [
        'label' => 'inline',
        'weight' => 1,
      ])
      ->setRequired(TRUE);

    $fields['Date'] = BaseFieldDefinition::create('created')
      ->setLabel(t('Date'))
      ->setDescription(t('This field must contain time when this comment where created.'))
      ->setRevisionable(TRUE)
      ->setTranslatable(TRUE)
      ->setDisplayOptions('view', [
        'label' => 'inline',
        'type' => 'timestamp',
        'settings' => [
          'date_format' => 'custom',
          'custom_date_format' => 'd/m/Y H:i:s',
        ],
        'weight' => 2,
      ])
      ->setRequired(TRUE);

    $fields['Feedback'] = BaseFieldDefinition::create('text_long')
      ->setLabel(t('Message'))
      ->setRevisionable(TRUE)
      ->setTranslatable(TRUE)
      ->setDisplayOptions('form', [
        'label' => 'inline',
        'weight' => 3,
      ])
      ->setDisplayOptions('view', [
        'label' => 'inline',
        'weight' => 3,
      ])
      ->setRequired(TRUE);

    $fields['Image'] = BaseFieldDefinition::create('image')
      ->setDescription(t('You add some image here.'))
      ->setRevisionable(TRUE)
      ->setTranslatable(TRUE)
      ->setSettings([
        'file_extensions' => 'png jpg jpeg',
        'file_directory' => 'public://photos',
        'alt_field' => FALSE,
        'alt_field_required' => FALSE,
        'max_filesize' => '5242880',
        'max_resolution' => '1920x1200',
        'min_resolution' => '100x100',
      ])
      ->setDisplayOptions('form', [
        'weight' => 4,
      ])
      ->setDisplayOptions('view', [
        'label' => 'inline',
        'weight' => 4,
      ])
      ->setRequired(FALSE);

    $fields['Email'] = BaseFieldDefinition::create('email')
      ->setLabel(t('Email'))
      ->setDescription(t('Please enter your email.'))
      ->setRevisionable(TRUE)
      ->setTranslatable(TRUE)
      ->setDisplayOptions('form', [
        'weight' => 5,
      ])
      ->setDisplayOptions('view', [
        'label' => 'inline',
        'weight' => 5,
      ])
      ->setRequired(TRUE);

    $fields['Phone'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Phone'))
      ->setDescription(t('Please add your phone number.'))
      ->setRevisionable(TRUE)
      ->setTranslatable(TRUE)
      ->setDisplayOptions('form', [
        'weight' => 6,
      ])
      ->setDisplayOptions('view', [
        'label' => 'inline',
        'weight' => 6,
      ])
      ->setRequired(TRUE);

    // Get the field definitions for 'author' and 'published' from the trait.
    $fields += static::ownerBaseFieldDefinitions($entity_type);
    $fields += static::publishedBaseFieldDefinitions($entity_type);

    return $fields;
  }

  /**
   * Returns added avatar value.
   */
  public function getAvatar() {
    return $this->get('Avatar')->target_id;
  }

  /**
   * Returns name that was set by user.
   */
  public function getName() {
    return $this->get('Name')->value;
  }

  /**
   * Returns time when it was created.
   */
  public function getDate() {
    $date = $this->get('Date')->value;
    return date('d/m/Y H:i:s', $date);
  }

  /**
   * Returns value of the user's feedback.
   */
  public function getFeedback() {
    return $this->get('Feedback')->value;
  }

  /**
   * Returns added image value.
   */
  public function getImage() {
    return $this->get('Image')->target_id;
  }

  /**
   * Returns email value left by user.
   */
  public function getEmail() {
    return $this->get('Email')->value;
  }

  /**
   * Returns user's phone value.
   */
  public function getPhone() {
    return $this->get('Phone')->value;
  }

}
