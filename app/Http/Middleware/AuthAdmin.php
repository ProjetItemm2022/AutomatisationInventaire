<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use App\Models\Privilege;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class AuthAdmin
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
        if (!Auth::check()){
            return redirect('login');
        }
        $id = Auth::id();
    //Recuperer l'id du privilige
        $idPrivilege = User::where('id',$id)->value('privilege_id');
    //Recuperer la valeur du privilege
        $privilege  = Privilege::where('id',$idPrivilege)->value('nom');

        if ($privilege == 'Administrateur'){
            return $next($request);
        }
        else{
            abort(401);
        }
    }
}
