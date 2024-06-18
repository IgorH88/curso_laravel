<?php

namespace App\Listeners;

use App\Events\SeriesCreated;
use App\Mail\SeriesEmail;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class EmailUsersAboutSeriesCreated
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(SeriesCreated $event)
    {
        $users = User::all();
        foreach($users as $index => $user){
            $email = new SeriesEmail (
                $event->serieNome,
                $event->serieId,
                $event->serieSeasonsQty,
                $event->serieEpisodesPerSeason,
            );
            $when = now()->addSecond($index * 5);
            Mail::to($user)->later($when, $email);
        }
    }
}
