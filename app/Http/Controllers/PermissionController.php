<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\ResponseFactory;
use Spatie\Permission\Models\Permission;
use Symfony\Component\HttpKernel\Event\ResponseEvent;

class PermissionController extends Controller
{
    public function index(string $id): View
    {
        $id = htmlspecialchars(trim(strval($id)));
        $listRole = Role::all();
        $listPermissions = Permission::orderBy('name', 'ASC')->get();
        $searchUser = User::findorFail($id);
        return view('autorisation.permission', [
            'attributionPermission' => $searchUser,
            'listRoles' => $listRole,
            'listPermissions' => $listPermissions,
        ]);
    }

    public function attribution_des_droits(Request $request)
    {
        // $role = DB::table('roles')->where('name', $request->nomRole)->first();
        // $model_role = DB::table('model_has_roles')->where('role_id', $role->id)->where('model_id', $request->user)->first();

        // $role_permission = DB::table('role_has_permissions')->where('role_id', $role->id)->get();
        // dd(DB::table('model_has_roles')->where('role_id', $request->nomRole)->where('model_id', $request->user)->first());

        // $role_has_permission = DB::table('role_has_permissions')->where('role_id', $role->id)->get();

        // if ($request->valueCheckBox == 1) {
        //     $user = User::findorFail($request->user);
        //     $user->assignRole($request->nomRole);
        //$user->revokeRoleTo($role);
        //     foreach ($role_permission as $value) {
        //         $model_permission_store = DB::table('model_has_permissions')->insert([
        //             'permission_id' => $value->permission_id,
        //             'model_type' => 'App\Models\User',
        //             'model_id' => $request->user,
        //         ]);
        //     }
        // } else {
        //     $user = User::findorFail($request->user);
        //     $user->removeRole($request->nomRole);
        //     foreach ($role_has_permission as $value) {
        //         $model_permission1 = DB::table('model_has_permissions')->where('model_id', $request->user)->where('permission_id', $value->permission_id)->first();
        //         $user->revokePermissionTo($model_permission1->permission_id);
        /* foreach ($model_permission1 as $value) {
                    $user->revokePermissionTo($value->permission_id);
                } */
        //     }
        // }

        // $data = [
        //     "success" => 1,
        // ];
        // return response()->json($data);
        // dd($request);
        $user = $request->user;
        /** @var User */
        $user = User::findorFail($user);
        $all_user_roles = $user->roles ?? null;

        if (is_array($request->index_slide_acceuil)) {
            for ($i = 0; $i < count($all_user_roles); $i++) {
                $user->removeRole($all_user_roles[$i]->name);
            }

            foreach ($request->index_slide_acceuil as $role) {
                $user->assignRole($role);
            }

            return back()->with('success', 'Rôles modifiés avec succès');
        }

        for ($i = 0; $i < count($all_user_roles); $i++) {
            $user->removeRole($all_user_roles[$i]->name);
        }
        return back()->with('success', 'Rôles modifiés avec succès');
    }

    public function attribution_des_permissions(Request $request)
    {
        $permission = Permission::where(
            'name',
            $request->nomPermission
        )->first();
        if ($request->valueCheckBox == 1) {
            $user = User::findorFail($request->user);
            $user->givePermissionTo($permission);
            //$user->revokeRoleTo($role);
        } else {
            $user = User::findorFail($request->user);
            $user->revokePermissionTo($permission);
        }

        $data = [
            'success' => 1,
        ];
        return response()->json($data);
    }

    public function attribution_des_permissions_all(Request $request)
    {
        if ($request->valueCheckBox == 1) {
            $user = User::findorFail($request->user);
            $all_permission = Permission::all();
            foreach ($all_permission as $value) {
                $user->givePermissionTo($value->name);
            }
            //$user->revokeRoleTo($role);
        } else {
            $user = User::findorFail($request->user);
            $all_permission = Permission::all();
            foreach ($all_permission as $value) {
                $user->revokePermissionTo($value->name);
            }
        }

        $data = [
            'success' => 1,
        ];
        return response()->json($data);
    }
}
