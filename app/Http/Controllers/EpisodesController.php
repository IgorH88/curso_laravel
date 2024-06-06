<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Episode;
use App\Models\Season;
use Illuminate\Http\Request;

class EpisodesController extends Controller
{
    public function index(Season $season)
    {
        return view('episodes.index', [
            'episodes' => $season->episodes,
            'mensagemSucesso' => session('mensagem.sucesso')
        ]);
    }

    public function update(Request $request, Season $season)
    {
        $wathcedEpisodes = $request->episodes;
        $season->episodes->each(function (Episode $episode) use ($wathcedEpisodes){
            $episode->watched = in_array($episode->id, $wathcedEpisodes);
        });
        $season->push();

        return to_route('episodes.index', $season->id)->with('mensagem.sucesso','Episodios marcados como assistido!');
    }
}
