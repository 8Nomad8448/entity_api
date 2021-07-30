<?php

namespace Drupal\nomad\Plugin\Validation\Constraint;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

/**
 * Create constraint validator for phone constraint.
 */
class PhoneValidationConstraintValidator extends ConstraintValidator {

  /**
   * Phone number validation function.
   */
  public function validate($value, Constraint $constraint) {
    /** @var \Drupal\Core\Field\FieldItemListInterface $value */
    /** @var \Drupal\nomad\Plugin\Validation\Constraint\PhoneValidationConstraint $constraint */
    /** @var \Drupal\nomad\Entity\Nomad $nomad */
    $nomad = $value->value;

    if (!preg_match('/^(\+[0-9]{9,15}|[0-9]{9,15})$/', $nomad)
      || preg_match('/[- a-zA-ZA-z#$%^&*()=!\[\]\';,\/{}|":<>?~\\\\]/', $nomad)
      || strlen($nomad) > 16 || strlen($nomad) < 9) {
      $this->context->addViolation($constraint->phoneerror, ['%phone' => $nomad]);
    }
  }

}
