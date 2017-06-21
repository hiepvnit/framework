<?php
namespace Mage2\Framework\System\Middleware;

use Closure;
use Mage2\Framework\Search\Facades\Search;
use Illuminate\Support\Facades\Storage;

class PageIndexer
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



        //todo check in middleware
        $installFile = Storage::disk('local')->get('installed.txt');
        if('.installed' != $installFile) {

            return redirect()->to('/install');
        }
        //Search::indexed();
        return $next($request);
    }
}
