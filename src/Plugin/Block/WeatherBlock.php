<?php

namespace Drupal\weather\Plugin\Block;

use \Drupal\Core\Block\BlockBase;
use \Drupal\weather\Services\WeatherService;
use \Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use \Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides a 'Weather' Block.
 *
 * @Block(
 *   id = "weather_block",
 *   admin_label = @Translation("Weather block"),
 *   category = @Translation("Weather Block"),
 * )
 */
class WeatherBlock extends BlockBase implements ContainerFactoryPluginInterface {

  /**
   * The weather service.
   *
   * @var \Drupal\weather\Services\WeatherService
   */
  private $weatherService;

  /**
   * WeatherController constructor.
   *
   * @param \Drupal\weather\Services\WeatherService $weather_service
   * The weather service.
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition, WeatherService $weather_service) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->weatherService = $weather_service;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('weather.weather_services')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function build() {
    $weather_data = $this->weatherService->getServiceData();
    return [
      '#theme' => 'weather',
      '#weather_data' => $weather_data,
    ];
  }

}
