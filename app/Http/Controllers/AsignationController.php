<?php

namespace App\Http\Controllers;

use App\Asignation;
use Illuminate\Http\Request;

class AsignationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $asignations = \App\Asignation::all();

        foreach($asignations as $row)
        {
            $row->laptop;
        }

        echo json_encode($asignations);
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
            'employee_number' => 'required',
            'employee' => 'required',
            'uid' => 'required',
            'laptop_id' => 'required',
        ]);

        if(!\App\Asignation::where('laptop_id', $request['laptop_id'])->exists())
        {
            $asignation = new \App\Asignation;
            $asignation->employee_number = $request['employee_number'];
            $asignation->employee = $request['employee'];
            $asignation->uid = $request['uid'];
            $asignation->laptop_id = $request['laptop_id'];

            $asignation->user_id = \Auth::user()->id;

            $asignation->save();

            $response = Array(
                'status' => 200,
                'data' => $asignation
            );

            echo json_encode($response);
        }
        else{
            $response = Array(
                'status' => 500,
                'message' => "El registro ya existe"
            );

            echo json_encode($response);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Asignation  $asignation
     * @return \Illuminate\Http\Response
     */
    public function show($asset)
    {
        
        $asignation = \App\Asignation::with('user')
        ->with('laptop')->whereHas('laptop', function ($query) use ($asset){
            $query->where('asset', $asset);
        })->get();
        
        if(!$asignation->isEmpty()){

            $response = Array(
                "status" => "200",
                "data" => $asignation
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
     * @param  \App\Asignation  $asignation
     * @return \Illuminate\Http\Response
     */
    public function edit(Asignation $asignation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Asignation  $asignation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'employee' => 'required',
            'uid' => 'required',
            'laptop_asset' => 'required',
        ]);

        $laptopId = \App\Laptop::where('asset', $request->laptop_asset)->pluck('id');
       
        if(!$laptopId->isEmpty())
        {
            
            if(!\App\Asignation::where('laptop_id', $laptopId)
            ->where('id', '!=', $id)->exists())
            {
                $asignation = \App\Asignation::find($id);
                $asignation->employee = $request['employee'];
                $asignation->uid = $request['uid'];
                $asignation->laptop_id = $laptopId;
                
                $asignation->save();
               
                $response = Array(
                    "status" => 200,
                    "data" => $asignation
                );

                echo \json_encode($response);
            }
            else{

                $response = Array(
                    "status" => 500,
                    "message" => 'La laptop ya está siendo ocupada'
                );

                echo \json_encode($response);

            }
        }
        else{
            $response = Array(
                "status" => 404,
                "message" => 'No hay laptop con ese id'
            );

            echo \json_encode($response);
        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Asignation  $asignation
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $asignation = \App\Asignation::where('id', $id)->get()->each->delete();
            $response = Array(
                "status" => 200,
            );
            echo json_encode($response);

        }catch(Error $error){
            
            $response = Array(
                "status" => 500,
            );
            echo json_encode($response);
        }

    }
}
