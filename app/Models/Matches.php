<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matches extends Model
{
    protected $fillable = [
        'team_id_a',
        'team_id_b',
        'user_id',
        'season_id',
        'resultado_a',
        'resultado_b',
        'data_partida',
        'id_team_winner'
    ];
}