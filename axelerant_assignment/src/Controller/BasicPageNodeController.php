<?php

namespace Drupal\axelerant_assignment\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\node\NodeInterface;
use Drupal\Core\Access\AccessResult;
use Symfony\Component\HttpFoundation\JsonResponse;

class BasicPageNodeController {

  public function content($siteapikey, NodeInterface $node){
    // Get API key stored in the system and validate condition.
    $api_key_value =  \Drupal::config('axelerant_assignment.config')->get('siteapikey');

    if (empty($api_key_value) || $api_key_value != $siteapikey || $api_key_value == 'No API Key yet' || $node->getType() != 'page') {
      // Valication failed so return access denied json response.
      return new JsonResponse(array("error" => "access denied"), 401, ['Content-Type'=> 'application/json']);
    }

    // Return page json content to the user.
    return new JsonResponse($node->toArray(), 200, ['Content-Type'=> 'application/json']);
  }

}
