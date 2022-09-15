<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Season;
class SeasonsController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $season = Season::all();

        return view('season\season-view',['seasons'=>$season]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('season\season-create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {

            Season::create([
                'name' => $request->name
                 ]);
     
            $msgretur  = 'Temporada Cadastrado com sucesso';
             return view('season\season-create',['msgadd'=> $msgretur]);
    
         } catch (\Throwable $th) {
          
            $msgreerr  = $th->getMessage();
    
            if(  strpos($msgreerr, '1062 Duplicate entry')){
                $msgreerr = 'Nome da temporada já está cadastrado na base de dados!';
            }
    
            return view('season\season-create',['msgreerr' =>$msgreerr]);
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function alter(Request $request){
        try {

            if(isset($_POST['salvarAlteracao'])){

            if($request->id > 0) {
              
              
                $season= Season::find($request->id);

                if($season != null ){

                     $season->update([
                         'name' => $request->time
                     ]);

                     $msgadd = 'Temporada('.$request->id . ' ' . $request->time . ') Alterada com sucesso!.';
                     $season = Season::all();
                     return view('season\season-view',['seasons'=>$season,'msgadd'=>$msgadd]);
                    };
               
            }
    
        }
            $season = Season::all();
            return view('season\season-view',['seasons'=>$season]);
    
        } catch (\Throwable $th) {

            $msgreerr  = $th->getMessage();

            if(  strpos($msgreerr, '1062 Duplicate entry')){
                $msgreerr = 'Nome da temporada já está cadastrada na base de dados!';
            }

            $season = Season::all();
            return view('season\season-view',['seasons'=>$season,'msgreerr'=>$msgreerr]);
        } 
    

    }

    public function delete(Request $request){
      
        try {
          
        
        if($request->id > 0) {
          
            $season= Season::find($request->id);
            if($season != null ){
                 $season->delete();
                 $msgadd = 'Temporada('.$request->id . ' ' . $request->time . ') Excluída com sucesso!.';
                 $season= Season::all();
                 return view('season\season-view',['seasons'=>$season,'msgadd'=>$msgadd]);
                };
           
        }

        $season = Season::all();
        return view('season\season-view',['seasons'=>$season]);

    } catch (\Throwable $th) {
        $season = Season::all();
        $msgreerr  = $th->getMessage();
        return view('season\season-view',['seasons'=>$season,'msgreerr'=>$msgreerr]);
    }     

  
    }

}
