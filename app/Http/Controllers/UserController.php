<?php

namespace App\Http\Controllers;

use App\Models\Pack;
use App\Models\User;
use App\Models\Paquet;
use App\Models\Operation;
use App\Models\Inventaire;
use App\Models\Operations;
use App\Models\Suggestion;
use App\Mail\UserResetMail;
use Illuminate\Http\Request;
use App\Mail\ResetPasswordMail;
// use App\Models\Suggestion;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Models\ConnexionHistorique;
use App\Models\Coupon;
use App\Models\Deliver;
use App\Models\Delivery;
use App\Models\Order;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\RedirectResponse;
use Spatie\Permission\Models\Permission;

class UserController extends Controller
{
    public function usersList(): View
    {
        $user = User::where('email', Auth::user()->email ?? null)->first();
        if (!$user instanceof User) {
            abort(404);
        }
        if (Auth::user() instanceof User) {
            if (Auth::user()->hasRole('ADMINISTRATEUR')) {
                $breadcrumbs = [
                    ['link' => "modern", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "User"], ['name' => "Users List"]
                ];
                //Pageheader set true for breadcrumbs
                $pageConfigs = ['pageHeader' => true, 'isFabButton' => true];
                $users = User::orderBy('name', 'ASC')->get();
                $user = Auth::user();
                if (!$user instanceof User) {
                    abort(401);
                }

                return view('pages.page-users-list', [
                    'users' => $users,
                    'user' => $user,
                    'pageConfigs' => $pageConfigs,
                    'breadcrumbs' => $breadcrumbs
                ]);
            }
        }
        \abort(401);
    }

    public function usersView(string $id): View
    {
        $id = htmlspecialchars(trim(strval($id)));
        $breadcrumbs = [
            ['link' => "modern", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "User"], ['name' => "Users View"]
        ];
        $pageConfigs = ['pageHeader' => true, 'isFabButton' => true];
        $usr = User::find($id);
        if (!$usr instanceof User) {
            \abort(404);
        }
        $user = Auth::user();
        $users = User::all();
        return view('pages.page-users-view', [
            'usr' => $usr,
            'user' => $user,
            'users' => $users,
            'pageConfigs' => $pageConfigs,
            'breadcrumbs' => $breadcrumbs,
        ]);
    }

    public function usersEdit(string $id): View
    {
        $id = htmlspecialchars(trim(strval($id)));
        $breadcrumbs = [
            ['link' => "modern", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "User"], ['name' => "Users Edit"]
        ];
        $pageConfigs = ['pageHeader' => true, 'isFabButton' => true];
        $usr = User::find($id);
        if (!$usr instanceof User) {
            \abort(404);
        }
        $user = Auth::user();
        if (!$user instanceof User) {
            \abort(404);
        }
        $permissions = Permission::all();
        $roles = Role::all();
        $users = User::all();
        return view('pages.page-users-edit', [
            'usr' => $usr,
            'user' => $user,
            'users' => $users,
            'roles' => $roles,
            'permissions' => $permissions,
            'pageConfigs' => $pageConfigs,
            'breadcrumbs' => $breadcrumbs
        ]);
    }

    public function user_update(Request $request, string $id): RedirectResponse
    {
        $id = htmlspecialchars(trim(strval($id)));
        if ($request->checkboxlivreur == '1') {
            $livreur = true;
        } else {
            $livreur = false;
        }

        $request->validate(User::VALIDATION_UPDATE);
        /** @var User  */
        $user = User::find($id);

        // dd(Auth::user()== $user OR Auth::user()->hasRole('Admin'));
        if (!Auth::user() instanceof User) {
            \abort(404);
        }
        if (!$user instanceof User) {
            \abort(404);
        }

        $pattern = 'topfood.com';
        $email = $request->email;
        $emailPattern = explode("@", $email)[1];
        if (Auth::user() == $user || Auth::user()->hasRole('ADMINISTRATEUR')) {
            if ($emailPattern === $pattern) {

                $user->name = strtoupper(htmlspecialchars(trim(strval($request['nom']))));
                $user->firstname = ucfirst(htmlspecialchars(trim(strval($request['prenom']))));
                $user->email = strval($request['email']);
                $user->phone = strval($request['phone']);
                // $user->deliver = $livreur;
                $user->save();

                if (Auth::user()->hasRole('ADMINISTRATEUR')) {
                    return redirect()->route('user.list')->with('success', " Modification éffectuée avec succes");
                } else {
                    return redirect()->route('user.profil')->with('success', " Modification éffectuée avec succes");
                }
            } else {
                return back()->with('error', 'Adresse email invalide');
            }
        }
        return back()->with('error', "Vous n'avez pas l'autorisation de modifier les informations de cet utlisateur !");

        // }
    }

