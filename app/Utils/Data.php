<?php

namespace App\Utils;

class Data {

    /**
     * VERIFICA SE A DATAI É MAIOR QUE A DATAF, USADO APENAS NO LOGIN PARA BLOQUEAR O ACESSO AO SISTEMA SE A 
     * VERSÃO TRIAL FOR EXPIRADA
     */
    public static function dataMenor($dataI, $dataF){
        if(strtotime($dataI) > strtotime($dataF)) {
            return false;
        }
        return true;
    }

    public static function addDiaDataAtual($dias) {
        return date('Y-m-d', strtotime('+'.$dias.' days'));
    }

    public static function addMesDataAtual($mes, $operacao = "+") {
        if ($operacao == "+") {
            return date('Y-m-d', strtotime('+'.$mes.' month'));
        } else {
            return date('Y-m-d', strtotime('-'.$mes.' month'));
        }
    }

    public static function lasDayMonth($date = ""){
        if ($date != "") {
            $lastDay = $date->format("Y-m-t");
        } else {
            $date = new \DateTime('now');
            $lastDay = $date->format("Y-m-t");
        }
        return $lastDay;
    }

    public static function firstDayMonth($date = ""){
        if ($date != "") {
            $lastDay = $date->format("Y-m")."-01";
        } else {
            $date = new \DateTime('now');
            $lastDay = $date->format("Y-m")."-01";
        }
        return $lastDay;
    }

    /**
     * SUBTRAIR MINUTOS DE UMA DATA INFORMADA COM HORA
     * @$data = Y-m-d H:i:s
     * @$minutos = 120
     */
    public static function subtrairTempo($data, $minutos){
        $timestamp = strtotime($data);
        $tempo = (0 * 3600) + ($minutos * 60) + 0;
        $novaDataHora= $timestamp - $tempo;
        return date("Y-m-d H:i:s", $novaDataHora);
    }

}