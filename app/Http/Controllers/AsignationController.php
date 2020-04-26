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

        foreach($asignation as $row)
        {
            $row->laptop;
        }

        echo json_encode($asignation);
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
        }
        else{
            echo "fail";
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Asignation  $asignation
     * @return \Illuminate\Http\Response
     */
    public function show(Asignation $asignation)
    {
        //
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
            'employee_number' => 'required',
            'employee' => 'required',
            'uid' => 'required',
            'laptop_id' => 'required',
        ]);

        if(!\App\Asignation::where('laptop_id', $request['laptop_id'])
                           ->where('id', '!=', $id)->exists())
        {
            $asignation = \App\Asignation::find($id);
            $asignation->employee_number = $request['employee_number'];
            $asignation->employee = $request['employee'];
            $asignation->uid = $request['uid'];
            $asignation->laptop_id = $request['laptop_id'];

            $asignations->save();

            echo \json_encode("success");
        }

        echo "fail";

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Asignation  $asignation
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $asignation = \App\Asignation::where('id', $id)->get()->each->delete();
    }
}
