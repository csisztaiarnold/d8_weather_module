<?php

/**
 * @file
 * Contains \Drupal\weather\Form\WeatherConfigForm.
 */

namespace Drupal\weather\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class WeatherConfigForm
 *
 * @package Drupal\weather\Form
 */
class WeatherConfigForm extends ConfigFormBase {

  /**
   * WeatherConfigForm constructor.
   */
  public function __construct() {
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'weather_config_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form = parent::buildForm($form, $form_state);
    $config = $this->config('weather.settings');

    $form['city_id'] = [
      '#type' => 'textfield',
      '#title' => $this->t('City ID'),
      '#default_value' => $config->get('city_id'),
      '#required' => TRUE,
    ];

    $form['appid'] = [
      '#type' => 'textfield',
      '#title' => $this->t('OpenWeatherMap API key'),
      '#default_value' => $config->get('appid'),
      '#required' => TRUE,
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $config = $this->config('weather.settings');
    $config->set('city_id', $form_state->getValue('city_id'));
    $config->set('appid', $form_state->getValue('appid'));
    $config->save();

    return parent::submitForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'weather.settings',
    ];
  }

}
