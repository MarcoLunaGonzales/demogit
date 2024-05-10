<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AccountPlan;
use App\Area;
use App\Charge;
use App\ChargeFunction;
use App\ExternalFinancingProject;
use App\OrganizationalUnit;
use App\Staff;
use App\CourseType;
use App\EconomicSector;
use App\Sorter;
use App\Course;
use DB;

class ConsumptionServiceController extends Controller
{
    
    /*******************************************************/
    /*                      FINANCIERO                     */
    /*******************************************************/
    /**
     * Lista de Plan de Cuentas
     * method: GET
     * @author Ronald Mollericona
     **/
    public function listAccountPlan(){
        $data = AccountPlan::where('cod_estadoreferencial', '=', 1)->get();
        return response()->json([
                'data'  => $data
        ]);
    }
    /**
     * Lista de Areas
     * method: GET
     * @author Ronald Mollericona
     **/
    public function listArea(){
        $data = Area::where('cod_estado', 1)->get();
        return response()->json([
                'data'  => $data
        ]);
    }
    /**
     * Lista de Cargos
     * method: GET
     * @author Ronald Mollericona
     **/
    public function listCharge(){
        $data = Charge::where('cod_estadoreferencial', 1)->get();
        return response()->json([
                'data'  => $data
        ]);
    }
    /**
     * Lista de Funciones de Cargos
     * method: GET
     * @author Ronald Mollericona
     **/
    public function listChargeFunction(){
        $data = ChargeFunction::where('cod_estado', 1)->get();
        return response()->json([
                'data'  => $data
        ]);
    }
    /**
     * Lista de Proyecto Financiación External
     * method: GET
     * @author Ronald Mollericona
     **/
    public function listExternalFinancingProject(){
        $data = ExternalFinancingProject::where('cod_estadoreferencial', 1)->get();
        return response()->json([
                'data'  => $data
        ]);
    }
    /**
     * Lista de Unidad Organizacional
     * method: GET
     * @author Ronald Mollericona
     **/
    public function listOrganizationalUnit(){
        $data = OrganizationalUnit::where('cod_estado', 1)->get();
        return response()->json([
                'data'  => $data
        ]);
    }
    /**
     * Lista de Personal
     * method: GET
     * @author Ronald Mollericona
     **/
    public function listStaff(){
        $data = Staff::where('cod_estadoreferencial', 1)->get();
        return response()->json([
                'data'  => $data
        ]);
    }
    /**
     * Lista de Tipos de Cursos
     * method: GET
     * @author Ronald Mollericona
     **/
    public function listCourseType(){
        $data = CourseType::get();
        return response()->json([
                'data'  => $data
        ]);
    }
    /**
     * Lista de Cursos
     * method: GET
     * @author Ronald Mollericona
     **/
    public function listCourse(){
        $data = Course::get();
        return response()->json([
                'data'  => $data
        ]);
    }
    /*******************************************************/
    /*                      MONITOREO                      */
    /*******************************************************/
    /**
     * Lista de Sectores Económicos
     * method: GET
     * @author Ronald Mollericona
     **/
    public function listEconomicSector(){
        $data = EconomicSector::on('mysql2')->get();
        return response()->json([
                'data'  => $data
        ]);
    }
    /*******************************************************/
    /*                      IBNORCA                        */
    /*******************************************************/
    /**
     * Lista de Tipos de Curso
     * method: GET
     * @author Ronald Mollericona
     **/
    public function listCourseTypeIbn(){
        $data = Sorter::on('mysql3')->where('IdPadre', 110)->where('Aprobado', 1)->get();
        return response()->json([
                'data'  => $data
        ]);
    }
    /**
     * Lista de Programas de formación
     * method: GET
     * @author Ronald Mollericona
     **/
    public function listProgramIbn(){
        $data = Sorter::on('mysql3')->where('IdPadre', 52)->where('Aprobado', 1)->get();
        return response()->json([
                'data'  => $data
        ]);
    }
    /**
     * Verificación de tabla PROGRAMA & TIPO CURSO
     * method: POST
     * @author Ronald Mollericona
     **/
    public function verfTable(Request $request){
        /*TIPOS DE CURSO*/
        $course = Sorter::on('mysql3')->where('IdPadre', 110)->where('Aprobado', 1)->get();

        /*PROGRAMAS DE FORMACION*/
        $program = Sorter::on('mysql3')->where('IdPadre', 52)->where('Aprobado', 1)->get();

        $arrayCourse  = $this->searchArray($course, $request->dataCourse);
        $arrayProgram = $this->searchArray($program, $request->dataProgram);

        $status = false;
        if(count($arrayCourse)==0 && count($arrayProgram)==0){
            $status = true;
        }
        
        return response()->json([
            'arrayCourse'   => $arrayCourse,
            'arrayProgram'  => $arrayProgram,
            'status'        => $status
        ]);
    }
    // Buscador de DATOS
    public function searchArray($arrayObj, $arraySearch){
        // Array Curso
        $array = [];
        foreach($arraySearch as $data){
            $verf = false;
            // Verificación de datos en array de OBJETO (BUSCAR->CONSULTA)
            foreach($arrayObj as $value){
                if($value->IdClasificador == $data){
                    $verf = true;
                }
            }
            // Verificamos que datos no se encontraron en la BASE DE DATOS
            if(!$verf){
                $array[] = $data;
            }
        }

        return $array;
    }
}
