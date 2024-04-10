<?php

namespace App\Utils;

use Illuminate\Support\Facades\DB;

class Mysql {
    public static function selectDadosSolicitacaoServicoRelatorio(){
        return 
        "DATAHORAINICIO,
        DATAHORAFIM,
        DATAHORASOLICITANTE,
        DESCRICAOSERVICO,
        LOCALSOLICITANTE,
        MAQUINADESCRICAO,
        MAQUINAPARADA,
        MAQUINASPRODUCAO_ID,
        MECANICO,
        MOTIVO,
        ORDEMSERVICO,
        SOLICITANTESERVICO_ID,
        STATUS,
        TIPOSERVICO
        ";
    }

    public static function getDadosSolicitacaoServicoRelatorio($ano, $mes, $dia, $mecanico){
        $select = 
        "SELECT 
        ".self::selectDadosSolicitacaoServicoRelatorio()."
        FROM SOLICITACAOSERVICO 
       WHERE YEAR(SOLICITACAOSERVICO.DATAHORASOLICITANTE) = ? 
         AND MONTH(SOLICITACAOSERVICO.DATAHORASOLICITANTE) = ? ";
        $parameters = [$ano, $mes];
        if($dia){
            $select .= 
        "AND DAY(SOLICITACAOSERVICO.DATAHORASOLICITANTE) = ? "; 
            $parameters[] = $dia;
        };

        if($mecanico){
            $select .= 
        "AND SOLICITACAOSERVICO.MECANICO = ? "; 
            $parameters[] = $mecanico;
        };

        $query = DB::select($select, $parameters);
        // dd($query);
        return $query;
    }

    
}