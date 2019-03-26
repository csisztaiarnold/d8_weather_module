<?php

namespace Drupal\weather\Services;

/**
 * Class WeatherService
 *
 * @package Drupal\weather\Services
 */
class WeatherService {

  /**
   * WeatherService constructor.
   */
  public function __construct() {
  }

  /**
   * Gets the JSON from the OpenWeatherMap API and converts it to an object
   *
   * @param int     $id
   * @param string  $appid
   *
   * @return object
   */
  public function getServiceData() {

    $config = \Drupal::config('weather.settings');

    $city_id = 0;
    if(!empty($config->get('city_id'))) {
      $city_id = $config->get('city_id');
    }

    $appid = '';
    if(!empty($config->get('appid'))) {
      $appid = $config->get('appid');
    }

    $client = \Drupal::httpClient();
    $url = 'https://api.openweathermap.org/data/2.5/weather?id=' . $city_id . '&appid=' . $appid . '&units=metric';

    $request = $client->get($url);
    $response = $request->getBody();
    $data = json_decode($response);

    return $data;

  }

}