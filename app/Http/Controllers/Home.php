<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class Home extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages/maps', array('page' => 'maps'));
    }
    public function overview($building)
    {
        return view('pages/overview', array('page' => 'overview', 'building'=> $building));
    }

    public function loadprofile()
    {
        $building = \DB::table('data_building')->get();
        return view('pages/load-profile', array('page' => 'load-profile', 'data_buildings'=>$building));
    }

    public function detail_building($building)
    {
        $data_floor = \DB::table('data_floor')->orderBy('id_floor', 'asc')->where('id_building',$building)->get();
        if ($data_floor==NULL) {
          return view('errors/404');
        }else{
          return view('pages/building', array('page' => 'detail-building', 'building'=> $building, 'data_floors'=>$data_floor ));
        }
    }

    public function detail_floor($building, $floor)
    {
      $data = \DB::table('data_floor')->where(['id_building'=>$building, 'id_floor'=>$floor])->first();
      $data_pin = \DB::table('data_room')->where(['id_building'=>$building, 'id_floor'=>$floor])->get();
      if ($data==NULL) {
        return view('errors/404');
      }else{
        return view('pages/detail_floor', array('page' => 'detail-floor', 'data'=>$data,'data_pin'=>$data_pin));
      }
    }

    public function detail_room($building, $floor, $room)
    {
        $data = \DB::table('data_room')->where(['id_building'=>$building, 'id_floor'=>$floor, 'id_room'=>$room])->first();
        $data_site = \DB::table('data_floor')->leftJoin('data_room', 'data_floor.id_floor', '=', 'data_room.id_floor')->get();
        $data_device = \DB::table('data_device')->where(['id_room'=>$room])->get();

        if ($data==NULL) {
          return view('errors/404');
        }else{
          return view('pages/detail_room', array('page' => 'detail-room', 'data'=>$data, 'data_site'=>$data_site, 'data_device'=>$data_device));
        }
    }

    public function login()
    {
        return view('admins/login', array('page' => 'login'));
    }
}
