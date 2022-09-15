<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function resumodashseasons(Request $request)
    {

        if ($request->idseasons > 0) {
            $matches = DB::table('vwresumodashseasons')->where('season_id', '=', $request->idseasons)->get();        }
        else {
            $matches = DB::table('vwresumodashseasons')->get();        }


        return $matches;

    }

    public function resumodashday(Request $request)
    {

        $datematchessp = explode("/", $request->dtmatche);
        $datematches = $datematchessp[2] . '-' . $datematchessp[1] . '-' . $datematchessp[0];

        $matches = DB::table('vwresumodashday')->where('data_partida', '=', $datematches)->get();
        return $matches;

    }
    public function partidaRealizadas(Request $request)
    {
        $matches = '';
        $sqlfill = '';
        $seasonnamea = $request->seasonname;

        if ($request->dtmatche != '') {
            $datematchessp = explode("/", $request->dtmatche);
            $datematches = $datematchessp[2] . '-' . $datematchessp[1] . '-' . $datematchessp[0];
        }

        if ($request->idseason > 0 && $request->dtmatche != '') {
            $matches = DB::table('vwresultados')->where('name_season', '=', $seasonnamea)->where('data_partida', '=', $request->dtmatche)->get();
        }
        else if ($request->idseason > 0 && $request->dtmatche == '') {
            $matches = DB::table('vwresultados')->where('name_season', '=', $seasonnamea)->get();
        }
        else if ($request->idseason == 0 && $request->dtmatche == '') {
            $matches = DB::table('vwresultados')->get();
        }
        else if ($request->idseason == 0 && $request->dtmatche != '') {
            $matches = DB::table('vwresultados')->where('data_partida', '=', $request->dtmatche)->get();
        }


        return $matches;
    }

}