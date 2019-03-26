<?php
/**
 * @file
 * Contains \Drupal\weather\Controller\WeatherController.
 */
namespace Drupal\weather\Controller;

class WeatherController {

  var $weather_data;

  /**
   * Gets weather data and passes it to the module
   *
   * @return array
   */
  public function content() {

    $this->weather_data = $this->getWeatherData();

    return array(
      '#theme' => 'weather',
      '#weather_data' => $this->weather_data,
    );

  }


  /**
   * Gets the JSON from the OpenWeatherMap API and converts it to an object
   *
   * @param int     $id
   * @param string  $appid
   *
   * @return object
   */
  public function getWeatherData() {

    $config = \Drupal::config('weather.settings');

    $city_id = 0;
    if(!empty($config->get('city_id'))) {
      $city_id = $config->get('city_id');
    }

    $appid = '';
    if(!empty($config->get('appid'))) {
      $appid = $config->get('appid');
    }

    $url = 'https://api.openweathermap.org/data/2.5/weather?id=' . $city_id . '&appid=' . $appid . '&units=metric';

    $curl = curl_init();
    $headers = array();
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($curl, CURLOPT_HEADER, 0);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_TIMEOUT, 30);
    $json = curl_exec($curl);
    curl_close($curl);

    $data = json_decode($json);

    return $data;

  }

}