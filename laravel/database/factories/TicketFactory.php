<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Ticket;
use App\Models\Event;
use Faker\Generator as Faker;

$factory->define(Ticket::class, function (Faker $faker) {
    $event = factory(Event::class)->create();
    return [
        'event_id' => $event->id,
    ];
});
