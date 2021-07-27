<?php

namespace Drupal\event\Plugin\Validation\Constraint;

use Drupal\user\Entity\User;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class UniqueAttendeesConstraintValidator extends ConstraintValidator {

  public function validate($value, Constraint $constraint) {
    /* @var \Drupal\Core\Field\FieldItemListInterface $value */
    /* @var \Drupal\nomad\Plugin\Validation\Constraint\UniqueAttendeesConstraint $constraint */
    $user_ids = [];
    foreach ($value as $delta => $item) {
      $user_id = $item->target_id;
      if (in_array($user_id, $user_ids, TRUE)) {
        $this->context->buildViolation($constraint->message)
          ->setParameter('%name', User::load($user_id)->getDisplayName())
          ->atPath((string) $delta)
          ->addViolation();
        return;
      }
      $user_ids[] = $user_id;
    }
  }

}
