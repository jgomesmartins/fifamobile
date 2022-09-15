<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Team;
use App\Models\Season;
use App\Models\Matches;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MatchesController extends Controller
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
    //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $teams = Team::all();
        $seasons = Season::all();


        return view('matches\matches-create', ['teams' => $teams, 'seasons' => $seasons]);
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

            if ($request->golteam_a > $request->golteam_b) {
                $idteamwinner = $request->SelectTeamA;
            }
            else if ($request->golteam_a < $request->golteam_b) {
                $idteamwinner = $request->SelectTeamB;
            }
            else {
                $idteamwinner = 0;
            }

            $dateformatex = explode('/', $request->dataSeason);
            $dateformat = $dateformatex[2] . '-' . $dateformatex[1] . '-' . $dateformatex[0];
            $seasonsrequest = array(
                'team_id_a' => $request->SelectTeamA,
                'team_id_b' => $request->SelectTeamB,
                'user_id' => Auth::user()->id,
                'season_id' => $request->SelectSeason,
                'resultado_a' => $request->golteam_a,
                'resultado_b' => $request->golteam_b,
                'data_partida' => $dateformat,
                'id_team_winner' => $idteamwinner
            );


            Matches::create([
                'team_id_a' => $request->SelectTeamA,
                'team_id_b' => $request->SelectTeamB,
                'user_id' => Auth::user()->id,
                'season_id' => $request->SelectSeason,
                'resultado_a' => $request->golteam_a,
                'resultado_b' => $request->golteam_b,
                'data_partida' => $dateformat,
                'id_team_winner' => $idteamwinner
            ]);


            $matches = DB::table('vwresultados')->where('data_partida', '=', $request->dataSeason)
                ->where('id_season', '=', $request->SelectSeason)->get();

            $resumo = DB::table('vwresumodiatemporada')->where('data_partida', '=', $dateformat)
                ->where('season_id', '=', $request->SelectSeason)->orderBy('qtd_winner', 'desc')->get();

            $totalempates = DB::table('vwtotalempates')->where('data_partida', '=', $dateformat)
                ->where('season_id', '=', $request->SelectSeason)->get();

            $request->session()->flash('matches', $matches);
            $request->session()->flash('seasonsrequest', $seasonsrequest);
            $request->session()->flash('resumorequest', $resumo);
            $request->session()->flash('totalempates', $totalempates);
            $request->session()->flash('message', 'Resultado da partida adicionado com sucesso!.');
            $url = $request->get('redirect_to', route('create_matches'));
            return redirect()->to($url);

        }
        catch (\Throwable $th) {

            $msgreerr = $th->getMessage();
            $request->session()->flash('message_err', $msgreerr);
            $url = $request->get('redirect_to', route('create_matches'));
            return redirect()->to($url);

        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delmatches(Request $request)
    {

        try {

            $matchesdell = Matches::find($request->idSeason);
            $matchesdell->delete();

            return array('iderr' => 0, 'msgErr' => 'Partida excluída com sucesso!.');
        }
        catch (\Throwable $th) {
            $msgreerr = $th->getMessage();
            return array('iderr' => 1, 'msgErr' => $msgreerr);
        }


    }

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

    public function dashboard()
    {
        $seasons = Season::all();
        return view('matches\matches-dashboard');
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
    public function destroy(Request $request)
    {

        try {


            $matchesdell = Matches::find($request->idSeason);
            $matchesdell->delete();

            if ($request->golteam_a > $request->golteam_b) {
                $idteamwinner = $request->SelectTeamA;
            }
            else if ($request->golteam_a < $request->golteam_b) {
                $idteamwinner = $request->SelectTeamB;
            }
            else {
                $idteamwinner = 0;
            }

            $dateformatex = explode('/', $request->DataSeason);
            $dateformat = $dateformatex[2] . '-' . $dateformatex[1] . '-' . $dateformatex[0];
            $seasonsrequest = array(
                'team_id_a' => 0,
                'team_id_b' => 0,
                'user_id' => Auth::user()->id,
                'season_id' => 0,
                'resultado_a' => '',
                'resultado_b' => '',
                'data_partida' => $dateformat,
                'id_team_winner' => 0
            );


            $dateformatex = explode('/', $request->DataSeason);
            $dateformat = $dateformatex[2] . '-' . $dateformatex[1] . '-' . $dateformatex[0];

            $matches = DB::table('vwresultados')->where('data_partida', '=', $request->DataSeason)
                ->where('name_season', '=', $request->nameSeason)->get();
            $resumo = DB::table('vwresumodiatemporada')->where('data_partida', '=', $dateformat)
                ->where('name_season', '=', $request->nameSeason)->orderBy('qtd_winner', 'desc')->get();
            $totalempates = DB::table('vwtotalempates')->where('data_partida', '=', $dateformat)
                ->where('name_season', '=', $request->nameSeason)->get();

            $request->session()->flash('matches', $matches);

            if (count($resumo) > 0) {
                $request->session()->flash('resumorequest', $resumo);
            }

            if (count($totalempates) > 0) {
                $request->session()->flash('totalempates', $totalempates);
            }
            $request->session()->flash('message', 'Resultado da partida excluido com sucesso!.');
            $url = $request->get('redirect_to', route('create_matches'));
            return redirect()->to($url);

        }
        catch (\Throwable $th) {

            $msgreerr = $th->getMessage();
            $request->session()->flash('message_err', $msgreerr);
            $url = $request->get('redirect_to', route('create_matches'));
            return redirect()->to($url);

        }
    }
}