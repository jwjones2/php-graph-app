<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Microsoft\Graph\Graph;
use Microsoft\Graph\Model;
use App\TokenStore\TokenCache;

class CalendarController extends Controller
{
  public function calendar()
  {
    $viewData = $this->loadViewData();

    // Get the access token from the cache
    $tokenCache = new TokenCache();
    $accessToken = file_get_contents('token.txt');//$tokenCache->getAccessToken();

    // Create a Graph client
    $graph = new Graph();
    //$graph->setProxyPort("localhost:8888");
    $graph->setAccessToken($accessToken);

    $queryParams = array(
      '$select' => 'subject,organizer,start,end',
      '$orderby' => 'createdDateTime DESC'
    );

    // Append query parameters to the '/me/events' url
    //$getEventsUrl = '/me/events?'.http_build_query($queryParams);
    $getEventsUrl = '/deviceManagement/managedDevices';//'/deviceManagement/deviceCompliancePolicySettingStateSummaries';
    //$getEventsUrl = '/deviceManagement/deviceConfigurations';//'/deviceManagement/deviceCompliancePolicySettingStateSummaries';

    $devices = $graph->createRequest('GET', $getEventsUrl)
      ->setReturnType(Model\ManagedDevice::class)
      ->execute();

      $viewData['events'] = $devices;
      //file_put_contents('return.txt', $events);
      return view('calendar', $viewData);
  }
}