<?php

namespace Drupal\nomad\Form;

use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\HtmlCommand;
use Drupal\Core\Ajax\RedirectCommand;
use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;

/**
 * Extending form to in order create ajax validation, and add messenger.
 */
class NomadForm extends ContentEntityForm {

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form = parent::buildForm($form, $form_state);
    $form['Name']['widget'][0]['value']['#ajax'] = [
      'callback' => '::validateNameAjax',
      'event' => 'change',
    ];
    $form['Email']['widget'][0]['value']['#ajax'] = [
      'callback' => '::validateEmailAjax',
      'event' => 'change',
    ];
    $form['Phone']['widget'][0]['value']['#ajax'] = [
      'callback' => '::validatePhoneAjax',
      'event' => 'change',
    ];
    $form['system_messages'] = [
      '#markup' => '<div id="form-system-messages"></div>',
      '#weight' => -100,
    ];
    $form['actions']['submit']['#ajax'] = [
      'callback' => '::ajaxSubmitCallback',
      'event' => 'click',
    ];
    return $form;
  }

  /**
   * Creating ajax validation for phone number field of form.
   */
  public function validatePhoneAjax(array &$form, FormStateInterface $form_state) {
    $response = new AjaxResponse();
    $phonevalue = $form_state->getValue('Phone');
    $phone = $phonevalue[0]['value'];
    if (strlen($phone) < 1 || $phone == "") {
      $response->addCommand(new HtmlCommand('#form-system-messages', "
<div class='data-drupal-messages'>
<div class='alert alert-dismissible fade show alert-danger messages messages--error'>Phone field is required.
    </div>
    </div>"));
    }
    elseif (!preg_match('/^(\+[0-9]{9,15}|[0-9]{9,15})$/', $phone)
      || preg_match('/[- a-zA-ZA-z#$%^&*()=!\[\]\';,\/{}|":<>?~\\\\]/', $phone)
      || strlen($phone) > 16 || strlen($phone) < 9) {
      $response->addCommand(new HtmlCommand('#form-system-messages',
        "<div class='data-drupal-messages'>
<div class='alert alert-dismissible fade show alert-danger messages messages--error'>
Phone number $phone is not valid.</div>
</div>"));
    }
    else {
      $response->addCommand(new HtmlCommand('#form-system-messages',
        "<div class='data-drupal-messages'>
<div class='alert alert-dismissible fade show alert-success messages messages--status'>
Phone number $phone is correct.</div>
</div>"));
    }
    return $response;
  }

  /**
   * Creating ajax validation for name field of form.
   */
  public function validateNameAjax(array &$form, FormStateInterface $form_state) {
    $response = new AjaxResponse();
    $value = $form_state->getValue('Name');
    $name = $value[0]['value'];
    if (strlen($name) < 1 || $name == "") {
      $response->addCommand(new HtmlCommand('#form-system-messages',
        "<div class='data-drupal-messages'>
<div class='alert alert-dismissible fade show alert-danger messages messages--error'>The name field is required.
    </div>
</div>"));
    }
    elseif (strlen($name) < 2 || strlen($name) > 100) {
      $response->addCommand(new HtmlCommand('#form-system-messages',
        "<div class='data-drupal-messages'>
<div class='alert alert-dismissible fade show alert-danger messages messages--error'>The name $name is not valid.
    </div>
</div>"));
    }
    else {
      $response->addCommand(new HtmlCommand('#form-system-messages',
        "<div class='data-drupal-messages'>
<div class='alert alert-dismissible fade show alert-success messages messages--status'>The name $name is correct.
</div>
</div>"));
    }
    return $response;
  }

  /**
   * Creating ajax validation for email field of form.
   */
  public function validateEmailAjax(array &$form, FormStateInterface $form_state) {
    $response = new AjaxResponse();
    $emailvalue = $form_state->getValue('Email');
    $email = $emailvalue[0]['value'];
    if (strlen($email) < 1 || $email == "") {
      $response->addCommand(new HtmlCommand('#form-system-messages', "<div class='data-drupal-messages'>
<div class='alert alert-dismissible fade show alert-danger messages messages--error'>
Email field is required.
    </div>
</div>"));
    }
    elseif (!preg_match('/[#$%^&*()+=!\[\]\';,\/{}|":<>?~\\\\]/', $email) &&
      filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $response->addCommand(new HtmlCommand('#form-system-messages',
        "<div class='data-drupal-messages'>
<div class='alert alert-dismissible fade show alert-success messages messages--status'>Email $email is correct.
</div>
</div>"));
    }
    else {
      $response->addCommand(new HtmlCommand('#form-system-messages',
        "<div class='data-drupal-messages'>
<div class='alert alert-dismissible fade show alert-danger messages messages--error'>Email $email is not valid.
    </div>
</div>"));
    }
    return $response;
  }

  /**
   * Adding ajax to form submit button.
   */
  public function ajaxSubmitCallback(array &$form, FormStateInterface $form_state) {
    parent::submitForm($form, $form_state);
    $ajax_response = new AjaxResponse();
    $message = [
      '#theme' => 'status_messages',
      '#message_list' => $this->messenger()->all(),
      '#status_headings' => [
        'status' => t('Status message'),
        'error' => t('Error message'),
        'warning' => t('Warning message'),
      ],
    ];
    $messages = \Drupal::service('renderer')->render($message);
    $ajax_response->addCommand(new HtmlCommand('#form-system-messages', $messages));
    $url = Url::fromRoute('nomad.content');
    $command = new RedirectCommand($url->toString());
    $ajax_response->addCommand($command);
    return $ajax_response;
  }

  /**
   * Adding messenger to form.
   */
  public function save(array $form, FormStateInterface $form_state) {
    parent::save($form, $form_state);

    $entity = $this->getEntity();
    $entity_type = $entity->getEntityType();

    $arguments = [
      '@entity_type' => $entity_type->getSingularLabel(),
      '%entity' => $entity->label(),
      'link' => $entity->toLink($this->t('View'), 'canonical')->toString(),
    ];

    $this->logger($entity->getEntityTypeId())->notice('Form has been submitted successfully.', $arguments);
    $this->messenger()->addStatus($this->t('Form has been submitted successfully.', $arguments));

    $form_state->setRedirectUrl(Url::fromRoute('nomad.content'));
  }

}
