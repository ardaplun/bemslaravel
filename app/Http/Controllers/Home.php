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
        return view('pages/home', array('page' => 'home'));
    }

    public function detail_building($building)
    {
        $data_floor = \DB::table('data_floor')->where('id_building',$building)->get();
        if ($data_floor==NULL) {
          return view('errors/404');
        }else{
          return view('pages/building', array('page' => 'detail-building', 'building'=> $building, 'data_floors'=>$data_floor ));
        }

    }

    public function detail_floor($building, $floor)
    {
      $data = \DB::table('data_floor')->where(['id_building'=>$building, 'id_floor'=>$floor])->first();
      if ($data==NULL) {
        return view('errors/404');
      }else{
        return view('pages/detail_floor', array('page' => 'detail-floor', 'building' => $building, 'floor' => $floor, 'data'=>$data));
      }

    }

    public function detail_room($building, $floor, $room)
    {
        $data = \DB::table('data_room')->where(['id_building'=>$building, 'id_floor'=>$floor, 'id_room'=>$room])->first();
        $data_site = \DB::table('data_floor')->leftJoin('data_room', 'data_floor.id_floor', '=', 'data_room.id_floor')->get();

        if ($data==NULL) {
          return view('errors/404');
        }else{
          return view('pages/detail_room', array('page' => 'detail-room', 'building' => $building, 'floor' => $floor, 'room' => $room, 'data'=>$data, 'data_site'=>$data_site));
        }

    }

    public function login()
    {
        return view('admins/login', array('page' => 'login'));
    }
}
