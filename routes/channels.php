<?php

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
// 通知用頻道 依職稱分
    // 只傳給admin
Broadcast::channel('channel4', function ($user) {
    return $user->job_title_id >= 4;
});
    // 傳給admin和廠長
Broadcast::channel('channel3', function ($user) {
    return $user->job_title_id >= 3;
});
    // 傳給admin、廠長和業務
Broadcast::channel('channel2', function ($user) {
    return $user->job_title_id >= 2;
});
    // 傳給所有人(admin、廠長、業務和廠務)
Broadcast::channel('channel1', function ($user) {
    return $user->job_title_id >= 1;
});
