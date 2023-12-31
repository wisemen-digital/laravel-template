<?php

use App\Http\Middleware\LanguageMiddleware;
use Illuminate\Foundation\Events\LocaleUpdated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Event;

it('uses the accept-language header', function (string $expectedLocale, string $header) {
    Event::fake();

    $request = Request::create('');
    $request->headers->set('Accept-Language', $header);

    $middleware = new LanguageMiddleware();
    $middleware->handle($request, function() {});

    Event::assertDispatched(LocaleUpdated::class, function(LocaleUpdated $event) use($expectedLocale) {
        return $event->locale === $expectedLocale;
    });
})->with([
    ['fr', 'fr-CH, fr;q=0.9, en;q=0.8, de;q=0.7, *;q=0.5'],
    ['en', 'en-US,en;q=0.9'],
    ['de', 'de-DE,de;q=0.8,en;q=0.6'],
    ['es', 'es-ES,es;q=0.8,en;q=0.6'],
    ['ja', 'ja-JP,ja;q=0.9'],
    ['it', 'it-IT,it;q=0.9,en;q=0.8'],
    ['pt', 'pt-BR,pt;q=0.9,en;q=0.8'],
    ['nl', 'nl'],
]);
