<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PackController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\quotaController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\SourceController;
use App\Http\Controllers\SurveyController;
use App\Http\Controllers\ClientsController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CuisineController;
use App\Http\Controllers\DeliverController;
use App\Http\Controllers\MenuDayController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RapportController;
use App\Http\Controllers\RepportController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\DistrictController;
use App\Http\Controllers\TypePackController;
use App\Http\Controllers\CommandesController;
use App\Http\Controllers\OperationController;
use App\Http\Controllers\ComposantsController;
use App\Http\Controllers\OperationsController;
use App\Http\Controllers\ParticularController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\SuggestionController;
use App\Http\Controllers\UnitMesureController;
use App\Http\Controllers\HandleErrorController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\ModePaiementController;
use App\Http\Controllers\TypeCommandeController;
use App\Http\Controllers\CustomerDepotController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\Type_ComposantsController;
use App\Http\Controllers\AvailableDeliverController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('home');
    $users = User::all();
    return view('welcome', ['users' => $users]);
})->middleware('auth');

Auth::routes();

Route::get('/accueil', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth');

// Form Route
Route::get('/form-elements', [FormController::class, 'formElement']);
Route::get('/form-select2', [FormController::class, 'formSelect2']);
Route::get('/form-validation', [FormController::class, 'formValidation']);
Route::get('/form-masks', [FormController::class, 'masksForm']);
Route::get('/form-editor', [FormController::class, 'formEditor']);
Route::get('/form-file-uploads', [FormController::class, 'fileUploads']);
Route::get('/form-layouts', [FormController::class, 'formLayouts']);
Route::get('/form-wizard', [FormController::class, 'formWizard']);
Route::get('/list-permissions', [FormController::class, 'essai'])->name('list.permissions')->middleware('auth');
Route::get('/list-roles', [FormController::class, 'role_form'])->name('list.role')->middleware('auth');
Route::post('/permissions', [FormController::class, 'permission'])->name('permission')->middleware('auth');
Route::post('/roles', [FormController::class, 'role'])->name('role')->middleware('auth');
Route::post('/assigner-role', [UserController::class, 'assignRole'])->name('assign.role')->middleware('auth');
Route::post('/roles-permissions', [UserController::class, 'assignPermissions'])->name('assign.permission')->middleware('auth');
Route::post('/assigner-roles-permissions', [UserController::class, 'permission_to_role'])->name('role.permission')->middleware('auth');
Route::post('/modifier-image/{id}', [UserController::class, 'update_image'])->name('update.image')->middleware('auth');
Route::get('/supprimer-photo-profil', [UserController::class, 'delete_profil_image'])->name('delete.profil.image')->middleware('auth');
Route::get('/profil-utilisateur', [UserProfileController::class, 'userProfile'])->name('user.profil');

// User Route
Route::post('/utilisateurs/suppression/{id}', [UserController::class, 'destroy'])->name('user.sup');
Route::get('/liste-utilisateurs', [UserController::class, 'usersList'])->name('user.list');
Route::get('/details-utilisateurs/{id}', [UserController::class, 'usersView'])->name('user.view')->middleware('auth');
Route::get('/editer-utilisateur/{id}', [UserController::class, 'usersEdit'])->name('user.edit')->middleware('auth');
Route::post('/editer-utilisateur/{id}', [UserController::class, 'user_update'])->name('user.update')->middleware('auth');
Route::get('/bloquer-utilsateur/{id}', [UserController::class, 'lockAccount'])->name('user.lock')->middleware('auth');
Route::get('/debloquer-utilisateur/{id}', [UserController::class, 'unlockAccount'])->name('user.unlock')->middleware('auth');
Route::get('/permissions_et_roles', [UserController::class, 'showAllPermissionAndRoles'])->middleware('auth');
Route::get('/historique-connexions', [UserController::class, 'AllConnexion'])->middleware('auth');

// Authentication Route
// Route::get('/user-login', [AuthenticationController::class, 'userLogin']);
Route::get('/inscription-utilisateur', [AuthenticationController::class, 'userRegister'])->middleware('auth');
Route::get('/connexion', [AuthenticationController::class, 'userLogin'])->name('user-login');
Route::get('/inscription-utilisateur', [AuthenticationController::class, 'userRegister'])->name('user-register');
Route::get('/mot-de-passe-oublie', [AuthenticationController::class, 'forgotPassword'])->name('forgotPassword');
Route::get('/ecran-verrouille', [AuthenticationController::class, 'lockScreen']);
Route::post('/inscription', [AuthenticationController::class, 'register'])->name('register');
Route::post('/reinitialiser-mot-de-passe/{id}', [UserController::class, 'ResetPassword'])->name('user.reset');
Route::get('reinitialiser-mot-de-passe', [AuthenticationController::class, 'resetpw'])->name('resetpw');
Route::post('reinitialiser', [AuthenticationController::class, 'reset'])->name('reset');
Route::post('/changer-mot-de-passe', [AuthenticationController::class, 'updatePassword'])->name('update-password');
// Route::post('/login', [AuthenticationController::class, 'login'])->name('login');
Route::get('/deconnexion', [AuthenticationController::class, 'logout'])->name('logout')->middleware('auth');
Route::post('confirmer-mot-de-passe', [AuthenticationController::class, 'passwordConfirmed'])->name('passwordConfirmed')->middleware(['auth', 'throttle:6,1']);





Route::middleware(['auth'])->group(function () {

    // Type pack
    Route::get('/type-pack', [TypePackController::class, 'index'])->name('typepack.index');
    Route::post('/type-pack', [TypePackController::class, 'store'])->name('typepack.store');
    Route::post('/modifier-type-pack/{id}', [TypePackController::class, 'update'])->name('typepack.update');
    Route::post('/supprimer-type-pack/{id}', [TypePackController::class, 'delete'])->name('typepack.delete');

    // Type_composants


    Route::get('/enregistrer_type_composant/{id?}', [Type_ComposantsController::class, 'enregistrer_type_composant'])->name('typecomposant.create');
    Route::get('/list_type_composants', [Type_ComposantsController::class, 'index'])->name('typecomposant.index');
    Route::post('/creer-type-composants', [Type_ComposantsController::class, 'store'])->name('typecomposant.store');
    Route::post('/modifier-type-composants/{id}', [Type_ComposantsController::class, 'updatecomposant'])->name('typecomposant.updatecomposant');

    Route::get('/type-composants', [Type_ComposantsController::class, 'show']);

    Route::post('/supprimer-type-composants/{id}', [Type_ComposantsController::class, 'destroy'])->name('typecomposant.sup');
    Route::get('/type-composants/{id}', [Type_ComposantsController::class, 'edit']);

    // Composants

    Route::get('/composant', [ComposantsController::class, 'add'])->name('composant.add');;
    Route::get('/modifier-composant/{id}', [ComposantsController::class, 'showform'])->name('composant.update');;
    Route::get('/enregistrer-composant/{id?}', [ComposantsController::class, 'enregistrer_composant'])->name('composant.create');
    Route::get('/liste-composants', [ComposantsController::class, 'index'])->name('composant.index');
    Route::post('/creer-composant', [ComposantsController::class, 'store'])->name('composant.store');
    Route::post('/modifier-composant/{id}', [ComposantsController::class, 'updatecomposants'])->name('composant.updatecomposants');

    Route::get('/composant-details/{id}', [ComposantsController::class, 'show'])->name('composant.show');

    Route::post('/composant/{id}', [ComposantsController::class, 'destroy'])->name('composant.sup');
    Route::get('/composants/{id}', [ComposantsController::class, 'edit']);

    Route::get('/menu', [MenuDayController::class, 'menuview'])->name('menu.today');
    Route::get('/publier-menu/{id}', [MenuController::class, 'publish_menu'])->name('menu.published');
    Route::get('/retirer-un-menu/{id}', [MenuController::class, 'dispublish_menu'])->name('menu.dispublished');
    Route::get('/quota', [quotaController::class, 'index'])->name('quota.today');
    Route::post('/quota', [quotaController::class, 'add_quota'])->name('add.quota');
    Route::post('/quota/{id}', [quotaController::class, 'update_quota'])->name('update.quota');


    // Gestion des commandes

    //Route::get('/enregistrer_commande/{id?}', [CommandesController::class, 'enregistrer_commande'])->name('commande.create');
    Route::get('/commandes', [CommandesController::class, 'index'])->name('commande.index');
    Route::post('/commandes', [CommandesController::class, 'store'])->name('commande.store');
    Route::post('/commandes/{commande}', [CommandesController::class, 'updatecommandes'])->name('commande.updatecommande');
    Route::get('/enregistrer-une-commande', [CommandesController::class, 'create'])->name('commande.create');
    Route::get('/carnet-adresse', [CommandesController::class, 'carnetadresse'])->name('carnetadresse.store');
    Route::get('/ajout-pack', [MenuDayController::class, 'addpack'])->name('addpack.store');
    Route::post('/ajout-constituant', [MenuDayController::class, 'addconstituant'])->name('addconstituant.store');
    Route::get('/recherche/ajout-pack/creer', [MenuDayController::class, 'searchpack'])->name('searchpack.store');
    Route::get('/recherche-composant/rechercher', [MenuDayController::class, 'filtrecomposant'])->name('filtrecomposant.store');
    Route::get('/supprimer-composant/supprimer', [MenuDayController::class, 'deletecomposant'])->name('deletecomposant.delete');
    Route::get('/information-pack/recherche', [MenuDayController::class, 'infopack'])->name('infopack.search');
    Route::post('/supprimer-menu', [MenuDayController::class, 'deletemenu'])->name('deletemenu');
    Route::post('/reconduire-menu', [MenuDayController::class, 'reconduitmenu'])->name('reconduitmenu');
    Route::post('/activer-menu-du-jour', [MenuDayController::class, 'activemenutoday'])->name('activemenutoday');

    Route::get('/afficher-commande/{id}', [CommandesController::class, 'show']);

    // Route::delete('/Commande/{id}', [CommandesController::class, 'destroy'])->name('commande.sup');
    Route::get('/commande/{commande}', [CommandesController::class, 'edit'])->name('commande.show');
    Route::get('/client/recherche/{customer}', [CommandesController::class, 'searchCustomer'])->name('customer.search');
    Route::post('/commande/rechercher', [CommandesController::class, 'search'])->name('commande.seach');
    // Route::get('/bordereaux', [CommandesController::class, 'CreateBordereaux'])->name('bordereaux');
    Route::get('/bordereaux', [PDFController::class, 'index'])->name('bordereaux');
    Route::get('/pdf-bordereaux/{id}', [PDFController::class, 'generatePDF'])->name('generate.pdf');

    Route::post('confirmer-commande', [CommandesController::class, 'confirm'])->name('confirm');
    Route::post('valider-livraison', [CommandesController::class, 'actiliv'])->name('actiliv');
    Route::post('commandes_status', [CommandesController::class, 'changeCommandeStatus'])->name('changeCommandeStatus');
    Route::post('/supprimer-commande', [CommandesController::class, 'destroy'])->name('deleteorder');




    // Gestion des packs

    Route::get('/pack/{id?}', [PackController::class, 'enregistrer_pack'])->name('pack.create');
    Route::get('/packs', [PackController::class, 'index'])->name('pack.index');;
    Route::post('/packs', [PackController::class, 'store'])->name('pack.store');
    Route::get('/pack-formulaire', [PackController::class, 'add'])->name('pack.add');
    Route::post('/modifier-pack/{id}', [PackController::class, 'updatepack'])->name('pack.updatepack');

    Route::get('/details-pack/{id}', [PackController::class, 'show'])->name('pack.show');
    Route::get('/modification-pack/{id}', [PackController::class, 'showedit'])->name('pack.update');

    Route::post('/supprimer-pack/{id}', [PackController::class, 'destroy'])->name('pack.sup');
    Route::get('/pack/{id}', [PackController::class, 'edit']);

    Route::post('/bloquer-pack/{id}', [PackController::class, 'lockPack'])->name('pack.lock');
    Route::get('/statut-pack/{id}', [PackController::class, 'ChangePackStatus'])->name('pack.ChangePackStatus');

    Route::post('statut-pack', [PackController::class, 'active'])->name('updatepackbyactive');



    // sources


    Route::get('/enregistrer_sources/{id?}', [SourceController::class, 'enregistrer_sources'])->name('sources.create');
    Route::get('/listes-sources', [SourceController::class, 'index'])->name('sources.index');
    Route::post('/enregistrer-sources', [SourceController::class, 'store'])->name('sources.store');
    Route::post('/modifier-sources/{id}', [SourceController::class, 'updatesources'])->name('sources.updatesources');

    Route::get('/sources', [SourceController::class, 'show']);

    Route::post('/supprimer-sources/{id}', [SourceController::class, 'destroy'])->name('sources.sup');
    Route::get('/sources/{id}', [SourceController::class, 'edit']);

    //Zones

    // Route::get('/enregistrer_sources/{id?}', [SourceController::class, 'enregistrer_sources'])->name('sources.create');
    Route::get('/liste-zones', [DistrictController::class, 'index'])->name('districts.index');
    Route::post('/enregistrer-zones', [DistrictController::class, 'store'])->name('districts.store');
    Route::post('/modifier-zones/{id}', [DistrictController::class, 'updatedistricts'])->name('districts.updatedistricts');

    // Route::get('/show-sources', [DistrictController::class, 'show']);

    Route::post('/supprimer-zones/{id}', [DistrictController::class, 'destroy'])->name('districts.sup');
    // Route::get('/sources/{id}', [DistrictController::class, 'edit']);

    // Type_commande


    Route::get('/enregistre-type-commande/{id?}', [TypeCommandeController::class, 'enregistrer_type_commande'])->name('typecommande.create');
    Route::get('/list_typecommande', [TypeCommandeController::class, 'index'])->name('typecommande.index');
    Route::post('/enregistrer-type-commande', [TypeCommandeController::class, 'store'])->name('typecommande.store');
    Route::post('/modifier-type-commande/{id}', [TypeCommandeController::class, 'updatetypecommande'])->name('typecommande.updatetypecommande');

    Route::get('/show-type-commande', [TypeCommandeController::class, 'show']);

    Route::post('/supprimer-type-commande/{id}', [TypeCommandeController::class, 'destroy'])->name('typecommande.sup');
    Route::get('/type-commande/{id}', [TypeCommandeController::class, 'edit']);
    Route::post('/modifier-commande/{commande}', [CommandesController::class, 'update'])->name('commande.update');



    //Routes mode de paiement
    Route::get('/liste-mode-paiement', [ModePaiementController::class, 'list'])->name('mode_paiement');
    Route::post('/creer-mode_paiement', [ModePaiementController::class, 'storemode'])->name('mode_paiement_store');
    Route::post('/modifier-mode-paiement/{id}', [ModePaiementController::class, 'updatemodepaiement'])->name('updatemode_paiement');
    Route::post('/supprimer-mode-paiement/{id}', [ModePaiementController::class, 'destroy_mode'])->name('destroy_mode.sup');


    // Coupons
    Route::post('/coupon/rechercher', [CouponController::class, 'search'])->name('coupon.seach');

    Route::get('/coupon/liste', [CouponController::class, 'index'])->name('coupon.index');
    Route::get('/coupon/formulaire/enregistrer', [CouponController::class, 'add'])->name('coupon.add');

    Route::get('/coupon/client/liste', [CouponController::class, 'clientsWithCoupons'])->name('coupon.clients');
    Route::get('/coupons/valide/liste', [CouponController::class, 'couponsValid'])->name('coupons.valid');
    Route::get('/coupons/non_valide/liste', [CouponController::class, 'couponsNoValid'])->name('coupons.novalid');

    Route::post('/coupon/enregistrer', [CouponController::class, 'store'])->name('coupon.store');
    Route::post('/coupon/editer/{id}', [CouponController::class, 'updatecoupon'])->name('coupon.updatecoupon');
    Route::get('/coupons/cilent/{id}', [CouponController::class, 'coupons_client'])->name('coupon.customers');
    Route::post('/coupon/supprimer/{id}', [CouponController::class, 'destroy'])->name('coupon.sup');
    Route::get('coupon/generer/pdf/{id}', [CouponController::class, 'generatePDF'])->name('coupon.imprimer');
    Route::get('coupon/generer/pdf/client/{id}', [CouponController::class, 'GenerateMultipleCoupon'])->name('coupon.multiple');
    Route::get('coupon/imprimer/date/{id}/{date}', [CouponController::class, 'printbydate'])->name('print.bydate');
    Route::post('coupon/supprimer/date/{id}/{date}', [CouponController::class, 'deletebydate'])->name('delete.bydate');
    Route::get('coupon/envoyer/{id}', [CouponController::class, 'SendCoupon'])->name('send.coupon');
    Route::get('coupon/clients', [CouponController::class, 'RetrieveClient'])->name('retrieve.client');
    Route::get('coupon/formulaire/editer/{id}/{customer}', [CouponController::class, 'editCoupon'])->name('edit.coupon');
    Route::post('coupon/formulaire/enregistrer', [CouponController::class, 'editsubmission'])->name('edit.save');


    // Cuisine

    Route::get('/provision/cuisine/formulaire/enregistrer', function () {
        return view('Cuisine.add_provision');
    })->name('Cuisine.ajout');
    Route::get('provision/cuisine/formulaire/editer/{id}', [CuisineController::class, 'showform'])->name('cuisine.update');
    Route::post('provision/cuisine/enregistrer', [CuisineController::class, 'store'])->name('cuisineprovision.store');
    Route::get('/provisions/liste', [CuisineController::class, 'index'])->name('cuisineprovision.index');
    Route::post('/cuisineprovision/sup/{id}', [CuisineController::class, 'destroy'])->name('cuisineprovision.sup');
    Route::get('/cuisineprovision/update/{id}', [CuisineController::class, 'update'])->name('cuisineprovision.update');
    Route::get('/show-cuisineprovision/{id}', [CuisineController::class, 'show'])->name('provision');

    //Clients

    // Route::get('/add_client', function () {
    //     $categories = Categorie::all();
    //     return view('clients.add', [
    //         'categories' => $categories,
    //     ]);
    // })->name('add.client');
    // Route::get('profile/client', function(){ return view('clients.customer-profile');});
    // Route::get('/enregistrer_client/{id?}', [ClientsController::class, 'enregistrer_client'])->name('client.create');
    // Route::get('/voir_client/{id}', [ClientsController::class, 'show'])->name('client.show');
    // Route::get('/update_client/{id}', [ClientsController::class, 'showform'])->name('client.update');
    // Route::get('/customer', [ClientsController::class, 'index'])->name('customer.index');
    // Route::post('/store_client', [ClientsController::class, 'store'])->name('client.store');
    // Route::post('/client/password/reset/{customer}', [ClientsController::class, 'reset'])->name('client.reset');
    // Route::get('/client/updateclient/{client}', [ClientsController::class, 'updateclient'])->name('client.updateclient');
    // Route::get('/client/updateclient2/{client}', [ClientsController::class, 'updateclient2'])->name('client.updateclient2');

    // Particular
    Route::get('/particulier/formulaire/enregistrer', [ParticularController::class, 'add'])->name('customer.add');
    Route::post('/particulier/enregistrer', [ParticularController::class, 'store'])->name('particular.store');
    Route::get('/particulier/voir/{customer}', [ParticularController::class, 'show'])->name('particular.show');
    Route::post('/particulier/editer/{customer}', [ParticularController::class, 'update'])->name('particular.update');

    // Company
    Route::get('/entreprise/formulaire/enregistrer', [CompanyController::class, 'add'])->name('company.add');
    Route::post('/entreprise/enregistrer', [CompanyController::class, 'store'])->name('company.store');
    Route::get('/entreprise/voir/{customer}', [CompanyController::class, 'show'])->name('company.show');
    Route::post('/entreprise/editer/{customer}', [CompanyController::class, 'update'])->name('company.update');
    // Route::post('/company/delete/{customer}', [CompanyController::class, 'delete'])->name('company.delete');

    Route::get('/client/profile/{id}', [ClientsController::class, 'show'])->name('client.show');

    Route::post('/Client/supprimer/{customer}', [ClientsController::class, 'destroy'])->name('client.sup');
    Route::get('/Client/{id}', [ClientsController::class, 'edit']);

    // Gestion des permissions
    Route::get('permissions/{id}', [PermissionController::class, 'index'])->name('permissions');
    Route::post('attribution/droits', [PermissionController::class, 'attribution_des_droits'])->name('attribution_des_droits');
    Route::post('attribution/permissions', [PermissionController::class, 'attribution_des_permissions'])->name('attribution_des_permissions');
    Route::get('attribution/tous/permissions', [PermissionController::class, 'attribution_des_permissions_all'])->name('attribution_des_permissions_all');

    // Report

    // Liste des reports
    Route::get('requete/liste', [RepportController::class, 'reportlist'])->name('reportlist');

    // Commande by source commande
    Route::get('requete/commande_par_source', [RepportController::class, 'commandebysource'])->name('commandebysource');
    Route::post('rechercher/commande_par_source', [RepportController::class, 'searchcommandebysource'])->name('searchcommandebysource');

    // Commande by mode de paiement
    Route::get('requete/commande_par_mode_paiement', [RepportController::class, 'commandebymode'])->name('commandebymode');
    Route::post('rechercher/commande_par_mode_paiement', [RepportController::class, 'searchcommandebymode'])->name('searchcommandebymode');

    // Commande by pack
    Route::get('requete/commande_par_pack', [RepportController::class, 'commandebypack'])->name('commandebypack');
    Route::post('rechercher/commande_par_pack', [RepportController::class, 'searchcommandebypack'])->name('searchcommandebypack');

    // Commande by livreur
    Route::get('requete/commande_par_livreur', [RepportController::class, 'commandebylivreur'])->name('commandebylivreur');
    Route::post('rechercher/commande_par_livreur', [RepportController::class, 'searchcommandebylivreur'])->name('searchcommandebylivreur');

    // Commande by customer
    Route::get('requete/commande_par_client', [RepportController::class, 'commandebycustomer'])->name('commandebycustomer');
    Route::post('rechercher/commande_par_client', [RepportController::class, 'searchcommandebycustomer'])->name('searchcommandebycustomer');

    // Tops customer
    Route::get('requete/top/clients', [RepportController::class, 'topscustomer'])->name('topscustomer');
    Route::post('rechercher/top/clients', [RepportController::class, 'searchtopscustomer'])->name('searchtopscustomer');

    // commande by period
    Route::get('requete/commande_par_periode', [RepportController::class, 'commandebyperiod'])->name('commandebyperiod');
    Route::post('rechercher/commande_par_periode', [RepportController::class, 'searchcommandebyperiod'])->name('searchcommandebyperiod');

    // Chiffre d'affaire sur une période
    Route::get('requete/chiffre_affaire_par_periode', [RepportController::class, 'chiffreaffairebyperiod'])->name('chiffreaffairebyperiod');
    Route::post('rechercher/chiffre_affaire_par_periode', [RepportController::class, 'searchchiffreaffairebyperiod'])->name('searchchiffreaffairebyperiod');

    // Chiffre d'affaire par mode de paiement
    Route::get('requete/chiffre_affaire_par_mode_paiement', [RepportController::class, 'chiffreaffairebymodepaiement'])->name('chiffreaffairebymodepaiement');
    Route::post('rechercher/chiffre_affaire_par_mode_paiement', [RepportController::class, 'searchchiffreaffairebymodepaiement'])->name('searchchiffreaffairebymodepaiement');

    // // Gestion des produits
    // Route::get('produits_cuisine', [ProduitController::class, 'index1'])->name('produits.index1');
    // // Route::get('produits/', [ProduitController::class, 'index'])->name('produits.index');
    // Route::get('produits_empaquetage', [ProduitController::class, 'index2'])->name('produits.index2');
    // Route::get('produits/{id}', [ProduitController::class, 'ShowProduct'])->name('produit.show');
    // Route::get('store_product_cuisine', [ProduitController::class, 'store1'])->name('cuisine.store');
    // Route::get('store_product_empaquetage', [ProduitController::class, 'store2'])->name('empaquetage.store');
    // Route::get('update_product/cuisine/{id}', [ProduitController::class, 'updateProduct1'])->name('produit.update1');
    // Route::get('update_product/empaquetage/{id}', [ProduitController::class, 'updateProduct2'])->name('produit.update2');
    // Route::post('store_product', [ProduitController::class, 'StoreValidation'])->name('store.validation');
    // Route::post('update_product_submission/{id}', [ProduitController::class, 'updateProductSubmission'])->name('update.validation');
    // Route::post('delete_product/{id}', [ProduitController::class, 'DeleteProduct'])->name('delete.product');
    // Route::get('show_cuisine_produit/{id}', [ProduitController::class, 'show_cuisine_produit'])->name('produit.cuisine.show');
    // Route::get('show_empaquetage_produit/{id}', [ProduitController::class, 'show_empaquetage_produit'])->name('produit.empaquetage.show');

    //Operation

    Route::get('operations/cuisine/liste', [OperationController::class, 'index'])->name('cuisine');
    Route::get('operations/empaquetage/liste', [OperationController::class, 'empaquetage'])->name('empaquetage');
    Route::get('operations/cuisine/formulaire/enregistrer', [OperationController::class, 'add_operations_cuisine_form'])->name('add_operations_form_cuisine');
    Route::get('operations/empaquetage/formulaire/enregistrer', [OperationController::class, 'add_operations_empaquetage_form'])->name('add_operations_form_empaquetage');
    Route::get('operations/retrait/cuisine/formulaire/enregistrer', [OperationController::class, 'add_operations_withdraw_cuisine_form'])->name('add_operations_withdraw_form_cuisine');
    Route::get('operations/retrait/empaquetage/formulaire/enregistrer', [OperationController::class, 'add_operations_withdraw_empaquetage_form'])->name('add_operations_withdraw_empaquetage_form');
    Route::post('operations/liste', [OperationController::class, 'store'])->name('operations.store');
    Route::post('operations/supprimer/{id}', [OperationController::class, 'destroy'])->name('operations.delete');
    Route::get('operations/empaquetage/formulaire/editer/{id}', [OperationController::class, 'updateform1'])->name('operations.update.form1');
    Route::get('operations/cuisine/formulaire/editer/{id}', [OperationController::class, 'updateform2'])->name('operations.update.form2');
    Route::post('operations/editer/{id}', [OperationController::class, 'update'])->name('operations.update');
    Route::get('operations/voir/{id}', [OperationController::class, 'show'])->name('operations.show');
    // Gestion des produits
    // Route::get('produit/cuisine/liste', [ProduitController::class, 'index1'])->name('produits.index1');
    // // Route::get('produits/', [ProduitController::class, 'index'])->name('produits.index');
    // Route::get('produit/empaquetage/liste', [ProduitController::class, 'index2'])->name('produits.index2');
    // Route::get('produits/{id}', [ProduitController::class, 'ShowProduct'])->name('produit.show');
    // Route::get('store_product_cuisine', [ProduitController::class, 'store1'])->name('cuisine.store');
    // Route::get('store_product_empaquetage', [ProduitController::class, 'store2'])->name('empaquetage.store');
    // Route::get('update_product/cuisine/{id}', [ProduitController::class, 'updateProduct1'])->name('produit.update1');
    // Route::get('update_product/empaquetage/{id}', [ProduitController::class, 'updateProduct2'])->name('produit.update2');
    // Route::post('store_product', [ProduitController::class, 'StoreValidation'])->name('store.validation');
    // Route::post('update_product_submission/{id}', [ProduitController::class, 'updateProductSubmission'])->name('update.validation');
    // Route::post('delete_product/{id}', [ProduitController::class, 'DeleteProduct'])->name('delete.product');
    // Route::get('show_cuisine_produit/{id}', [ProduitController::class, 'show_cuisine_produit'])->name('produit.cuisine.show');
    // Route::get('show_empaquetage_produit/{id}', [ProduitController::class, 'show_empaquetage_produit'])->name('produit.empaquetage.show');


    //new products
    Route::get('produit/formulaire', [ProductController::class, 'store1'])->name('produits.form');
    Route::post('produit/enregistrer', [ProductController::class, 'Storeproduct'])->name('store.product');
    Route::get('produit/liste', [ProductController::class, 'index'])->name('produits.index');
    Route::get('produit/voir/{id}', [ProductController::class, 'ShowProduct'])->name('produitshow');
    Route::post('produit/supprimer/{id}', [ProductController::class, 'DestroyProduct'])->name('destroy.product');
    Route::get('update_product/cuisine/{id}', [ProductController::class, 'updateProduct'])->name('produit.updating');
    Route::post('update_product_submissions/{id}', [ProductController::class, 'updateProductSubmissions'])->name('update.submissions');


    // Unités de mesure
    Route::get('/unites/liste', [UnitMesureController::class, 'index'])->name('unites.index');
    Route::post('/unites/enregistrer', [UnitMesureController::class, 'store'])->name('unites.store');
    Route::post('/unites/editer/{id}', [UnitMesureController::class, 'update'])->name('unites.update');
    Route::post('/unites/supprimer/{id}', [UnitMesureController::class, 'delete'])->name('unites.delete');


    // Maintenances

    Route::get('maintenance', [ClientsController::class, 'maintenance'])->name('maintenance');



    // Gestion des préférences clients

    Route::get('/add2/{id?}', [SuggestionController::class, 'enregistrer_suggestion'])->name('suggestion.add');
    Route::get('/suggestion', [SuggestionController::class, 'index'])->name('suggestion.index');
    Route::post('/store_suggestion', [SuggestionController::class, 'store'])->name('suggestion.store');
    Route::post('/ajouter_suggestion/{customer}', [SuggestionController::class, 'store1'])->name('suggestion1.store');
    Route::post('/suggestion/updatesuggestion/{id}', [SuggestionController::class, 'update'])->name('suggestion.update');
    Route::post('/suggestion/updatesuggestion/{suggestion}', [SuggestionController::class, 'updatesuggestion'])->name('suggestion.updatesuggestion');
    Route::get('/suggestion/create', [SuggestionController::class, 'create'])->name('suggestion.create');
    Route::post('/suggestion/sup/{id}', [SuggestionController::class, 'destroy'])->name('suggestion.sup');
    Route::get('/suggestion/{id}', [SuggestionController::class, 'edit'])->name('suggestion.edit');
    Route::post('/suggestion/search', [SuggestionController::class, 'search'])->name('suggestion.seach');


    // Menu
    Route::get('menus/liste', [MenuDayController::class, 'index'])->name('allmenus');
    Route::get('enregistrer/menu/{id}/{date}', [MenuDayController::class, 'create'])->name('createmenus');
    Route::post('ajout/menus', [MenuDayController::class, 'store'])->name('storemenus');
    Route::post('editer/menus/active', [MenuDayController::class, 'active'])->name('updatemenusbyactive');

    Route::get('editer/menu/{id}/{date}', [MenuDayController::class, 'show'])->name('updatemenus');
    Route::post('editer/menu/{id}/{date}', [MenuDayController::class, 'update'])->name('updatemenu');
    Route::get('menu/reconduit/{id}/{date}', [MenuDayController::class, 'showreconduit'])->name('updatemenusreconduit');
    Route::post('editer/menu/reconduit/{id}/{date}', [MenuDayController::class, 'updatereconduit'])->name('updatemenureconduits');

    //Inventaire
    // Route::get('inventaires/cuisine', [InventaireController::class, 'index_cuisine'])->name('inventaires_cuisine');
    // Route::get('inventaires/empaquetage', [InventaireController::class, 'index_empaquetage'])->name('inventaires_empaquetage');
    // Route::get('enregistrer/inventaires/cuisine', [InventaireController::class, 'CreateForm1'])->name('create_inventaires_cuisine');
    // Route::get('enregistrer/inventaires/empaquetage', [InventaireController::class, 'CreateForm2'])->name('create_inventaires_empaquetage');
    // Route::post('enregistrer/inventaires/cuisine', [InventaireController::class, 'CreateInventaire'])->name('create_inventaires_cuisine');
    // Route::post('enregistrer/inventaires/empaquetage', [InventaireController::class, 'CreateInventaire'])->name('create_inventaires_empaquetage');
    // Route::get('imprimer/inventaires/{domaine}/{date}', [InventaireController::class, 'PrintInventaire'])->name('print.inventaire');
    // Route::get('imprimer/fiche/cuisine', [InventaireController::class, 'PrintFicheCuisine'])->name('print.fiche1');
    // Route::get('imprimer/fiche/empaquetagee', [InventaireController::class, 'PrintFicheEmpaquetage'])->name('print.fiche2');


    // New Operations routes

    Route::get('operations/entree', [OperationsController::class, 'index_entree'])->name('entrees');
    Route::get('operations/sortie', [OperationsController::class, 'index_sortie'])->name('sorties');
    Route::get('operations/inventaire', [OperationsController::class, 'index_inventaire'])->name('inventaires');
    Route::get('operations/formulaire/entrée', [OperationsController::class, 'create_entree'])->name('operations.form');
    Route::get('operations/formulaire/inventaire', [OperationsController::class, 'create_inventaire'])->name('operations.form');
    Route::get('operations/formulaire/sortie', [OperationsController::class, 'create_sortie'])->name('operations.form');
    Route::post('operations', [OperationsController::class, 'store'])->name('operations.create');
    Route::get('operations/supprimer/{id}', [OperationsController::class, 'destroy'])->name('operation.delete');


    // Rapport Route
    Route::get('/rapport-reunion', [RapportController::class, 'rapportform']);
    Route::get('/rapport-edit/{id}', [RapportController::class, 'editform'])->name('rapport.edit');
    Route::post('/rapport/update/{id}', [RapportController::class, 'edit'])->name('rapport.update');
    Route::post('/storerapport', [RapportController::class, 'storerapport']);
    route::get('list_rapports', [RapportController::class, 'index'])->name('repport.index');
    route::get('rapport/{id}', [RapportController::class, 'show_rapport']);
    route::post('rapports/{id}', [RapportController::class, 'destroy'])->name('rapport.delete');
    route::get('impression/{id}', [RapportController::class, 'impression']);

    //Livreurs
    $date = date('Y-m-d');
    Route::get('/livreurs/ajout', [DeliverController::class, 'add'])->name('delivers.add');
    Route::get('/livreurs/{deliver}/details', [DeliverController::class, 'show'])->name('delivers.show');
    Route::get('/livreurs', [DeliverController::class, 'index'])->name('delivers.index');
    Route::post('/ajouter_livreur', [DeliverController::class, 'store'])->name('delivers.store');
    Route::post('/livreurs/{deliver}/editer', [DeliverController::class, 'updateDelivers'])->name('delivers.update');
    Route::post('/livreurs/{deliver}/supprimer', [DeliverController::class, 'destroyDeliver'])->name('delivers.sup');
    Route::get('/livreurs/{deliver}', [DeliverController::class, 'edit'])->name('delivers.edit');
    Route::get('/commandes/assigner', [DeliverController::class, 'assignOrders'])->name('delivers.assign');
    Route::get('/commandes/attentes', [DeliverController::class, 'finished'])->name('delivers.finished');
    Route::get('/livreurs/{deliver}/commandes/' . $date . '/attente', [DeliverController::class, 'delivery'])->name('delivers.delivery');
    Route::get('/livreurs/{deliver}/commandes/' . $date . '/livrees', [DeliverController::class, 'deliveryRecover'])->name('delivers.deliveryrecover');
    Route::get('/livreurs/liste', [DeliverController::class, 'listDelivers'])->name('delivers.listdelivers');
    Route::post('/livreurs/disponible/ajout', [AvailableDeliverController::class, 'availableDelivers'])->name('delivers.available.add');
    Route::get('/livreurs/liste/non-disponible', [DeliverController::class, 'listDeliversAvailable'])->name('delivers.available');
    Route::get('/livreurs/{deliver}/commandes', [DeliverController::class, 'desassignOrders'])->name('delivers.desassign');
    Route::get('/livreurs/livraisons/attente', [AvailableDeliverController::class, 'deliversHasOrder'])->name('delivers.delivers_has_order');
    Route::post('/assigner_commandes', [DeliverController::class, 'assignOrder'])->name('delivers.assignorder');
    Route::post('/desassigner_commandes/{deliver}', [DeliverController::class, 'desassignOrder'])->name('delivers.desassignorder');
    Route::post('/livreurs/{deliver}/status', [DeliverController::class, 'manageDeliveryStatusTrue'])->name('delivers.delivery_statut');
    Route::post('/livreurs/{deliver}', [DeliverController::class, 'manageDeliveryStatusFalse'])->name('delivers.delivery_status');
    Route::get('/livreurs/liste/disponible', [AvailableDeliverController::class, 'listAvailableDelivers'])->name('livreur.disponible');
    Route::get('/commandes/' .$date, [CommandesController::class, 'todayorders'])->name('commandes.today');
    Route::post('/livreurs/disponible/revoquer', [AvailableDeliverController::class, 'unavailableDeliver'])->name('livreur.unavailable_deliver');


    //Dépot d'un client
    Route::get('/depots_clients', [CustomerDepotController::class, 'index'])->name('customerdepot.index');
    Route::post('/sauvegarderdepot', [CustomerDepotController::class, 'store'])->name('customerdepot.store');
    Route::post('/sauvegarder-depot/{customer}', [CustomerDepotController::class, 'store1'])->name('sauvegarderdepot11.store');
    Route::post('/depot/miseajour/{customer_depot}', [CustomerDepotController::class, 'update'])->name('customerdepot.update');
    //   Route::post('/depot/updatesuggestion/{suggestion}', [SuggestionController::class, 'updatesuggestion'])->name('customerdepot.updatesuggestion');
    Route::get('/depot/enregistrer/{id}', [CustomerDepotController::class, 'add'])->name('customerdepot.add');
    Route::post('/depot/supprimer/{id}', [CustomerDepotController::class, 'destroy'])->name('customerdepot.sup');
    Route::get('/depot/editer/{id}', [CustomerDepotController::class, 'edit'])->name('customerdepot.edit');
    Route::post('/depot/rechercherclient', [CustomerDepotController::class, 'search'])->name('customerdepot.seach');

    //Clients

    // Route::get('/add_client', function () {
    //     $categories = Categorie::all();
    //     return view('clients.add', [
    //         'categories' => $categories,
    //     ]);
    // })->name('add.client');
    Route::get('profile/client', function () {
        return view('clients.customer-profile');
    });
    Route::get('/enregistrer_client/{id?}', [ClientsController::class, 'enregistrer_client'])->name('client.create');
    Route::get('/client/{id}', [ClientsController::class, 'show'])->name('client.show');
    Route::get('/client/editer/{id}', [ClientsController::class, 'showform'])->name('client.update');
    Route::get('/client', [ClientsController::class, 'list'])->name('customer.index');
    Route::post('/client/enregistrer', [ClientsController::class, 'store'])->name('client.store');
    Route::post('/client/mot_de_passe/reinitialiser/{customer}', [ClientsController::class, 'reset'])->name('client.reset');
    Route::get('/client/editer/{client}', [ClientsController::class, 'updateclient'])->name('client.updateclient');
    Route::get('/client/editer2/{client}', [ClientsController::class, 'updateclient2'])->name('client.updateclient2');


    Route::get('/erreurs/405', [HandleErrorController::class, 'error_405'])->name('error_405');
    Route::get('/erreurs/404', [HandleErrorController::class, 'error_404'])->name('error_404');
    // Route::get('/test', [requestController::class, 'topCustomerOfMonth']);
    Route::get('/commandes/nouvelles', [RequestController::class, 'getOrdersLast'])->name('new.orders');


    Route::get('/nouveau-client/store', [CommandesController::class, 'addNewCustomer'])->name('addNewCustomer.store');


    // Import database
    // Import database source
    Route::get('/import/data', [ImportController::class, 'index'])->name('import.index');
    Route::get('/import/modpaiement', [ImportController::class, 'index1'])->name('import.index');
    Route::post('/import/donnee', [ImportController::class, 'import'])->name('import.data');
    Route::post('/import/modepaiement', [ImportController::class, 'importModePaiement'])->name('import.data1');


    // Import database client
    // Route::get('/import/client', [ImportController::class, 'listCustomer'])->name('import.index.customer');
    Route::post('/import/creer/client', [ImportController::class, 'importCustomer'])->name('import.data.customer');
    Route::post('/import/donnee/client', [ImportController::class, 'importclient'])->name('importclient.data');
    Route::post('/import/donnee/particulier', [ImportController::class, 'importParticular'])->name('importparticular.data');
    Route::post('/import/donnee/livreur', [ImportController::class, 'importLivreur'])->name('importlivreur.data');
    Route::post('/import/donnee/menu', [ImportController::class, 'menu'])->name('importmenu.data');
    Route::post('/import/donnee/commande', [ImportController::class, 'order'])->name('importorder.data');
    Route::post('/import/donnee/typepack', [ImportController::class, 'typePack'])->name('importtypepack.data');
    Route::post('/import/donnee/adresse', [ImportController::class, 'importAddressBook'])->name('importaddressbook.data');
    Route::post('/import/donnee/receptionnaire', [ImportController::class, 'importReceptionnaire'])->name('importreceptionnaire.data');



    Route::get('/statistics', [HomeController::class, 'turnOverPerMonth'])->name('statistics');
    Route::get('/statistics1', [HomeController::class, 'pack'])->name('statistics1');
    Route::get('/statistics2', [HomeController::class, 'orderPerdateCanva'])->name('statistics2');

    Route::get('/survey/register', [SurveyController::class, 'index'])->name('survey');
    Route::post('/survey/submit', [SurveyController::class, 'create'])->name('create.survey');
});
