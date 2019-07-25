<?php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;

class Language
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
      if(session('applocale')){
        $configLanguage = config('languages')[session('applocale')];
        setLocale(LC_TIME, $configLanguage[1] . '.utf8');
        Carbon::setLocale(session('applocale'));
        App::setLocale(session('applocale'));
      }else{
        session()-> put('applocale', config('app.fallback_locale'));
        setLocale(LC_TIME, 'es_ES.utf8');
        Carbon::setLocale(session('applocale'));
        App::setLocale(session('applocale'));
      }
      return $next($request);
    }
}
