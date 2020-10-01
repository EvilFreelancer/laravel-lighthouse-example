<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Ticket;
use App\Models\Event;
use App\User;
use Faker\Generator as Faker;

$factory->define(Ticket::class, function (Faker $faker) {
    $event = factory(Event::class)->create();
    $user  = factory(User::class)->create();
    return [
        'event_id' => $event->id,
        'user_id'  => $user->id,
    ];
});
