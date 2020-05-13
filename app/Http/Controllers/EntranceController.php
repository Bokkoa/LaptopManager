<?php

namespace App\Http\Controllers;

use App\Entrance;
use Illuminate\Http\Request;

class EntranceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $entrances = \App\Entrance::all();
        echo json_encode($entrances);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!\App\Entrance::where('hostname', $request['asset'])->exists())
        {
            $entrance = new \App\Entrance;
            $entrance->name = $request['name'];
            $entrance->location = $request['location'];
            $entrance->hostname = $request['asset'];
            $entrance->save();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Entrance  $entrance
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $entrance = \App\Entrance::find($id);
        
        if(!empty($entrance)){

            $response = Array(
                "status" => "200",
                "data" => $entrance
            );

            echo \json_encode($response);

        }else{
            $response = Array(
                "status" => "404",
                "message" => "No se encontró el registro"
            );

            echo \json_encode($response);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Entrance  $entrance
     * @return \Illuminate\Http\Response
     */
    public function edit(Entrance $entrance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Entrance  $entrance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $entrance = \App\Entrance::where('id', $request['id'])->first();
        $entrance->name = $request['name'];
        $entrance->hostname = $request['asset'];
        $entrance->location = $request['location'];
        $entrance->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Entrance  $entrance
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $entrance = \App\Entrance::where('id', $id)->get()->each->delete();
    }
}
