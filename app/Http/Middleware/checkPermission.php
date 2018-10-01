<?php

namespace App\Http\Middleware;

use Session;
use Closure;
use App\Permission;
use App\Group;

class checkPermission
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
        $user = Session::get('user');

        if($user->group_id != 0) {

            $path = $request->route()->getName();
            $permission = Permission::where('allow', $path)->first();
            if(empty($permission)) return $next($request);

            $group = Group::find($user->group_id);
            if(empty($group)) return $next($request);

            $arr = explode(';', $group->permision);

            foreach($arr as $key=>$value) {
                if($value == $permission->id) return $next($request);
            }

            Session::flash('error', 'You do not have permission to access');
            return redirect('/');
        }

        return $next($request);
    }
}
