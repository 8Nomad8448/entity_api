<?php

namespace Drupal\nomad\Plugin\Validation\Constraint;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class AttendeeCountConstraintValidator extends ConstraintValidator {

  public function validate($value, Constraint $constraint) {
    /* @var \Drupal\Core\Field\FieldItemListInterface $value */
    /* @var \Drupal\event\Plugin\Validation\Constraint\AttendeeCountConstraint $constraint */
    /* @var \Drupal\Core\Entity\Plugin\DataType\EntityAdapter $adapter */
    $adapter = $value->getParent();
    /* @var \Drupal\nomad\Entity\Nomad $event */
    $event = $adapter->getEntity();
    $maximum = $event->getMaximum();
    if (count($value) > $maximum) {
      $this->context->buildViolation($constraint->message)
        ->setParameter('%title', $event->getTitle())
        ->setParameter('%maximum', $maximum)
        ->addViolation();
    }
  }

}
