<?php

namespace Drupal\example\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Configure example settings for this site.
 */
class TimeZoneConfigurationForm extends ConfigFormBase {

  /** 
   * Config settings.
   *
   * @var string
   */
  const SETTINGS = 'timezone.settings';

  /** 
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'timezone_admin_settings';
  }

  /** 
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      static::SETTINGS,
    ];
  }

  /** 
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config(static::SETTINGS);

    $form['country'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Country'),
      '#default_value' => $config->get('country'),
    ];  

    $form['city'] = [
      '#type' => 'textfield',
      '#title' => $this->t('City'),
      '#default_value' => $config->get('city'),
    ];
    
    $form['timezone'] = array(
      '#type' => 'select',
       '#title' => $this->t('Timezone'),
       '#options' => [
          0 => $this->t('America/Chicago'),
         1 => $this->t('America/New_York'),
         2 => $this->t('Asia/Tokyo'),
           3 => $this->t('Asia/Dubai'),
         4 => $this->t('Asia/Kolkata'),
           5 => $this->t('Europe/Amsterdam'),
         6 => $this->t('Europe/Oslo'),
         7 => $this->t('Europe/London'),
       ],
       '#default_value' => $config->get('timezone'),
       '#description' => t('Select timezone.'),
   );

    return parent::buildForm($form, $form_state);
  }

  /** 
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {

    $this->config(static::SETTINGS)
      ->set('country', $form_state->getValue('country'))
      ->set('city', $form_state->getValue('city'))
    ->set('timezone', $form_state->getValue('timezone'))
      ->save();

    parent::submitForm($form, $form_state);
  }

}
