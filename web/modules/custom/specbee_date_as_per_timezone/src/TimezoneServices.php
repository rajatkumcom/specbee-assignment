<?php

namespace Drupal\specbee_date_as_per_timezone;

use Drupal\Core\Config\ConfigManagerInterface;
use Drupal\Core\Datetime\DrupalDateTime;

/**
 *
 */
class TimezoneServices {

  /**
   * The config manager.
   *
   * @var \Drupal\Core\Config\ConfigManagerInterface
   */
  protected $configManager;

  /**
   * Constructs a configuration timezone.
   *
   * @param \Drupal\Core\Config\ConfigManagerInterface $config_manager
   *   The configuration manager.
   */
  public function __construct(ConfigManagerInterface $config_manager) {
    $this->configManager = $config_manager->getConfigFactory()->get('timezone.settings');
  }

  /**
   *
   */
  public function getDateAndTime() {

    $date = new DrupalDateTime();
    $date->setTimezone(new \DateTimeZone($this->configManager->get('timezone')));
    return $date->format('m/d/Y g:i a');
  }

}