    public function lockAccount(string $id): RedirectResponse
    {
        $id = htmlspecialchars(trim(strval($id)));
        /** @var User */
        $user = User::find($id);
        if (Auth::user() == $user) {
            return back()->with('error', 'Action impossible');
        }
        if (Auth::user() instanceof User) {
            if (Auth::user()->hasRole('ADMINISTRATEUR')) {
                $user->status = false;
                $user->save();

                return redirect()->route('user.list')->with('success', " Compte bloqué avec succès");
            }
            abort(404);
        }

        return back()->with('error', "Vous n'avez pas l'autorisation de bloquer cet utlisateur !");
    }

    public function unlockAccount(string $id): RedirectResponse
    {
        $id = htmlspecialchars(trim(strval($id)));
        /** @var User */
        $user = User::find($id);
        if (Auth::user() == $user) {
            return back()->with('error', 'Action impossible');
        }
        if (Auth::user() instanceof User) {
            if (Auth::user()->hasRole('ADMINISTRATEUR')) {
                $user->status = true;
                $user->save();

                return redirect()->route('user.list')->with('success', " Compte débloqué avec succès");
            }
            \abort(404);
        }

        return back()->with('error', "Vous n'avez pas l'autorisation de débloquer cet utlisateur !");
    }

    public function showAllPermissionAndRoles(): View
    {
        $permissions = Permission::all();
        $roles = Role::all();
        $user = Auth::user();
        $users = User::all();



        return view('pages.permissions_et_roles', [
            'roles' => $roles,
            'permissions' => $permissions,
            'user' => $user,
            'users' => $users,
        ]);
    }

    // public function AllConnexion() : View
    // {
    //     /** @var User */
    //     $user = User::where('email', Auth::user()->email ?? null)->first();
    //     if(!$user instanceof User){
    //         abort(404);
    //     }
    //     if ($user->roles[0]->name == 'ADMINISTRATEUR') {
    //         $breadcrumbs = [
    //             ['link' => "modern", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "User"], ['name' => "Users List"]
    //         ];
    //         //Pageheader set true for breadcrumbs
    //         $pageConfigs = ['pageHeader' => true, 'isFabButton' => true];
    //         $user = Auth::user();
    //         $historiques = ConnexionHistorique::all()->sortByDesc('created_at');


    //         return view('pages.historiques-connexion', [
    //             'historiques' => $historiques,
    //             'user' => $user,
    //             'pageConfigs' => $pageConfigs,
    //             'breadcrumbs' => $breadcrumbs
    //         ]);
    //     }
    //     return back()->with('error', "Vous n'êtes pas administrateur !");
    // }

    public function assignRole(Request $request): RedirectResponse
    {

        if (Auth::user()->hasRole('ADMINISTRATEUR')) {
            $role = Role::where('id', '=', $request->role)->first();
            // $rolenane = $role['name'];
            $user = User::where('id', '=', $request->user)->first();
            if (!$user instanceof User && !$role instanceof Role) {
                \abort(404);
            }

            if ($user->hasRole($role)) {
                return back()->with([
                    'error' => " Cet utilisateur a déjà ce rôle !",
                ]);
            }

            $user->assignRole($role);
            return back()->with('success', 'Role asssigné avec succes !');
        }
        return back()->with('error', 'Opération échouée !');
    }

    // public function assignPermissions(Request $request)
    // {
    //     if (Auth::user()->hasRole('ADMINISTRATEUR')) {
    //         $permission = Permission::where('id', '=', $request->permission)->first();
    //         $user = User::where('id', '=', $request->user)->first();

    //         foreach ($user->roles as $key => $value) {
    //             $rolehaspermission = DB::table('role_has_permissions')->where('role_id', $value->id)->where('permission_id', $request->permission)->first();
    //             if (!blank($rolehaspermission)) {
    //                 return back()->with([
    //                     'error' => " Cet utilisateur a déjà cette permission !",
    //                 ]);
    //             }
    //         }

