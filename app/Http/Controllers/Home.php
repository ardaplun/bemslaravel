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
        return view('pages/building', array('page' => 'detail_building', 'building'=> $building ));
    }

    public function detail_floor($id)
    {
      return view('detail_floor', array('page' => 'detail-floor'));
    }

    public function detail_room($id)
    {
        return view('detail_room', array('page' => 'detail-room'));
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
