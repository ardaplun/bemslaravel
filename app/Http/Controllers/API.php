<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class API extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($building)
    {

      $data = 'wow';
      return \Response::json(array(
            'error' => false,
            'data' => $data,
            'building' => $building,
            'status_code' => 200
        ));
    }



// API get data for webapp
    public function building()
    {
      $input = \Request::all();
      if(!empty($input))
      {
        $return = array(
          'error' => false,
          'data' => $input,
          'type' => 'building',
          'status_code' => 200);
      }else{
        $return = array(
        'error' => true);
      }
      return \Response::json($return);
    }

    public function floor()
    {
      $input = \Request::all();
      if(!empty($input))
      {
        $return = array(
          'error' => false,
          'data' => $input,
          'type' => 'floor',
          'status_code' => 200);
      }else{
        $return = array(
        'error' => true);
      }
      return \Response::json($return);
    }

    public function room()
    {
      $input = \Request::all();
      if(!empty($input))
      {
        $return = array(
          'error' => false,
          'data' => $input,
          'type' => 'room',
          'status_code' => 200);
      }else{
        $return = array(
        'error' => true);
      }
      return \Response::json($return);
    }

// API get data from sensor

    public function power()
    {
      $input = \Request::all();
      if(!empty($input))
      {
        
        $return = array(
          'error' => false,
          'data' => $input,
          'type' => 'power',
          'status_code' => 200);
      }else{
        $return = array(
        'error' => true);
      }
      return \Response::json($return);
    }

    public function sensor()
    {
      $input = \Request::all();
      if(!empty($input))
      {
        $return = array(
          'error' => false,
          'data' => $input,
          'type' => 'sensor',
          'status_code' => 200);
      }else{
        $return = array(
        'error' => true);
      }
      return \Response::json($return);
    }
}
