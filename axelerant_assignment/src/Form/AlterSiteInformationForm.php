<?php

namespace Drupal\axelerant_assignment\Form;

// Classses required for form extend.
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Form\ConfigFormBase;

// Core system form we are going to extend.
use Drupal\system\Form\SiteInformationForm;

/**
 * Extending site information settings form.
 */
class AlterSiteInformationForm extends SiteInformationForm {

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    // To get sytem.site configuration.
    $site_config = $this->config('axelerant_assignment.config');
    
    // Get buildform from parent system form going to extend.
    $form = parent::buildForm($form, $form_state);

    //To add field set for api keys.
    $form['site_apikey_set'] = [
      '#type' => 'API Key',
      '#title' => t('Site API Info'),
      '#open' => TRUE,
    ];

    // Extend the system site infomration and add custom api key field.
    $form['site_apikey_set']['site_api_key'] = [
      '#type' => 'textfield',
      '#title' => 'Site API Key',
      '#default_value' => $site_config->get('siteapikey'),
      '#description' => t('Enter Site API Key to auth json data for basic page'),
    ];

    // To update button name.
    $form['actions']['submit']['#value'] = t('Update configuration');

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // To save api key value in site information adding submit function.
    \Drupal::configFactory()->getEditable('axelerant_assignment.config')
      ->set('siteapikey', $form_state->getValue('site_api_key'))
      ->save();

    // To save existing value of form in parent form.
    parent::submitForm($form, $form_state);

    // Success Message for updating apikey value.
    if (!empty($form_state->getValue('site_api_key'))) {
      drupal_set_message(t('Site API key has been updated with the value is ' . $form_state->getValue('site_api_key')));
    }
  }
}
