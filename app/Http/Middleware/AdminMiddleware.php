<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use Illuminate\Support\Facades\Validator;


use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() == false && Auth::user()->role != 'admin') {
            // return view('/', ['mess'=>'Для перехода на страницу необходимо зарегистрироваться!']);
            return back()->withErrors(['auth'=>'Вам не доступна эта страница!']); // Перенаправляем на страницу ошибки
        }

        // Если всё в порядке, передаём запрос дальше
        return $next($request);
    }
}
