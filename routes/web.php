<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\AssignationController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\IndexController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\ConsultController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HistoriqueController;
use App\Models\User;

use App\Http\Controllers\TicketController;
use App\Models\Produit;
use App\Http\Controllers\GererStocks;

use App\Http\Controllers\AjoutCategorie;
use App\Http\Controllers\AjoutFournisseur;
use App\Http\Controllers\LocalisationController;
use App\Models\Salle;

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
// Routes d'authenfification.
Auth::routes();

// Route de réinitialisation
Route::get('mdp', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post');
Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');

// Déconnexion

Route::get('/deconnexion', [LoginController::class, 'deconnexion'])->middleware('auth');

// Route du menu de base

Route::get('',function(){
    return redirect('/menu');
});
Route::get('/menu', IndexController::class)->name('index')->middleware('auth');

// Route de la gestion utlisateur

Route::get('/getTableData', [UserController::class, 'getTableData']);
Route::get('/menu/user', UserController::class)->name('user')->middleware('auth.admin');

Route::delete('/menu/user/{id}', function($id){
    User::where('id','=',$id)->delete();
    return response('ok', 200)->middleware('auth.admin');
});
Route::patch('/menu/user/{id}', function($id){
    User::where('id','=',$id)->restore();
    return response('ok', 200)->middleware('auth.admin');
});
Route::get('/UserData', [UserController::class, 'UserData'])->middleware('auth.admin');
Route::get('/privilegeNom',[UserController::class, 'privilegeNom'])->middleware('auth.admin');

Route::get('editUser/{id}', [UserController::class, 'editUser'])->name('edit');

Route::put('updateUser/{id}', [UserController::class, 'updateUser']);


// Route du QR-Code provisoire
Route::get('menu/QrCode/GenererQrCodeBoite', PDFController::class)->name('GenererQrCodeBoite')->middleware('auth.admin');
Route::get('/QrCode/genererQrCode', [PDFController::class,'index'])->name('qrCode');
Route::get('ProduitData', [PDFController::class, 'ProduitData'])->middleware('auth.admin');
Route::post('/downloadQrCode',[PDFController::class, 'downloadQrCode'])->name('downloadQrCode');


// Route de la gestion de stock

Route::get('/consultstock', ConsultController::class)->middleware('auth')->name('consult');
Route::get('/getConsultTable', [ConsultController::class, 'getConsultTableData'])->middleware('auth');
Route::get('/produitlocation/{id}', [ConsultController::class, 'produitLocalisation'])->middleware('auth');
Route::get('/getLocalisationTable/{id}', [ConsultController::class, 'getLocalisationTableData'])->middleware('auth');








// Route de l'assignation des batiments, salles, zones

Route::get('/assignation', AssignationController::class)->name('assignation')->middleware('auth.admin');
Route::get('/assignation/nom', [AssignationController::class, 'nommage'])->name('assign.name')->middleware('auth.admin');
Route::get('/assignation/batiment', [AssignationController::class, 'assignationBatiment'])->name('assign.batiment')->middleware('auth.admin');
Route::get('/assignation/salle', [AssignationController::class, 'assignationSalle'])->name('assign.salle')->middleware('auth.admin');
Route::get('/assignation/sallezoom/{id}', [AssignationController::class, 'assignationSalleZoom'])->middleware('auth.admin');
Route::get('/assignation/zone', [AssignationController::class, 'assignationZone'])->name('assign.zone')->middleware('auth.admin');
Route::get('/assignation/zonezoom/{id}', [AssignationController::class, 'assignationZoneZoom'])->middleware('auth.admin');

//Route::get('/assignation/sallezoom/nom/{idbatiment}', [AssignationController::class, 'getSalleNameOfBatiment'])->middleware('auth.admin');
/*Route::get('/assignation/salle/{id}', [AssignationController::class, 'assignationSalle'])->middleware('auth.admin');
Route::get('/assignation/salle/', function(){
    return redirect('/assignation/salle/1');
})->name('assign.salle')->middleware('auth.admin');
*/
/*Route::get('/assignation/zone/{id}', [AssignationController::class, 'assignationZone'])->middleware('auth.admin');
Route::get('/assignation/zone/', function(){
    return redirect('/assignation/zone/1');
})->name('assign.zone')->middleware('auth.admin');*/

Route::get('/batiment/nom', [AssignationController::class, 'getBatimentName'])->middleware('auth.admin');
Route::get('/salle/nom/{idbatiment}', [AssignationController::class, 'getSalleNameOfBatiment'])->middleware('auth.admin');
Route::get('/zone/nom/{idbatiment}', [AssignationController::class, 'getZoneNameOfBatiment'])->middleware('auth.admin');
Route::put('/assignation/store/planglobal',[AssignationController::class, 'storePlanGlobal'])->middleware('auth.admin');
Route::put('/assignation/store/plan/Salle/',[AssignationController::class, 'storePlanSalle'])->middleware('auth.admin');
Route::put('/assignation/store/plan/Zone/',[AssignationController::class, 'storePlanZone'])->middleware('auth.admin');
Route::post('/assignation/storeCoordBatiment',[AssignationController::class, 'storeCoordBatiment'])->middleware('auth.admin');
//Route::put('/assignation/storeCoordBatiment',[AssignationController::class, 'storeCoordBatiment'])->middleware('auth.admin');


Route::post('/assignation/storeCoordSalle',[AssignationController::class, 'storeCoordSalle'])->middleware('auth.admin');
Route::post('/assignation/removeSalle',[AssignationController::class, 'removeSalle'])->middleware('auth.admin');

Route::post('/assignation/storeCoordZone',[AssignationController::class, 'storeCoordZone'])->middleware('auth.admin');
Route::post('/assignation/removeZone',[AssignationController::class, 'removeZone'])->middleware('auth.admin');

Route::put('/assignation/store/salle',[AssignationController::class, 'storeSalle'])->middleware('auth.admin');
Route::put('/assignation/store/zone',[AssignationController::class, 'storeZone'])->middleware('auth.admin');
Route::post("/assignation/updatenomsbatiments", [AssignationController::class, 'changeBatimentName'])->middleware('auth.admin');
Route::get('/assignation/plan/{name}', function($name){
    $image = file(public_path("images/plan/$name"));
    return response()-> file(public_path("images/plan/$name"));
})->middleware('auth.admin');

Route::get('/get/canvasglobal', function(){
    if (file_exists(public_path('storage/storePlanGlobal.json'))){
        return response() ->file(public_path('storage/storePlanGlobal.json'));
    }
    else{
        return response('canvas inexistante',404);
    }

})->middleware('auth.admin');
Route::get('get/canvassalle',[AssignationController::class, 'storePlanSalle'])->middleware('auth.admin');
Route::get('get/canvaszone',[AssignationController::class, 'storePlanZone'])->middleware('auth.admin');







//Route de la localisation

Route::get('getBatiment',[LocalisationController::class, 'getBatiment'])->name('getBatiment');
Route::get('getSalle',[LocalisationController::class, 'getSalle'])->name('getSalle');
Route::get('getZone',[LocalisationController::class, 'getZone'])->name('getZone');
Route::get('salle/{idz}',[LocalisationController::class, 'salle'],function($idz){
    Salle::where('batiment_id','=',$idz)->get();
});

Route::get('getSub',[LocalisationController::class, 'getSub'])->name('getSub');
Route::get('getSub2',[LocalisationController::class, 'getSub2'])->name('getSub2');
Route::get('getProd',[LocalisationController::class, 'getProd'])->name('getProd');
Route::post('creerBoite',[LocalisationController::class, 'creerBoite'])->name('creerBoite');
Route::get('/menu/GestionBoites', [LocalisationController::class,'index'])->name('GestionBoites')->middleware('auth.admin');
Route::get('getQuantite',[LocalisationController::class, 'getQuantite'])->name('getQuantite');
Route::get('getImgBat',[LocalisationController::class, 'getImgBat'])->name('getImgBat');
Route::get('editBoite/{id}', [LocalisationController::class, 'editBoite'])->name('editBoite');
Route::put('updateBoite/{id}',[LocalisationController::class, 'updateBoite']);
Route::get('/ajoutBoites', [LocalisationController::class, 'localisation'])->name('ajoutBoites')->middleware('auth.admin');
Route::get('boiteData', [LocalisationController::class ,'boiteData']);



// Route du ticket

Route::get('get', [TicketController::class, 'getListe']);
Route::post('popup', [TicketController::class, 'popup'])->name('popup');
Route::get('downloadTicket', [PDFController::class, 'downloadTicket'])->name('downloadTicket');
//Route::post('downloadTicket', [PDFController::class, 'downloadTicket'])->name('downloadTicket');
Route::get('/menu/ticket', [TicketController::class ,'index'])->name('ticket')->middleware('auth.admin');;

Route::get('getSub',[TicketController::class, 'getSub'])->name('getSub');
Route::get('getSub2',[TicketController::class, 'getSub2'])->name('getSub2');
Route::get('getProd',[TicketController::class, 'getProd'])->name('getProd');
Route::get('getReference',[TicketController::class, 'getReference'])->name('getReference');


// Gestion de stocks

Route::get('/getTableData', [GererStocks::class, 'getTableData']);

Route::get('menu/gestionStocks', [GererStocks::class, 'gestionStocks'])->name('gestionStocks')->middleware('auth.admin');

Route::get('get', [GererStocks::class, 'get']);

Route::delete('/gestionStocks/index/{id}', function($id){
    Produit::where('id','=',$id)->delete();
    return response('ok',200);
});

Route::patch('/gestionStocks/index/{id}', function($id){
    Produit::where('id','=',$id)->restore();
    return response('ok', 200);
});

Route::get('getCategorie', [GererStocks::class, 'getCategorie']);

Route::get('/ajout', [GererStocks::class, 'ajout'])->name('ajout')->middleware('auth.admin');

Route::get('edit/{id}', [GererStocks::class, 'edit'])->name('edit');

Route::put('update/{id}', [GererStocks::class, 'update']);

Route::post('/ajout', [GererStocks::class, 'create']);

Route::post('ajoutCategorie', [AjoutCategorie::class, 'create'])->name('categorie.ajout');

Route::post('ajoutFournisseur', [AjoutFournisseur::class, 'create'])->name('fournisseur.ajout')->middleware('auth.admin');

Route::get('upload-image', [GererStocks::class, 'index']);

Route::post('save', [GererStocks::class, 'save']);

Route::get('getSub',[GererStocks::class, 'getSub'])->name('getSub');

Route::get('getSub2',[GererStocks::class, 'getSub2'])->name('getSub2');

Route::get('getSub3',[GererStocks::class, 'getSub3'])->name('getSub3');

Route::get('getSub4',[GererStocks::class, 'getSub4'])->name('getSub4');

Route::get('getSub4',[GererStocks::class, 'getSub5'])->name('getSub5');

Route::get('/ajoutImage', [GererStocks::class, 'index']);

Route::post('upload', [GererStocks::class, 'upload'])->name('file.upload');

// Route historique

Route::get('/historique', [HistoriqueController::class,'__invoke'])->name('historique');

Route::get('/Historique', [HistoriqueController::class,'Historique']);


