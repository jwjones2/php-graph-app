<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Microsoft\Graph\Graph;
use Microsoft\Graph\Model;
use App\TokenStore\TokenCache;
use Illuminate\Support\Facades\Session;   
use App\Search;

class CalendarController extends Controller
{
  public function calendar(Request $request)
  {
    $viewData = $this->loadViewData();

    // Get the access token from the cache
    $tokenCache = new TokenCache();
    // check if over 30 minutes have passed since token saved, redirect to signout if so
    $time = file_get_contents('timeout.txt');
    if ( time() - $time > 1800 ) {
      return redirect('/signout');
    }
    $accessToken = file_get_contents('token.txt');//$tokenCache->getAccessToken();
  
    // Create a Graph client
    $graph = new Graph();
    //$graph->setProxyPort("localhost:8888");
    $graph->setAccessToken($accessToken);

    $queryParams = array(
      //'$select' => 'subject,organizer,start,end',
      '$orderby' => 'createdDateTime DESC'
    );

    // Append query parameters to the '/me/events' url
    //$getEventsUrl = '/me/events?'.http_build_query($queryParams);
    //$getEventsUrl = '/deviceManagement/managedDevices';//'/deviceManagement/deviceCompliancePolicySettingStateSummaries';
    //$getEventsUrl = '/deviceManagement/deviceConfigurations';//'/deviceManagement/deviceCompliancePolicySettingStateSummaries';
    //$query_params = '$orderby=displayName DESC';
    $search = Search::find($request->id);
    $getEventsUrl = $search->query;

    $search_name = $search->name;//'Device Configurations';

    $devices = $graph->createRequest('GET', $getEventsUrl)// . http_build_query($queryParams))
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
        'search_name' => $search_name,
        'display_title' => $search->title
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
    for($i = 0; $i < count($arr); $i++ ) {
      if ( $i == 0 ) {
        $title_case .= strtoupper($arr[$i]);
      } else {
        if ( ctype_upper($arr[$i]) ) {
          $title_case .= ' ' . $arr[$i];
        } else {
          $title_case .= $arr[$i];
        }
      }
    }

    return $title_case;
  }
}