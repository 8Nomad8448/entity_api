<?php

namespace Drupal\nomad\Plugin\Validation\Constraint;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

/**
 * Create constraint validator for name constraint.
 */
class NameValidationConstraintValidator extends ConstraintValidator {

  /**
   * Name validation function.
   */
  public function validate($value, Constraint $constraint) {
    /** @var \Drupal\Core\Field\FieldItemListInterface $value */
    /** @var \Drupal\nomad\Plugin\Validation\Constraint\NameValidationConstraint $constraint */
    /** @var \Drupal\nomad\Entity\Nomad $nomad */
    $nomad = $value->value;

    if (!preg_match(strlen($nomad) < 2 || strlen($nomad) > 100) {
      $this->context->addViolation($constraint->notvalid, ['%name' => $nomad]);
    }
  }

}
