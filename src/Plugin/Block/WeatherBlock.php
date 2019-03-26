<?php

namespace Drupal\weather\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'Weather' Block.
 *
 * @Block(
 *   id = "weather_block",
 *   admin_label = @Translation("Weather block"),
 *   category = @Translation("Weather Block"),
 * )
 */
class WeatherBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {

    $service = \Drupal::service('weather.weather_services');
    $weather_data = $service->getServiceData();

    return [
      '#theme' => 'weather',
      '#weather_data' => $weather_data,
    ];
  }

}