    //         $user->givePermissionTo($permission);

    //         return back()->with('success', 'Permission asssignée avec succes !');
    //     }
    //     return back()->with('error', 'Opération échouée !');
    // }

    // public function revokePermissions(Request $request)
    // {
    //     // dd($request);
    //     if (Auth::user()->hasRole('ADMINISTRATEUR')) {
    //         $permission = Permission::where('id', '=', $request->permission)->first();
    //         $user = User::where('id', '=', $request->user)->first();

    //         if (!$user->hasPermission($permission)) {
    //             return back()->with([
    //                 'error' => " Cet utilisateur n'a pas cette permission !",
    //             ]);
    //         }

    //         $user->revokePermissionTo($permission);

    //         return back()->with('success', 'Permission revoquée avec succes !');
    //     }
    //     return back()->with('error', 'Opération échouée !');
    // }


    // public function revokeRole(Request $request)
    // {
    //     // dd($request);
    //     if (Auth::user()->hasRole('ADMINISTRATEUR')) {
    //         $role = Role::where('id', '=', $request->role)->first();
    //         $user = User::where('id', '=', $request->user)->first();

    //         if (!$user->hasRole($role)) {
    //             return back()->with([
    //                 'error' => " Cet utilisateur n'a pas ce rôle !",
    //             ]);
    //         }

    //         $user->revokeRoleTo($role);

    //         return back()->with('success', 'Rôle révoqué avec succes !');
    //     }
    //     return back()->with('error', 'Opération échouée !');
    // }

    // public function permission_to_role(Request $request)
    // {
    //     if (Auth::user()->hasRole('ADMINISTRATEUR')) {
    //         $permission = Permission::where('id', '=', $request->permission)->first();
    //         $role = Role::where('id', '=', $request->role)->first();
    //         $role->givePermissionTo($permission);

    //         return back()->with('success', 'Permission donnée avec succes !');
    //     }
    //     return back()->with('error', 'Opération échouée !');
    // }

    public function update_image(Request $request): RedirectResponse
    {
        // dd($request);
        if (Auth::check()) {
            /** @var User */

            $user = Auth::user();
            $file = strval($request->file('image'));
            $filename = now() . $file->getClientOriginalName();
            $file->move(public_path('image'), $filename);
            $user['image'] = $filename;
            $user->save();
            return back()->with('success', " Photo de profil mise à jour avec succès ! ");
        }
        return back()->with('error', 'Mise à jour échouée !');
    }

    public function delete_profil_image(Request $request): RedirectResponse
    {

        if (Auth::check()) {
            /** @var User */
            $user = Auth::user();
            $user['image'] = NULL;
            $user->save();
            return back()->with('success', " Photo de profil supprimée avec succès ! ");
        }
        return back()->with('error', 'Mise à jour échouée !');
    }


    public function destroy(string $id): RedirectResponse
    {
        try {
            $id = htmlspecialchars(trim(strval($id)));
            /** @var User */
            $usr = User::where('id', $id)->first();
            if (!blank($usr)) {
                # code...
                $auth = Auth::user()->id ?? null;
                $auth1 = (bool) Suggestion::where('created_by', $usr->id)->exists();
                $auth2 = (bool) Paquet::where('created_by', $usr->id)->exists();
                $auth3 = (bool) Order::where('created_by', $usr->id)->exists();
                $auth4 = (bool) Coupon::where('created_by', $usr->id)->exists();
                $auth5 = (bool) Delivery::where('delivery_id', $usr->id)->exists();
                if ($auth == $id) {
                    $message = "Impossible de faire cette action : Vous êtes connecté !";
                    return redirect()->route('user.list')->with('error', "$message");
                } else {
                    if ($auth1 || $auth2 || $auth3 || $auth4) {
                        return redirect()->route('user.list')->with('error', "Ce utolisateur a déjà effectué une opération !");
                    } else {
                        return back()->with('success', 'Utilis&teur supprimé');
                    }
                }
            } else {
                $message = "Erreur d'ID !";
                return redirect()->route('user.list')->with('error', "$message");
            }
        } catch (\Throwable $th) {
            $message = "Erreur, veuillez contacter l'administrateur !";
            return redirect()->route('user.list')->with('error', "$message");
        }
    }
}
