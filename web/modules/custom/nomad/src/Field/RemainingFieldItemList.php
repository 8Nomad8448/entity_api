<?php

namespace Drupal\event\Field;

use Drupal\Core\Field\FieldItemList;
use Drupal\Core\TypedData\ComputedItemListTrait;

class RemainingFieldItemList extends FieldItemList {

  use ComputedItemListTrait;

  protected function computeValue() {
    /* @var \Drupal\nomad\Entity\Nomad $event */
    $event = $this->getEntity();
    $remaining = $event->getMaximum() - count($event->getAttendees());
    $this->list[0] = $this->createItem(0, $remaining);
  }

}
