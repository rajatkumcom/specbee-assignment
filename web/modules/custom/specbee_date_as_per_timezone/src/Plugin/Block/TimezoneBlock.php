<?php

namespace Drupal\specbee_date_as_per_timezone\Plugin\Block;

use Drupal\Core\Block\BlockBase;

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
      '#theme' => 'timezone_block',
      '#data' => $service->getDateAndTime(),
      '#cache'  => [
        'max-age' => 0,
      ],
    ];
  }

}
