<?php

namespace Drupal\event\Plugin\Validation\Constraint;

use Symfony\Component\Validator\Constraint;

/**
 * @Constraint(
 *   id = "UniqueAttendees",
 *   label = @Translation("Unique attendees"),
 * )
 */
class UniqueAttendeesConstraint extends Constraint {

  /**
   * @var string
   */
  public $message = 'The user %name is already attending this event.';

}
