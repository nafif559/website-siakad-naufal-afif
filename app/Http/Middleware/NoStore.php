<?php
/*
Nama            : Naufal Afif
NIM             : 3202416082
Kelas           : 5C-TIF
Nama file       : NoStore.php
Tanggal buat    : 2-11-2026
*/
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class NoStore
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        $response->headers->set('Cache-Control', 'no-store');

        return $response;
    }
}
