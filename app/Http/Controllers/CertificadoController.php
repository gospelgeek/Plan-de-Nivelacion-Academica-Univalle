<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DateTime;
use DateTimeZone;

class CertificadoController extends Controller
{
    public function _constructor()
    {
    }

    public function index()
    {
        return view("graphics.formularioCertificado");
    }

    public function certificado(Request $request)
    {
        //define('REPCLAVE', '6LeQQvYgAAAAAHvwSUCVLu3MlhhprTlz7ssVbFd2');
        //$clave = "6LeQQvYgAAAAAHvwSUCVLu3MlhhprTlz7ssVbFd2";
        $id = $request['iden'];
        $token = $request['token'];
        $action = $request['action'];

        $cu = curl_init();
        curl_setopt($cu, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
        curl_setopt($cu, CURLOPT_POST, 1);
        curl_setopt($cu, CURLOPT_POSTFIELDS, http_build_query(array("secret" => '6LeQQvYgAAAAAMKxKF7saDzvFcwgTilQk5eZbIMh', "response" => $token)));
        curl_setopt($cu, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($cu);
        curl_close($cu);

        $datos = json_decode($response, true);

        //dd($datos['success']);
        if ($datos['success'] == true && $datos['score'] >=0.9) {
            $now = new DateTimeZone("America/Bogota");
            $fecha = new DateTime("now", $now);
            $actual = $fecha->format('Y-m-d');

            $consulta = DB::select("SELECT id, name as nombre, lastname as apellidos, 
            (SELECT document_type.name FROM document_type WHERE document_type.id = 
            student_profile.id_document_type) as tipo_documento, document_number as numero_identificacion, 
            (SELECT (SELECT name FROM groups WHERE groups.id = student_groups.id_group) 
            FROM student_groups WHERE student_groups.id_student = student_profile.id) as grupo, 
            (SELECT (SELECT (SELECT name FROM cohorts WHERE cohorts.id = groups.id_cohort) 
            FROM groups WHERE groups.id = student_groups.id_group) FROM student_groups 
            WHERE student_groups.id_student = student_profile.id) as linea FROM student_profile 
            WHERE student_profile.document_number = ?", [$id]);

            //dd($consulta);

            $pdf = PDF::loadView('graphics.certificadoPDF', [
                "data" => $consulta,
                "fecha" => $actual
            ]);
            //download
            //return $pdf->stream("certificado.pdf");
            return $pdf->download("certificado.pdf");
        }else {
            return "No pasaste la verificacion del Recaptcha";
        }
    }
}
