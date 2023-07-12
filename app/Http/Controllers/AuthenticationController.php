<?php

namespace App\Http\Controllers;

use Throwable;
use App\Models\User;
use App\Mail\RegisterMail;
use App\Mail\UserResetMail;
use Illuminate\Support\Str;
use App\Mail\Registerv2Mail;
use Illuminate\Http\Request;
use Psy\Command\HistoryCommand;
use App\Jobs\SendRegisterMailJob;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Models\ConnexionHistorique;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\RedirectResponse;
use League\Container\Exception\NotFoundException;
use Illuminate\Database\Eloquent\Relations\HasOneOrMany;
use Illuminate\Contracts\Broadcasting\HasBroadcastChannel;

class AuthenticationController extends Controller
{
    /**
     * Undocumented function
     *
     * @return View 
     */

    public function userRegister()
    {
        if (!Auth::user() instanceof User) {
            throw new NotFoundException('Error Processing Request', 1);
            // abort(401);
        }
        $user = User::where('email', Auth::user()->email)->first();

        return view('pages.user-register');
    }

    /**
     * Undocumented function
     *
     * @return RedirectResponse 
     */

    public function register(Request $request)
    {

        $request->validate(User::VALIDATION_RULES);

        $pattern = 'karakara.biz';
        $email = $request->email;
        $emailPattern = explode("@", $email)[1];
        if ($emailPattern === $pattern | $emailPattern === "gmail.com") {
            try {
                $user = User::create([
                    'id' => str::uuid(),
                    'name' => strtoupper(htmlspecialchars(trim(strval($request->nom)))),
                    'firstname' => ucfirst(htmlspecialchars(trim(strval($request->prenom)))),
                    'email' => htmlspecialchars(trim(strval($request->email))),
                    'phone' => htmlspecialchars(trim(strval($request->phone))),
                    'password' => Hash::make(strval($request->password)),
                ]);
                $data = [
                    'email' => $user->email,
                    'name' => $user->name,
                    'firstname' => $user->firstname,
                    'password' => $request->password,
                    'url' => route('login'),
                ];

                SendRegisterMailJob::dispatch($data);
                return redirect()->route('user.list')->with('success', "Enregistrement éffectué");
            } catch (\Throwable $th) {
                return back()->with('error', "Enregistrement échoué !" . $th);
            }
        }
        return back()->with('error', 'Adresse e-mail invalide');
    }

    /**
     * Undocumented function
     *
     * @return RedirectResponse 
     */

    // public function login(Request $request)
    // {

    //     $credentials = $request->validate([
    //         'email' => ['required', 'email'],
    //         'password' => ['required', 'min:8'],
    //     ]);

    //     if (Auth::check()) {
    //         return redirect()->intended('modern');
    //     }

    //     $user = User::where('email', $request->email)->firstOrFail();

    //     $checkExist = User::where('email', $request->email)->exists();

    //     if ($checkExist == 'true') {
    //         $checkRole = $user->getRoleNames();
    //         $status = $user['status'];
    //         if ($checkRole) {
    //             if ($status == 1) {
    //                 if (Auth::attempt($credentials)) {
    //                     $request->session()->regenerate();
    //                     $remember = $request->remember;
    //                     if ($remember) {
    //                         Auth::login($user, $remember = true);
    //                         $connexion = new ConnexionHistorique();
    //                         $connexion['id'] = Str::uuid();
    //                         $connexion['nom'] = $user['nom'];
    //                         $connexion['prenom'] = $user['prenom'];
    //                         $connexion['ip'] = request()->ip();
    //                         $connexion->save();
    //                         return redirect()->intended('modern');
    //                     }
    //                     Auth::login($user);
    //                     $connexion = new ConnexionHistorique();
    //                     $connexion['id'] = Str::uuid();
    //                     $connexion['name'] = $user['nom'];
    //                     $connexion['firstname'] = $user['prenom'];
    //                     $connexion->save();
    //                     return redirect()->intended('modern');
    //                 }
    //                 return back()->withErrors([
    //                     'error' => 'Email ou mot de passe incorrect.',
    //                 ]);
    //             }
    //             return back()->withErrors([
    //                 'error' => "Votre compte a été désactivé, veuillez contactez l'adminstrateur.",
    //             ]);
    //         }
    //     }
    //     return back()->withErrors([
    //         'error' => "Veuillez vérifier votre adresse mail, ce compte n\'exixte pas !",
    //     ]);
    // }

    /**
     * Undocumented function
     *
     * @return RedirectResponse 
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }

    /**
     * Undocumented function
     *
     * @return RedirectResponse 
     */

    public function updatePassword(Request $request)
    {
        // dd(!Hash::check($request->old_password, auth()->user()->password));
        # Validation
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);

        try {
            #Comparaison de l'ancien mot de passe
            if (auth()->user() instanceof User) {
                if (!Hash::check(strval($request->old_password), auth()->user()->password)) {
                    return back()->with("error", "Mot de passe incorrect !");
                }
                User::whereId(auth()->user()->id)->update([
                    'password' => Hash::make(strval($request->new_password))
                ]);
                #Mettre à jour l'utilisateur avec le nouveau mot de passe
                return back()->with("success", "Mot de passe changé avec succès !");
            }
            \abort(401);
        } catch (\Throwable $th) {
            return back()->with("error", "Erreur, veuillez contacter l'administrateur!");
        }
    }

    public function resetpw()
    {
        // dd($request->password);
        return view('auth.resetpw');
    }
    public function forgotPassword()
    {
        // dd('ok');
        $pageConfigs = ['bodyCustomClass' => 'forgot-bg', 'isCustomizer' => false];
        return view('auth.passwords.email', ['pageConfigs' => $pageConfigs]);
    }
}
