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
        return 'maps';
    }

    public function detail_building($id)
    {
        return "$id building";
    }

    public function detail_floor($id)
    {
        return "floor $id";
    }

    public function detail_room($id)
    {
        return "room $id";
    }

}
