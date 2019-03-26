<?php
/**
 * @file
 * Contains \Drupal\weather\Controller\WeatherController.
 */
namespace Drupal\weather\Controller;

/**
 * Class WeatherController
 *
 * @package Drupal\weather\Controller
 */
class WeatherController {

  /**
   * WeatherController constructor.
   */
  public function __construct() {
  }

  /**
   * Gets weather data and passes it to the module
   *
   * @return array
   */
  public function content() {

    $service = \Drupal::service('weather.weather_services');
    $weather_data = $service->getServiceData();

    return [
      '#theme' => 'weather',
      '#weather_data' => $weather_data,
    ];

  }

}