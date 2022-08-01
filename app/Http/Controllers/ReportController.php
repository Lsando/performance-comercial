<?php

namespace App\Http\Controllers;

use App\Models\Fatura;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use stdClass;

class ReportController extends Controller
{
   public function getReport(Request $request)
   {
        $object = [];
        // return $request->all();
        $key=0;
        foreach($request->users as $user_id){

            
            // $object->result=[];
            // $object->total_receita=0;
    
    
            $sql = 'SELECT u.no_usuario, CONCAT(YEAR(f.data_emissao), " ", MONTHNAME (f.data_emissao)) AS periodo, SUM(f.total - (f.total * f.total_imp_inc)) AS receita_liquida, s.brut_salario AS custo_fixo, f.valor - (f.valor * f.total_imp_inc) * f.comissao_cn AS comissao  
            FROM cao_fatura f JOIN cao_os os  ON os.co_os = f.co_os  JOIN users u ON os.co_usuario = u.co_usuario  
            JOIN cao_salario s ON s.co_usuario = u.co_usuario
            WHERE u.co_usuario = ? AND f.data_emissao BETWEEN ? AND ?  GROUP BY f.data_emissao';
    
            $result = DB::select($sql, [$user_id,$request->start_date, $request->end_date]);
            // dd($result);
            $temp=[];
            if(count($result) > 0){
                foreach($result as $row){
                    $lucro = $row->receita_liquida - ($row->custo_fixo + $row->comissao);
                    array_push($temp,[
                        'consultor' => $row->no_usuario,
                        'periodo' => $row->periodo,
                        'receita_liquida' => number_format($row->receita_liquida,2,',','.'),
                        'custo_fixo' => number_format($row->custo_fixo,2,',','.'),
                        'comissao' => number_format($row->comissao,2,',','.'),
                        'lucro' => number_format($lucro,2,',','.')
                    ]);
                    $object[$key] = ['data'=>$temp];
                    // dd($object->result[$key] );
                }
            }
            $key++;
        }

        return $object;

   }

   public function get_pizza_report(Request $request)
   {
        $object = [];
        $key=0;
        foreach($request->users as $user_id){
            $total_receita = DB::table('cao_fatura')->sum('total');
            $sql = 'SELECT sum(f.valor - (f.valor * f.total_imp_inc)) AS receita, u.no_usuario   FROM cao_fatura f JOIN cao_os os  ON os.co_os = f.co_os  JOIN users u ON os.co_usuario = u.co_usuario  
            JOIN cao_salario s ON s.co_usuario = u.co_usuario WHERE f.data_emissao BETWEEN ? AND ? AND u.co_usuario = ?
            GROUP BY u.no_usuario';

            $data = DB::select($sql, [$request->start_date, $request->end_date,$user_id]);

            $report = new stdClass;
            $report->total = $total_receita;
            $report->x_values=array();
            $report->y_values=array();
            if(count($data) > 0){
                foreach($data as $row){
                    // $percentual = (100*$row->receita)/$total_receita;
                    // $percentual = $percentual*100;
                    array_push($report->y_values, number_format($row->receita,2,',','.'));
                    array_push($report->x_values, $row->no_usuario);
                }
            }
            $object = [
                'x_values' => $report->x_values,
                'y_values' => $report->y_values,
                'total' => $total_receita
            ];
            $key++;

        }
        return $object;

   }


}
