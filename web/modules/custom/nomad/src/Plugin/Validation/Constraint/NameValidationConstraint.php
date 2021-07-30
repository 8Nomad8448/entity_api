<?php

namespace Drupal\nomad\Plugin\Validation\Constraint;

use Symfony\Component\Validator\Constraint;

/**
 * Adding constraint in order to validate name.
 *
 * @Constraint(
 *   id = "NameValidation",
 *   label = @Translation("Email validation"),
 * )
 */
class NameValidationConstraint extends Constraint {

  /**
   * Create variable with name violation message.
   *
   * @var string
   */
  public $notvalid = 'The name %name is not valid.';

}
