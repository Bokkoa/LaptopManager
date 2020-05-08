<?php

namespace App\Http\Controllers;

use App\Laptop;
use Illuminate\Http\Request;

class LaptopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {  
            $laptops = \App\Laptop::All();
            echo json_encode($laptops);
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
        $request->validate([
            'owner' => 'required',
            'asset' => 'required',
        ]);

        if(!\App\Laptop::where('asset', $request['asset'])->exists())
        { 
            $lap = new \App\Laptop;
            $lap->asset = $request['asset'];
            $lap->owner = $request['owner'];
            $lap->creation_user = \Auth::user()->name;
            $lap->created_at = date('Y-m-d');
            $lap->save();
        }
        else
        {
            echo "fail";
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Laptop  $laptop
     * @return \Illuminate\Http\Response
     */
    public function show(Laptop $laptop)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Laptop  $laptop
     * @return \Illuminate\Http\Response
     */
    public function edit(Laptop $laptop)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Laptop  $laptop
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'owner' => 'required',
            'asset' => 'required',
        ]);

        if(!\App\Laptop::where('asset', $request['asset'])
                       ->where('id', '!=', $id)->exists())
        {
            $laptop = \App\Laptop::find($id);

            $laptop->owner = $request['owner'];
            $laptop->asset = $request['asset'];

            $laptop->save();

            echo \json_encode("success");
        }

        echo "fail";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Laptop  $laptop
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $laptop = \App\Laptop::Find($id);
        $laptop->delete();
        echo \json_encode("success");
    }
}