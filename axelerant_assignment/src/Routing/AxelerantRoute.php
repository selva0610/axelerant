<?php

namespace Drupal\axelerant_assignment\Routing;

// Using route base classes.
use Drupal\Core\Routing\RouteSubscriberBase;
use Symfony\Component\Routing\RouteCollection;

/**
 * Altering the router.
 */
class AxelerantRoute extends RouteSubscriberBase {

  /**
   * {@inheritdoc}
   */
  protected function alterRoutes(RouteCollection $collection) {
    if ($route = $collection->get('system.site_information_settings')) {
      $route->setDefault('_form', 'Drupal\axelerant_assignment\Form\AlterSiteInformationForm');
    }
  }

}
