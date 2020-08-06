<?php

namespace App\Http\Middleware;

use App\Model\Admin\AdminRoles;
use Closure;
use Illuminate\Support\Facades\Auth;

class CheckPermissionAdmin
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
        $AdminRoles = new AdminRoles();
        $user = Auth::guard('admin')->user();
        $array_role_user = $AdminRoles->arrayRoleAdmin($user->id);
        if(count($array_role_user) > 0){
            foreach ($array_role_user as $id_role => $name_role) {
                if(strval($id_role) == ROLE_SUPER_ADMIN)
                    return $next($request);
            }
        }
        return redirect()->route('admin.home')
            ->with('error', 'Không có quyền truy cập');
    }
}
