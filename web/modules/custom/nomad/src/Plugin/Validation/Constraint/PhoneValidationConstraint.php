<?php

namespace Drupal\nomad\Plugin\Validation\Constraint;

use Symfony\Component\Validator\Constraint;

/**
 * Adding constraint in order to validate phone number.
 *
 * @Constraint(
 *   id = "PhoneValidation",
 *   label = @Translation("Phone validation"),
 * )
 */
class PhoneValidationConstraint extends Constraint {

  /**
   * Create variable with phone violation message.
   *
   * @var string
   */
  public $phoneerror = 'The phone number %phone is not valid.';

}
