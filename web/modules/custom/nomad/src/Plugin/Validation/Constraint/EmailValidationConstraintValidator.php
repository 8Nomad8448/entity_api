<?php

namespace Drupal\nomad\Plugin\Validation\Constraint;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

/**
 * Create constraint validator for email constraint.
 */
class EmailValidationConstraintValidator extends ConstraintValidator {

  /**
   * Email validation function.
   */
  public function validate($value, Constraint $constraint) {
    /** @var \Drupal\Core\Field\FieldItemListInterface $value */
    /** @var \Drupal\nomad\Plugin\Validation\Constraint\EmailValidationConstraint $constraint */
    /** @var \Drupal\nomad\Entity\Nomad $nomad */
    $nomad = $value->value;

    if (filter_var($nomad, FILTER_VALIDATE_EMAIL) && preg_match('/[#$%^&*()+=!\[\]\';,\/{}|":<>?~\\\\]/', $nomad)) {
      $this->context->addViolation($constraint->emailerror, ['%email' => $nomad]);
    }
  }

}
