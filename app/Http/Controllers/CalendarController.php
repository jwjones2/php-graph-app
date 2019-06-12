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
    //$getEventsUrl = '/deviceManagement/managedDevices';//'/deviceManagement/deviceCompliancePolicySettingStateSummaries';
    $getEventsUrl = '/deviceManagement/deviceConfigurations';//'/deviceManagement/deviceCompliancePolicySettingStateSummaries';

    $search_name = 'Device Configurations';

    $devices = $graph->createRequest('GET', $getEventsUrl)
      //->setReturnType(Model\DeviceConfiguration::class)
      ->execute();

      $json = $devices->getBody();

      //var_dump($json);
      /*
      //echo "<h1>" . $json['value'][0]['@odata.type'] . "</h1>";
      foreach ( $json['value'][0] as $key => $value) {
        //fwrite($f, print_r($key));
        echo "<h1>KEY: $key </h1>"; //, VALUE: $value<h1>";
        //echo "<h1>" . gettype($value) . "</h1>";
        if ( gettype($value) != "array" ) {
          echo "<h1 style='color:red'>VALUE: $value</h1>";
        }
      */

      //$viewData['events'] = $devices;
      //file_put_contents('return.txt', $events);
      return view('calendar')->with([
        'data' => $json,
        'search_name' => $search_name
      ]);
  }

  public static function check_value( $val ) {
    if ( $val == true ) {
      return "true";
    }
    if ( $val == false ) {
      return "false";
    }

    if ( gettype($val) == "array" && count($val) == 0 ) {
      return "Not Set";
    }

    if ( $val == null ) {
      return "Not Set";
    }

    return $val;
  }

  public static function convert_camel_case ( $text ) {
    $arr = str_split($text);
    $title_case = '';
    foreach($arr as $letter) {
      
    }
  }
}