<?php

namespace Drupal\specbee_date_as_per_timezone\Plugin\Block;

use Drupal\Core\Access\AccessResult;
use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Session\AccountInterface;

/**
 * Provides a block with a simple text.
 *
 * @Block(
 *   id = "timezone_block",
 *   admin_label = @Translation("Timezone Block"),
 * )
 */
class TimezoneBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {

    $service = \Drupal::service('timezone_service.date_time');
    return [
      '#markup' => $service->getDateAndTime(),
      '#cache'  => [
        'max-age' => 0,
      ],
    ];
  }

  /**
   * {@inheritdoc}
   */
  protected function blockAccess(AccountInterface $account) {
    return AccessResult::allowedIfHasPermission($account, 'access content');
  }

  /**
   * {@inheritdoc}
   */
  public function blockForm($form, FormStateInterface $form_state) {
    $config = $this->getConfiguration();
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function blockSubmit($form, FormStateInterface $form_state) {
    $this->configuration['timezone_settings'] = $form_state->getValue('timezone_settings');
  }

}
