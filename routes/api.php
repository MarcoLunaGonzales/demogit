<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

// FINANCIERO
Route::get('lista/plan-cuentas', 'ConsumptionServiceController@listAccountPlan');
Route::get('lista/areas', 'ConsumptionServiceController@listArea');
Route::get('lista/cargos', 'ConsumptionServiceController@listCharge');
Route::get('lista/cargos-funciones', 'ConsumptionServiceController@listChargeFunction');
Route::get('lista/financiacion-externa', 'ConsumptionServiceController@listExternalFinancingProject');
Route::get('lista/unidad-organizacional', 'ConsumptionServiceController@listOrganizationalUnit');
Route::get('lista/personal', 'ConsumptionServiceController@listStaff');
Route::get('lista/tipos-cursos', 'ConsumptionServiceController@listCourseType');
Route::get('lista/cursos', 'ConsumptionServiceController@listCourse');
// MONITOREO
Route::get('lista/sectores-economicos', 'ConsumptionServiceController@listEconomicSector');
// IBNORCA
Route::get('lista/tipos-cursos-ibnorca', 'ConsumptionServiceController@listCourseTypeIbn');
Route::get('lista/programas-ibnorca', 'ConsumptionServiceController@listProgramIbn');
Route::post('validacion-tabla', 'ConsumptionServiceController@verfTable');