<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Team;

class TeamController extends Controller
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

        $teams = Team::all();

        return view('team\team-view',['teams'=>$teams]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
             return view('team\team-create');
    }

    public function alter(Request $request){
        try {
            
            if(isset($_POST['salvarAlteracao'])){

            if($request->id > 0) {
              
              
                $team = Team::find($request->id);

                if($team != null ){

                     $team->update([
                         'user' => $request->jogador
                     ]);

                     $msgadd = 'Time('.$request->id . ' ' . $request->time . ') Alterado com sucesso!.';
                     $teams = Team::all();
                     return view('team\team-view',['teams'=>$teams,'msgadd'=>$msgadd]);
                    };
               
            }
    
        }
            $teams = Team::all();
            return view('team\team-view',['teams'=>$teams]);
    
        } catch (\Throwable $th) {
            $teams = Team::all();
            $msgreerr  = $th->getMessage();
            return view('team\team-view',['teams'=>$teams,'msgreerr'=>$msgreerr]);
        } 
    

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

        Team::create([
            'name' => $request->name,
             'user' => $request->userteam
        ]);
 
        $msgretur  = 'Time Cadastrado com sucesso';
         return view('team\team-create',['msgadd'=> $msgretur]);

     } catch (\Throwable $th) {
      
        $msgreerr  = $th->getMessage();

        if(  strpos($msgreerr, '1062 Duplicate entry')){
            $msgreerr = 'Nome do time e ou usuário já está cadastrado na base de dados!';
        }

        return view('team\team-create',['msgreerr' =>$msgreerr]);
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
        return view('team\team-view');
    }

   

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $teams = Team::findOrFail($id);

        return view('team\team-edit',['teams'=>$teams]);

    
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
        
    }

    public function delete(Request $request){
      
        try {
          
        
        if($request->id > 0) {
          
            $team = Team::find($request->id);
            if($team != null ){
                 $team->delete();
                 $msgadd = 'Time('.$request->id . ' ' . $request->time . ') Excluído com sucesso!.';
                 $teams = Team::all();
                 return view('team\team-view',['teams'=>$teams,'msgadd'=>$msgadd]);
                };
           
        }

        $teams = Team::all();
        return view('team\team-view',['teams'=>$teams]);

    } catch (\Throwable $th) {
        $teams = Team::all();
        $msgreerr  = $th->getMessage();
        return view('team\team-view',['teams'=>$teams,'msgreerr'=>$msgreerr]);
    }     

  
    }
}
