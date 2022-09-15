<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Season;
use App\Models\Team;
use App\Models\User;

class CreateMatchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matches', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Season::class)->constrained();
            $table->foreignId('team_id_a')->constrained('teams');
            $table->foreignId('team_id_b')->constrained('teams');
            $table->foreignIdFor(User::class)->constrained();
            $table->integer('resultado_a');
            $table->integer('resultado_b');
            $table->date('data_partida');
            $table->integer('id_team_winner');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('matches');
    }
}