<?php

namespace Drupal\nomad\Plugin\Validation\Constraint;

use Symfony\Component\Validator\Constraint;

/**
 * Adding constraint in order to validate email.
 *
 * @Constraint(
 *   id = "EmailValidation",
 *   label = @Translation("Unique attendees"),
 * )
 */
class EmailValidationConstraint extends Constraint {

  /**
   * Create variable with email violation message.
   *
   * @var string
   */
  public $emailerror = 'Email %email is not valid';

}
