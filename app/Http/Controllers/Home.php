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

    public function maps()
    {
        return view('pages/maps', array('page' => 'maps'));
    }

    public function detail_building($building)
    {
        $data_floor = \DB::table('data_floor')->where('id_building',$building)->get();
        return view('pages/building', array('page' => 'detail-building', 'building'=> $building, 'data_floors'=>$data_floor ));
    }

    public function detail_floor($building, $floor)
    {
      $data = \DB::table('data_floor')->where(['id_building'=>$building, 'id_floor'=>$floor])->first();
      return view('pages/detail_floor', array('page' => 'detail-floor', 'building' => $building, 'floor' => $floor, 'data'=>$data));
    }

    public function detail_room($building, $floor, $room)
    {
        $data = \DB::table('data_room')->where(['id_building'=>$building, 'id_floor'=>$floor, 'id_room'=>$room])->first();
        return view('pages/detail_room', array('page' => 'detail-room', 'building' => $building, 'floor' => $floor, 'room' => $room, 'data'=>$data));
    }

    public function about_us()
    {
        return view('pages/about_us', array('page' => 'about-us'));
    }

    public function menu()
    {
        return view('menu', array('page' => 'menu'));
    }

    public function login()
    {
        return view('admins/login', array('page' => 'login'));
    }
}
