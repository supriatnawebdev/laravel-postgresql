<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PemilikComment
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $id_user = Auth::user()->id;
        $comment = Comment::find($request->id);

        if (!$comment){
            return response()->json([
                'message' => 'data not found',
                'error' => true
            ], 404);
        }
        else  if($comment->user_id !== $id_user){
            return response()->json([
                'message' => 'tidak dapat edit, bukan comment anda!',
                'error' => true
            ], 404);
        }
      
        return $next($request);
    }
}
