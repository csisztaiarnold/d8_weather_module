<?php

namespace Drupal\weather\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\weather\Controller\WeatherController;

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

    $controller = new WeatherController;
    $weather_data = $controller->getWeatherData();

    return array(
      '#theme' => 'weather',
      '#weather_data' => $weather_data,
    );
  }

}