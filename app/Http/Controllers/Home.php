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
        return view('home', array('page' => 'home'));
    }

    public function maps()
    {
        return view('maps', array('page' => 'maps'));
    }

    public function detail_building($id)
    {
        return view('detail_building', array('page' => 'detail_building'));
    }

    public function detail_floor($id)
    {
      return view('detail_floor', array('page' => 'detail_floor'));
    }

    public function detail_room($id)
    {
        return view('detail_room', array('page' => 'detail_room'));
    }

    public function about_us()
    {
        return view('about_us', array('page' => 'about_us'));
    }

    public function menu()
    {
        return view('menu', array('page' => 'menu'));
    }

    public function login()
    {
        return view('login', array('page' => 'login'));
    }
}
