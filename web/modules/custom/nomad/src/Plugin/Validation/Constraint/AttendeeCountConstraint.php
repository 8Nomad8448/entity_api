<?php

namespace Drupal\nomad\Plugin\Validation\Constraint;

use Symfony\Component\Validator\Constraint;

/**
 * @Constraint(
 *   id = "AttendeeCount",
 *   label = @Translation("Attendee count"),
 * )
 */
class AttendeeCountConstraint extends Constraint {

  /**
   * @var string
   */
  public $message = 'The event %title only allows %maximum attendees.';

}
