<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Computer;
use App\Client;

class ComputerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $computers = Computer::all();

        return response()->json($computers);
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
        $computer = new Computer();
        $computer->code = $request->code;
        $computer->spect = $request->spect;
        $computer->ip = $request->ip;
        $computer->last_check = $request->last_check;
        $computer->client_id = $request->client_id;

        if($computer->save()){
            return response()->json(["Status" => "Computer saved"], 200);
        }else{
            return response()->json(["Status" => "Computer not saved"], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $computer = Computer::find($id);
        if($computer){
            return response()->json(["Status" => "Ok", "data" => $computer], 200);
        }else{
            return response()->json(["Status" => "Computer not exists"], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $computer = Computer::find($id);

        if($computer){

            $computer->code = $request->code;
            $computer->spect = $request->spect;
            $computer->ip = $request->ip;
            $computer->last_check = $request->last_check;
            $computer->client_id = $request->client_id;
            
            if($computer->save()){
                return response()->json(["Status" => "Computer updated"], 200);
            }else{
                return response()->json(["Status" => "Computer not updated"], 500);
            }
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $computer = Computer::find($id);

        if($computer){
            if($computer->delete()){
                return response()->json(["Status" => "Ok"], 200);
            }else{
                return response()->json(["Status" => "No delete"], 500);
            }
        }else{
            return response()->json(["Status" => "Computer not exist"], 500);
        }
    }


    public function addComputerClient($computer_id,$client_id){

        $computer = Computer::find($computer_id);
        $client = Client::find($client_id);

        if($computer && $client){
            $computer->client_id = $client_id;
            
            if($computer->save()){
                return response()->json(["Status" => "Ok"], 200);
            }else{
            
                return response()->json(["Status" => "Error no Save"], 200);
            }
        
            }else{
                return response()->json(["Status" => "No content"], 204);
        }    
        
    }
}
