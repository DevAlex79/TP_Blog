<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Article;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckAuthorRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    // public function handle(Request $request, Closure $next): Response
    // {
    //     return $next($request);
    // }
    public function handle($request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect()->route('articles.index');
        }

        if (Auth::user()->role->name !== 'auteur') {
            return redirect()->route('articles.show', Article::latest()->first()->id);
        }

        if ($request->route('article') && $request->route('article')->user_id !== Auth::id()) {
            return redirect()->route('articles.show', Article::latest()->first()->id);
        }

        return $next($request);
    }
}
