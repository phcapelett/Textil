<?php

namespace App\Utils;

use Illuminate\Support\Facades\DB;

class Linx {
    public static function getContasAPagar(){
        return "
        FILIAIS_LANCAMENTO.FILIAL AS [FILIAL],
        CADASTRO_CLI_FOR.NOME_CLIFOR AS [CLIENTE], 
        CTB_A_PAGAR_PARCELA.VENCIMENTO AS [VENCIMENTO], 
        CTB_A_PAGAR_PARCELA.VALOR_ORIGINAL_PADRAO AS [VALOR ORI PADRAO], 
        W_CTB_A_PAGAR_PARCELA_SALDO.TOTAL_PRINCIPAL_PAGO AS [TOTAL PRIN PAGO], 
        W_CTB_A_PAGAR_PARCELA_SALDO.VALOR_A_PAGAR_PADRAO AS [VALOR PAG PADRAO], 
        POSICAO = 
        CASE 
            WHEN DATEDIFF(DD, W_CTB_A_PAGAR_PARCELA_SALDO.VENCIMENTO_REAL, GETDATE()) > 0 THEN 'VENCIDO'
            WHEN DATEDIFF(DD, W_CTB_A_PAGAR_PARCELA_SALDO.VENCIMENTO_REAL, GETDATE()) < 0 THEN 'A VENCER'
            WHEN DATEDIFF(DD, W_CTB_A_PAGAR_PARCELA_SALDO.VENCIMENTO_REAL, GETDATE()) = 0 THEN 'VENCENDO HOJE'
        END
        ";
    }

    public static function buscarContasAPagar(){
        $select = "SELECT ".self::getContasAPagar()."

              FROM CTB_A_PAGAR_PARCELA 
        
        INNER JOIN CTB_A_PAGAR_FATURA 
                ON CTB_A_PAGAR_PARCELA.EMPRESA = CTB_A_PAGAR_FATURA.EMPRESA 
               AND CTB_A_PAGAR_PARCELA.LANCAMENTO = CTB_A_PAGAR_FATURA.LANCAMENTO 
               AND CTB_A_PAGAR_PARCELA.ITEM = CTB_A_PAGAR_FATURA.ITEM 
        
        INNER JOIN W_CTB_A_PAGAR_PARCELA_SALDO 
                ON CTB_A_PAGAR_PARCELA.EMPRESA = W_CTB_A_PAGAR_PARCELA_SALDO.EMPRESA 
               AND CTB_A_PAGAR_PARCELA.LANCAMENTO = W_CTB_A_PAGAR_PARCELA_SALDO.LANCAMENTO
               AND CTB_A_PAGAR_PARCELA.ITEM = W_CTB_A_PAGAR_PARCELA_SALDO.ITEM 
               AND CTB_A_PAGAR_PARCELA.ID_PARCELA = W_CTB_A_PAGAR_PARCELA_SALDO.ID_PARCELA
        
        INNER JOIN CTB_LANCAMENTO_ITEM 
                ON CTB_A_PAGAR_PARCELA.EMPRESA = CTB_LANCAMENTO_ITEM.EMPRESA 
               AND CTB_A_PAGAR_PARCELA.LANCAMENTO = CTB_LANCAMENTO_ITEM.LANCAMENTO 
               AND CTB_A_PAGAR_PARCELA.ITEM = CTB_LANCAMENTO_ITEM.ITEM 
        
        INNER JOIN CTB_LANCAMENTO 
                ON CTB_LANCAMENTO.EMPRESA = CTB_LANCAMENTO_ITEM.EMPRESA 
               AND CTB_LANCAMENTO.LANCAMENTO = CTB_LANCAMENTO_ITEM.LANCAMENTO 
        
        INNER JOIN CTB_CONTA_PLANO 
                ON CTB_LANCAMENTO_ITEM.CONTA_CONTABIL = CTB_CONTA_PLANO.CONTA_CONTABIL 
        
        INNER JOIN CTB_LX_LANCAMENTO_TIPO 
                ON CTB_LANCAMENTO_ITEM.LX_TIPO_LANCAMENTO = CTB_LX_LANCAMENTO_TIPO.LX_TIPO_LANCAMENTO
        
        INNER JOIN FILIAIS 
                ON CTB_A_PAGAR_FATURA.COD_FILIAL = FILIAIS.COD_FILIAL 
        
        INNER JOIN CADASTRO_CLI_FOR AS F 
                ON FILIAIS.FILIAL = F.NOME_CLIFOR 
        
        INNER JOIN CADASTRO_CLI_FOR 
                ON CTB_A_PAGAR_FATURA.COD_CLIFOR = CADASTRO_CLI_FOR.COD_CLIFOR 
        
         LEFT JOIN CADASTRO_CLI_FOR CADASTRO_CLI_FOR_SACADO 
                ON CTB_A_PAGAR_FATURA.COD_CLIFOR_SACADO = CADASTRO_CLI_FOR_SACADO.COD_CLIFOR 
        
        INNER JOIN FILIAIS FILIAIS_LANCAMENTO 
                ON CTB_LANCAMENTO.COD_FILIAL = FILIAIS_LANCAMENTO.COD_FILIAL 
        
         LEFT JOIN FORNECEDORES 
                ON CADASTRO_CLI_FOR.COD_CLIFOR = FORNECEDORES.COD_FORNECEDOR 
        
         LEFT JOIN CTB_MOVIMENTO_TIPO 
                ON CTB_LANCAMENTO.TIPO_MOVIMENTO = CTB_MOVIMENTO_TIPO.TIPO_MOVIMENTO

             WHERE W_CTB_A_PAGAR_PARCELA_SALDO.VALOR_A_PAGAR_PADRAO > '0'
               AND DATEDIFF (DAY,GETDATE(),CTB_A_PAGAR_PARCELA.VENCIMENTO) > '-60'
               AND DATEDIFF (DAY,GETDATE(),CTB_A_PAGAR_PARCELA.VENCIMENTO) < '60'
        ";

        // dd($select);
        $query = DB::connection('linx')->select($select);
        // dd($query);
        return $query;
    }

    public static function getContasPagas(){
        return "
        CASE
            WHEN W_CTB_A_PAGAR_PARCELA_MOV.COD_FILIAL = '003000' THEN 'LBR'
            WHEN W_CTB_A_PAGAR_PARCELA_MOV.COD_FILIAL = '022901' THEN 'KVZ'
            WHEN W_CTB_A_PAGAR_PARCELA_MOV.COD_FILIAL = '000031' THEN 'BR5'
            WHEN W_CTB_A_PAGAR_PARCELA_MOV.COD_FILIAL = '000041' THEN 'FILIAL'
            ELSE 'W_CTB_A_PAGAR_PARCELA_MOV.COD_FILIAL'
        END AS [UNIDADE],
        RTRIM(W_CTB_A_PAGAR_PARCELA_MOV.NOME_CLIFOR) AS [CLIENTE],  
        W_CTB_A_PAGAR_PARCELA_MOV.DATA_PAGAMENTO AS [DATA PAGAMENTO],
        W_CTB_A_PAGAR_PARCELA_MOV.VENCIMENTO AS [VENCIMENTO],
        --RTRIM(DATEPART(YEAR, W_CTB_A_PAGAR_PARCELA_MOV.VENCIMENTO)) AS [ANO],
        --RTRIM(DATEPART(MONTH, W_CTB_A_PAGAR_PARCELA_MOV.VENCIMENTO)) AS [MÊS],
        --RTRIM(DATEPART(DAY, W_CTB_A_PAGAR_PARCELA_MOV.VENCIMENTO)) AS [DIA],
        RTRIM(W_CTB_A_PAGAR_PARCELA_MOV.FATURA) AS [FATURA],
        W_CTB_A_PAGAR_PARCELA_MOV.VALOR_A_PAGAR_PADRAO AS [A PAGAR PADRAO],
        W_CTB_A_PAGAR_PARCELA_MOV.TOTAL_PRINCIPAL_PAGO AS [TOTAL PAGO],
        W_CTB_A_PAGAR_PARCELA_MOV.VALOR_FINANCEIRO AS [VALOR FINANCEIRO]
        ";
    }

    public static function buscarContasPagas(){
        $select = "SELECT ".self::getContasPagas()."
        FROM W_CTB_A_PAGAR_PARCELA_MOV 

        WHERE W_CTB_A_PAGAR_PARCELA_MOV.DATA_PAGAMENTO >= DATEFROMPARTS(YEAR(GETDATE()) -2 , 1, 1)
            AND W_CTB_A_PAGAR_PARCELA_MOV.DATA_PAGAMENTO <= GETDATE()
            AND ( W_CTB_A_PAGAR_PARCELA_MOV.EMPRESA = 1 )
        ";
        // dd($select);
        $query = DB::connection('linx')->select($select);
        // dd($query);
        return $query;
    }

    public static function getDOCEtiqueta(){
        return "
            --ESTOQUE_PROD1_ENT.FILIAL,
            --ESTOQUE_PROD1_ENT.TAREFA, 
            RTRIM(ESTOQUE_PROD1_ENT.ORDEM_PRODUCAO) AS [OP], 
            RTRIM(ESTOQUE_PROD1_ENT.ROMANEIO_PRODUTO) AS [ROM], 
            FORMAT(ESTOQUE_PROD1_ENT.DATA_PARA_TRANSFERENCIA, 'dd-MM-yyyy') AS [MOVIMENTO],
            RTRIM(ESTOQUE_PROD1_ENT.PRODUTO) AS [PRODUTO],
            RTRIM(PRODUTOS.DESC_PRODUTO) AS [DESCPRODUTO], 
            --PRODUTOS.GRADE, 
            RTRIM(ESTOQUE_PROD1_ENT.COR_PRODUTO) AS [COR], 
            RTRIM(PRODUTO_CORES.DESC_COR_PRODUTO) AS [DESCCOR],
            ESTOQUE_PROD1_ENT.EN_1 AS [XS], 
            ESTOQUE_PROD1_ENT.EN_2 AS [S], 
            ESTOQUE_PROD1_ENT.EN_3 AS [M], 
            ESTOQUE_PROD1_ENT.EN_4 AS [L], 
            ESTOQUE_PROD1_ENT.EN_5 AS [XL], 
            ESTOQUE_PROD1_ENT.EN_6 AS [XXL], 
            ESTOQUE_PROD1_ENT.EN_7 AS [XXXL],
            ESTOQUE_PROD1_ENT.QTDE AS [TOTAL]
        " ;
    }

    public static function buscarEtiquetaDOC($ndocumento){
        $select = "SELECT ".self::getDOCEtiqueta()."
        FROM  
            PRODUTOS AS PRODUTOS, 
            PRODUTO_CORES AS PRODUTO_CORES, 
            {OJ  ESTOQUE_PROD1_ENT AS ESTOQUE_PROD1_ENT  
            LEFT OUTER JOIN DBO.MODIFICACAO_FICHA_TECNICA AS MODIFICACAO_FICHA_TECNICA  
            ON  ESTOQUE_PROD1_ENT.ID_MODIFICACAO = MODIFICACAO_FICHA_TECNICA.ID_MODIFICACAO}
        
        WHERE ((PRODUTOS.PRODUTO = ESTOQUE_PROD1_ENT.PRODUTO 
            AND  ESTOQUE_PROD1_ENT.PRODUTO = PRODUTO_CORES.PRODUTO ) 
            AND  ESTOQUE_PROD1_ENT.COR_PRODUTO = PRODUTO_CORES.COR_PRODUTO ) 
            AND  (ESTOQUE_PROD1_ENT.ROMANEIO_PRODUTO = '".$ndocumento."' 
            AND  ESTOQUE_PROD1_ENT.FILIAL = '2A QUALIDADE') ";
        // dd($select);
        $query = DB::connection('linx')->select($select);
        // dd($query);
        return $query;
    }

    public static function getFieldsRequisicao($produto, $cor){
        return "
        RTRIM(EPE.PRODUTO) AS [REFERENCIA], 
        RTRIM(EPE.ROMANEIO_PRODUTO) AS [DOC],
        RTRIM(EPE.DESC_PRODUTO) AS [PRODUTO], 
        RTRIM(EPE.COR_PRODUTO) AS [COR],
        RTRIM(EPE.DESC_COR_PRODUTO) AS [DESCRICAO_COR], 
        EPE.EN_1 AS [XS], 
        EPE.EN_2 AS [S], 
        EPE.EN_3 AS [M], 
        EPE.EN_4 AS [L], 
        EPE.EN_5 AS [XL], 
        EPE.EN_6 AS [XXL],
        EPE.QTDE AS [QUANTIDADE],
        RTRIM(EPE.TIPO_PRODUTO) AS [TIPO],
        RTRIM(FX.OP_PED_ROMAN) AS [OP_PED_ROMAN],
        CONVERT(varbinary(max), CONVERT(varchar(max), EPE.CONTEUDO_FOTO)) AS [CONTEUDO_FOTO]
        FROM (
            SELECT DOC, OP_PED_ROMAN FROM FX_MONTA_CARDEX_PA('".$produto."', '".$cor."', '2A QUALIDADE', 0)
        ) AS FX
        ";
    }

    public static function buscarProdutoRequisicao($produto, $cor){
        $select =  "SELECT ".self::getFieldsRequisicao($produto, $cor)."
        INNER JOIN (
            SELECT  
                EPE.PRODUTO,
                EPE.ROMANEIO_PRODUTO,
                P.DESC_PRODUTO,
                PC.COR_PRODUTO,
                PC.DESC_COR_PRODUTO,
                EPE.EN_1, 
                EPE.EN_2, 
                EPE.EN_3, 
                EPE.EN_4, 
                EPE.EN_5, 
                EPE.EN_6,
                EPE.QTDE,
                P.TIPO_PRODUTO,
                CONVERT(varbinary(max), CONVERT(varchar(max), FOTO.CONTEUDO_FOTO)) AS [CONTEUDO_FOTO]
            FROM ESTOQUE_PROD1_ENT AS EPE
            INNER JOIN PRODUTOS AS P ON EPE.PRODUTO = P.PRODUTO
            INNER JOIN PRODUTO_CORES AS PC ON EPE.COR_PRODUTO = PC.COR_PRODUTO AND EPE.PRODUTO = PC.PRODUTO
            INNER JOIN PRODUTOS_FOTO AS FOTO
                  ON FOTO.PRODUTO = EPE.PRODUTO 
                 AND FOTO.LEGENDA = EPE.COR_PRODUTO
        
            WHERE EPE.PRODUTO = '".$produto."' AND EPE.COR_PRODUTO = '".$cor."'
        ) AS EPE ON FX.DOC = EPE.ROMANEIO_PRODUTO
        ";
        // dd($select);
        $query = DB::connection('linx')->select($select,[$produto, $cor]);
        // dd($query);
        return $query;
    }

    public static function getFornecedor(){
        $select = " SELECT 
        RTRIM(FORNECEDOR) AS FORNECEDOR
        FROM FORNECEDORES
        WHERE TIPO = 'TECIDOS'
        AND NOT SUBTIPO_FORNECEDOR = 'NULL' 
        AND NOT FORNECEDOR LIKE '%INATIVO%' ";

        $query = DB::connection('linx')->select($select);

        return $query;
    }

    public static function getFieldsTecido(){
        return " RTRIM(MAT.MATERIAL) AS MATERIAL,
        RTRIM(MAT.DESC_MATERIAL) AS DESCRICAO,
        RTRIM(MAT_COR.DESC_COR_MATERIAL) AS COR ";
    }

    public static function getGroupByMaterial(){
        return "GROUP BY 
        MAT.MATERIAL,
        MAT.DESC_MATERIAL,
        MAT_COR.DESC_COR_MATERIAL ";
    }

    public static function getInspecaoTecido($material){

        $select =  "SELECT ".self::getFieldsTecido()." FROM MATERIAIS AS MAT
        INNER JOIN MATERIAIS_CORES AS MAT_COR
        ON MAT_COR.MATERIAL = MAT.MATERIAL
        
        WHERE MAT.GRUPO LIKE '%TECIDO%'
        AND MAT.SUBGRUPO IN ('MALHA', 'TECIDO', 'PLANO')
        
        AND NOT (
            MAT.DESC_MATERIAL LIKE '%(INATIVO)%' OR
            MAT_COR.DESC_COR_MATERIAL LIKE '%NAO DEFINIDO%' OR
            MAT_COR.DESC_COR_MATERIAL LIKE '%INDEFINIDO%'
        ) 
        AND MAT.MATERIAL = ?
        "
        .self::getGroupByMaterial();
        $query = DB::connection('linx')->select($select,[$material]);

        return $query;
    }

    public static function getDescricaoMaterial($descricao){
        $select = " SELECT  RTRIM(MAT.MATERIAL) AS MATERIAL,
        RTRIM(MAT.DESC_MATERIAL) AS DESCRICAO

        FROM MATERIAIS AS MAT
        INNER JOIN MATERIAIS_CORES AS MAT_COR
        ON MAT_COR.MATERIAL = MAT.MATERIAL
        
        WHERE MAT.GRUPO LIKE '%TECIDO%'
        AND MAT.SUBGRUPO IN ('MALHA', 'TECIDO', 'PLANO')
        
        AND NOT (
            MAT.DESC_MATERIAL LIKE '%(INATIVO)%'
        )
        AND MAT.DESC_MATERIAL like '%".$descricao."%'
        GROUP BY
        MAT.MATERIAL,
        MAT.DESC_MATERIAL
        ";

        $query = DB::connection('linx')->select($select,[$descricao]);
        return $query;
    }

    public static function getFieldsPuma(){
        return " PROG.ORDEM_PRODUCAO,
        VENDAS.PEDIDO_CLIENTE,
        P.COLECAO,
        P.GRUPO_PRODUTO,
        VP.PRODUTO,
        VP.COR_PRODUTO,
        PC.DESC_COR_PRODUTO,
        VP.VO1,
        VP.VO2,
        VP.VO3,
        VP.VO4,
        VP.VO5,
        VP.VO6,
        VP.VO7,
        VP.VO8,
        VP.QTDE_ORIGINAL,
        FP.F1,
        FP.F2,
        FP.F3,
        FP.F4,
        FP.F5,
        FP.F6,
        FP.F7,
        FP.QTDE ";
    }

    public static function getOrderByPuma(){
        return " ORDER BY 
        VP.SEQUENCIAL_DIGITACAO, 
        VP.PRODUTO, 
        VP.COR_PRODUTO, 
        VP.ENTREGA  ";
    }

    public static function inspecaoPuma($pedidoid){

        $select =  "SELECT ".self::getFieldsPuma()." FROM VENDAS AS VENDAS
        JOIN VENDAS_PRODUTO VP ON VP.PEDIDO = VENDAS.PEDIDO
        JOIN PRODUTOS P ON P.PRODUTO = VP.PRODUTO
        JOIN PRODUTO_CORES PC ON PC.PRODUTO = VP.PRODUTO AND PC.COR_PRODUTO  = VP.COR_PRODUTO
        LEFT JOIN FATURAMENTO_PROD AS FP ON VP.PEDIDO = FP.PEDIDO AND VP.ITEM_PEDIDO = FP.ITEM_PEDIDO
        
        LEFT OUTER JOIN (SELECT ROMANEIOS.PROGRAMACAO, ROMANEIOS_RESERVAS.PRODUTO,  ROMANEIOS_RESERVAS.ORDEM_PRODUCAO, ROMANEIOS_RESERVAS.ROMANEIO, ROMANEIOS_RESERVAS.FILIAL,  ROMANEIOS_RESERVAS.PEDIDO, ROMANEIOS_RESERVAS.COR_PRODUTO,  ROMANEIOS_RESERVAS.COR_PEDIDO, ROMANEIOS_RESERVAS.ENTREGA,  ROMANEIOS_RESERVAS.QTDE_R, ROMANEIOS_RESERVAS.INDICA_ADEQUADO,ROMANEIOS_RESERVAS.MATA_SALDO, ROMANEIOS_RESERVAS.ITEM_PEDIDO, ROMANEIOS_RESERVAS.OBS_ITEM,  PRODUTO_CORES.DESC_COR_PRODUTO, PRODUTOS.DESC_PRODUTO, PRODUTOS.GRADE,  VENDAS.CLIENTE_ATACADO, VENDAS.EMISSAO, VENDAS.REPRESENTANTE,  COLECOES.DESC_COLECAO
        FROM DBO.ROMANEIOS ROMANEIOS,  DBO.ROMANEIOS_RESERVAS ROMANEIOS_RESERVAS,  DBO.PRODUTO_CORES PRODUTO_CORES, DBO.PRODUTOS PRODUTOS,  DBO.VENDAS VENDAS, DBO.COLECOES COLECOES
        WHERE ROMANEIOS.ROMANEIO = ROMANEIOS_RESERVAS.ROMANEIO AND ROMANEIOS.FILIAL = ROMANEIOS_RESERVAS.FILIAL AND ROMANEIOS_RESERVAS.PRODUTO = PRODUTOS.PRODUTO   AND ROMANEIOS_RESERVAS.PRODUTO = PRODUTO_CORES.PRODUTO AND ROMANEIOS_RESERVAS.COR_PRODUTO = PRODUTO_CORES.COR_PRODUTO AND ROMANEIOS_RESERVAS.PEDIDO = VENDAS.PEDIDO AND VENDAS.COLECAO = COLECOES.COLECAO) PROG 
        ON PROG.PEDIDO = VP.PEDIDO AND PROG.PRODUTO = VP.PRODUTO AND PROG.COR_PRODUTO = VP.COR_PRODUTO AND PROG.ITEM_PEDIDO = VP.ITEM_PEDIDO
                 
        
        LEFT OUTER JOIN PRODUCAO_ORDEM AS OP ON OP.ORDEM_PRODUCAO = PROG.ORDEM_PRODUCAO
        LEFT OUTER JOIN PRODUCAO_PROGRAMA AS PPROG ON PPROG.PROGRAMACAO = PROG.PROGRAMACAO
        
        WHERE VENDAS.PEDIDO_CLIENTE = ? ";//.self::getOrderByPuma();

        $query = DB::connection('linx')->select($select,[$pedidoid]);

        return $query;
    }

    public static function getFieldsOri(){
        return " 
        W.ORDEM_PRODUCAO,
        VENDAS.PEDIDO_CLIENTE,
        W.PRODUTO,
        PRODUTO_CORES.DESC_COR_PRODUTO,
        VENDAS_PRODUTO.VO1 AS O1,
        VENDAS_PRODUTO.VO2 AS O2,
        VENDAS_PRODUTO.VO3 AS O3,
        VENDAS_PRODUTO.VO4 AS O4,
        VENDAS_PRODUTO.VO5 AS O5,
        VENDAS_PRODUTO.VO6 AS O6,
        VENDAS_PRODUTO.VO7 AS O7,
        VENDAS_PRODUTO.QTDE_ORIGINAL AS ORIGINAL_TOTAL";
    }

    public static function getFieldsFat(){
        return "
        FATURADA.F1 AS F1,
        FATURADA.F2 AS F2,
        FATURADA.F3 AS F3,
        FATURADA.F4 AS F4,
        FATURADA.F5 AS F5,
        FATURADA.F6 AS F6,
        FATURADA.F7 AS F7,
        FATURADA.QTDE_F AS FATURADO_TOTAL";
    }

    public static function getFieldCortada(){
        return "
        CORTADA.A1 AS C1,
        CORTADA.A2 AS C2,
        CORTADA.A3 AS C3,
        CORTADA.A4 AS C4,
        CORTADA.A5 AS C5,
        CORTADA.A6 AS C6,
        CORTADA.A7 AS C7,
        CORTADA.QTDE_A AS CORTADA_TOTAL ";
    }

    public static function getFieldInspecaoPuma(){
        return " 
        INS.NUMEROPEDIDO, 
        INS.ORDEMPRODUCAO, 
        INS.COLECAO,
        INS.OBSINSPECAO,
        INS.ACAOTOMADA,
        INS.INSPETOR,
        INS.TOTALINSPECAO,
        INS.DATAINSPECAO,
        INS.AMOSTRAETIQUETAS,
        INS.TAM1,
        INS.TAM2,
        INS.TAM3,
        INS.TAM4,
        INS.TAM5,
        INS.TAM6,
        INS.TAM7,
        INS.XS AS CAL1,
        INS.S AS CAL2,
        INS.M AS CAL3,
        INS.L AS CAL4,
        INS.XL AS CAL5,
        INS.XXL AS CAL6,
        INS.[3XL] AS CAL7 ";
        //INS.[3XL] AS CAL7 ";//SQL
        // INS.3XL AS CAL7 ";MYSQL
    }

    public static function insPuma($opid){
        
        $select = "SELECT ".self::getFieldInspecaoPuma()."
        FROM INSPECAOPUMA AS INS
        WHERE ORDEMPRODUCAO = ? ";

        $query = DB::select($select,[$opid]);

        return $query;
    }

    public static function getPedidoInsPuma(){
        
        return "
        INS.NUMEROPEDIDO,
        INS.ORDEMPRODUCAO,
        INS.COLECAO,
        INS.OBSINSPECAO,
        INS.ACAOTOMADA,
        INS.INSPETOR,
        INS.TOTALINSPECAO,
        INS.DATAINSPECAO,
        INS.TAM1,
        INS.TAM2,
        INS.TAM3,
        INS.TAM4,
        INS.TAM5,
        INS.TAM6,
        INS.TAM7,
        INS.XS,
        INS.S AS CAL2,
        INS.M AS CAL3,
        INS.L AS CAL4,
        INS.XL AS CAL5,
        INS.XXL AS CAL6,
        INS.[3XL] AS CAL7 ";
    }

    public static function pedidoInsPuma($pedidopuma){
        
        $select = "SELECT ".self::getFieldInspecaoPuma()."
        FROM INSPECAOPUMA AS INS WHERE NUMEROPEDIDO = ? ";
        //dd($select);
        $query = DB::select($select,[$pedidopuma]);
        //dd($query);
        return $query;
    }

    public static function getGroupByFat(){
        return "
        GROUP BY
        W.ORDEM_PRODUCAO,
        VENDAS.PEDIDO_CLIENTE,
        W.PRODUTO,
        PRODUTO_CORES.DESC_COR_PRODUTO
        ";
    }

    public static function controleOp($opid, $pedido = null, $duplicado = null){
        //dd($opid.'-'. $pedido.'-'.$duplicado);

        $select =  "SELECT DISTINCT".self::getFieldsOri();
        if ($pedido) {
            $select .=",".self::getFieldCortada();
        };
        if($duplicado == 1){
            $select .=",".self::getFieldsFat();
        }else{
            $select .=",
        W.R1 AS F1,
        W.R2 AS F2,
        W.R3 AS F3,
        W.R4 AS F4,
        W.R5 AS F5,
        W.R6 AS F6,
        W.R7 AS F7,
        W.R8 AS F8,
        W.QTDE_R AS FATURADO_TOTAL";
        };
            $select .= " 
        FROM W_VENDAS_AMARRACAO_PRODUCAO W
        INNER JOIN PRODUTO_CORES PRODUTO_CORES
        ON W.PRODUTO = PRODUTO_CORES.PRODUTO
        AND W.COR_PRODUTO = PRODUTO_CORES.COR_PRODUTO
        INNER JOIN VENDAS VENDAS
        ON W.PEDIDO = VENDAS.PEDIDO
        INNER JOIN VENDAS_PRODUTO VENDAS_PRODUTO
        ON (((W.PEDIDO = VENDAS_PRODUTO.PEDIDO
        AND W.PRODUTO = VENDAS_PRODUTO.PRODUTO )
        AND W.COR_PRODUTO = VENDAS_PRODUTO.COR_PRODUTO )
        AND W.ENTREGA = VENDAS_PRODUTO.ENTREGA )
        AND W.ITEM_PEDIDO = VENDAS_PRODUTO.ITEM_PEDIDO
        LEFT OUTER JOIN FATURAMENTO FATURAMENTO
        ON W.DOCUMENTO = FATURAMENTO.NF_SAIDA
        AND (W.FILIAL = FATURAMENTO.FILIAL
        AND W.SERIE_NF = FATURAMENTO.SERIE_NF )
        LEFT OUTER JOIN FATURAMENTO_CAIXAS FATURAMENTO_CAIXAS
        ON W.CAIXA = FATURAMENTO_CAIXAS.CAIXA
        LEFT OUTER JOIN MODIFICACAO_FICHA_TECNICA MODIFICACAO_FICHA_TECNICA
        ON VENDAS_PRODUTO.ID_MODIFICACAO = MODIFICACAO_FICHA_TECNICA.ID_MODIFICACAO
        LEFT OUTER JOIN CADASTRO_LOCAIS_ENTREGA CADASTRO_LOCAIS_ENTREGA
        ON VENDAS_PRODUTO.CODIGO_LOCAL_ENTREGA = CADASTRO_LOCAIS_ENTREGA.CODIGO_LOCAL_ENTREGA
        AND VENDAS.CLIENTE_ATACADO = CADASTRO_LOCAIS_ENTREGA.NOME_CLIFOR ";
        if ($pedido) {
            $select .= " 
        LEFT OUTER JOIN(
            SELECT ORDEM_PRODUCAO, PRODUTO,
            SUM(QTDE_A) AS QTDE_A, 
            SUM(A1) AS A1, SUM(A2) AS A2, SUM(A3) AS A3, SUM(A4) AS A4, 
            SUM(A5) AS A5, SUM(A6) AS A6, SUM(A7) AS A7, SUM(A8) AS A8
            FROM  FX_PRODUCAO_ORDEM_HIST_OS('$opid')
            where FASE_PRODUCAO = ('10')
            GROUP BY ORDEM_PRODUCAO, PRODUTO
        ) CORTADA
        ON CORTADA.ORDEM_PRODUCAO = W.ORDEM_PRODUCAO

        LEFT OUTER JOIN(
            SELECT
            W.PEDIDO,VENDAS.PEDIDO_CLIENTE, W.PRODUTO, PRODUTO_CORES.DESC_COR_PRODUTO,
            SUM(R1) AS F1, SUM(R2) AS F2, SUM(R3) AS F3,
            SUM(R4) AS F4, SUM(R5) AS F5, SUM(R6) AS F6,
            SUM(R7) AS F7, QTDE_TOTAL AS QTDE_F
        FROM W_VENDAS_AMARRACAO_PRODUCAO W
        INNER JOIN VENDAS VENDAS ON W.PEDIDO = VENDAS.PEDIDO
        INNER JOIN PRODUTO_CORES PRODUTO_CORES ON W.PRODUTO = PRODUTO_CORES.PRODUTO 
        AND W.COR_PRODUTO = PRODUTO_CORES.COR_PRODUTO 
        WHERE W.ORDEM_PRODUCAO = '$opid'
            AND W.TIPO = '03'
        GROUP BY
            W.PEDIDO, W.ORDEM_PRODUCAO,VENDAS.PEDIDO_CLIENTE, W.PRODUTO, PRODUTO_CORES.DESC_COR_PRODUTO, W.QTDE_TOTAL 
        )AS FATURADA
        ON FATURADA.PEDIDO = W.PEDIDO
        AND VENDAS.PEDIDO_CLIENTE = '".$pedido."' ";
        };

        $select .= " 
        WHERE W.ORDEM_PRODUCAO = ?
        AND (w.TIPO = '03' OR w.TIPO = '02' or w.tipo = '01') ";
       
        //dd($select);
        $query = DB::connection('linx')->select($select,[$opid]);
        //dd($query);
        return $query;
    }

    public static function controleOpBgCg($op, $pedidocliente){
        $select = "SELECT "
            .self::getControleOpBgCg().
        " FROM CONTROLEOPPUMA
        WHERE ORDEMPRODUCAO = ? 
        AND PEDIDOCLIENTE = ? ";

        $query = DB::select($select,[$op, $pedidocliente]);
        return $query;
    }

    public static function getControleOpBgCg(){
        return "
            BGXS AS BG1,
            BGS AS BG2,
            BGM AS BG3,
            BGL AS BG4,
            BGXL AS BG5,
            BGXXL AS BG6,
            BG3XL AS BG7,
            BGTOTAL,
            CGXS AS CG1,
            CGS AS CG2,
            CGM AS CG3,
            CGL AS CG4,
            CGXL AS CG5,
            CGXXL AS CG6,
            CG3XL AS CG7,
            CGTOTAL,
            PEDIDOCLIENTE,
            DATACONTROLE
        ";
    }

    public static function getMesSelecionado(){
        return " COP.ORDEMPRODUCAO,
        COP.PEDIDOCLIENTE,
        COP.REFERENCIAPRODUTO,
        COP.DATACONTROLE,
        COP.PCXS,
        COP.PCS,
        COP.PCL,
        COP.PCM,
        COP.PCXL,
        COP.PCXXL,
        COP.PC3XL,
        COP.PCTOTAL,
        COP.CLXS,
        COP.CLS,
        COP.CLL,
        COP.CLM,
        COP.CLXL,
        COP.CLXXL,
        COP.CL3XL,
        COP.CLTOTAL,
        COP.DMXS,
        COP.DMS,
        COP.DML,
        COP.DMM,
        COP.DMXL,
        COP.DMXXL,
        COP.DM3XL,
        COP.DMTOTAL,
        COP.FATXS,
        COP.FATS,
        COP.FATL,
        COP.FATM,
        COP.FATXL,
        COP.FATXXL,
        COP.FAT3XL,
        COP.FATTOTAL,
        COP.BGXS,
        COP.BGS,
        COP.BGL,
        COP.BGM,
        COP.BGXL,
        COP.BGXXL,
        COP.BG3XL,
        COP.BGTOTAL,
        COP.CGXS,
        COP.CGS,
        COP.CGL,
        COP.CGM,
        COP.CGXL,
        COP.CGXXL,
        COP.CG3XL,
        COP.CGTOTAL ";
    }

    public static function mesRelatorioOpPuma($mes, $ano){
        $select = "SELECT ".self::getMesSelecionado(). " FROM CONTROLEOPPUMA AS COP
        WHERE MONTH(COP.DATACONTROLE) = ? 
        AND YEAR(COP.DATACONTROLE) = ? ";

        $query = DB::select($select,[$mes,$ano]);
        return $query;
    }

    public static function relatorioEvento(){
        return " 
        ESPECI.PROFISSAO,
        CID.DESCRICAO,
        TPEVE.DESCRICAO AS TIPO,
        PROFI.NOME AS PROFISSIONAL,
        LOCAIS.DESCRICAO AS LOCAIS,
        FUNC.NOME AS FUNCIONARIO,
        COALESCE(DEPEND.NOME, 'SEM DEPENDENTE') AS DEPENDENTE,
        EVENTOS.DATAEMISSAO,
        EVENTOS.DATAENTREGUE,
        EVENTOS.DATAINICIO,
        EVENTOS.DATAFIM,
        EVENTOS.DATABAIXA
        ";
    }

    public static function joinEventos(){
        return "
        JOIN ESPECIALIDADES AS ESPECI ON ESPECI.ID = EVENTOS.ESPECIALIDADES_ID
        JOIN CID AS CID ON CID.ID = EVENTOS.CID_ID
        JOIN TIPOEVENTOS AS TPEVE ON TPEVE.ID = EVENTOS.TIPOEVENTOS_ID
        JOIN PROFISSIONAIS AS PROFI ON PROFI.ID = EVENTOS.PROFISSIONAIS_ID
        JOIN LOCAISATENDIMENTO AS LOCAIS ON LOCAIS.ID = EVENTOS.LOCAISATENDIMENTO_ID
        JOIN FUNCIONARIOS AS FUNC ON FUNC.ID = EVENTOS.FUNCIONARIOS_ID
        LEFT JOIN DEPENDENTES AS DEPEND ON DEPEND.ID = EVENTOS.DEPENDENTES_ID
        ";
    }

    public static function eventoMesRelatorio($tpevento, $mes, $ano){
        $tpevento = !$tpevento ? '%%' : $tpevento;
        $select = 
        "SELECT ".self::relatorioEvento(). 
        "FROM EVENTOS AS EVENTOS ".self::joinEventos()."
        WHERE TPEVE.ID LIKE ? 
        AND MONTH(EVENTOS.DATAENTREGUE) = ? 
        AND YEAR(EVENTOS.DATAENTREGUE) = ? ";

        $query = DB::select($select,[$tpevento, $mes,$ano]);
        return $query;
    }

    public static function relatorioInspecaoTecido(){
        return " 
        CODIGO,
        DATAINSPECAO,
        TIPO,
        TECIDO,
        COR,
        FORNECEDOR,
        NUMEROLOTE,
        LARGURACORTAVEL,
        QTDFORNECEDOR,
        QTDREAL,
        QTDVARIAVEL,
        MAXIMOPONTOS,
        STATUS,
        MEDIAPONTOS,
        DESCRICAODEFEITO,
        PESOLIQUIDO,
        RENDIMENTO
        ";
    }

    public static function inspecaoTecidoMesRelatorio($ano, $mes, $dia, $tipo){
        $select = 
        "SELECT ".self::relatorioInspecaoTecido().
        "FROM INSPECAOTECIDO 
        WHERE YEAR(INSPECAOTECIDO.DATAINSPECAO) = ? 
        AND MONTH(INSPECAOTECIDO.DATAINSPECAO) = ? ";
        $parameters = [$ano, $mes];
        if($dia){
            $select .= " AND DAY(INSPECAOTECIDO.DATAINSPECAO) = ? "; 
            $parameters[] = $dia;
        }

        if($tipo){
            $select .= " AND INSPECAOTECIDO.TIPO = ? "; 
            $parameters[] = $tipo;
        }

        $query = DB::select($select, $parameters);
        // dd($query);
        return $query;
    }

    public static function referencia($referencia){
        $select = " SELECT 
            RTRIM(PTO.TABELA_OPERACOES) AS TAB_REF, 
            RTRIM(PTO.DESCRICAO_TABELA) AS TAB_DESC, 
            RTRIM(PTO.GRUPO_PRODUTO) AS TAB_GRUPO, 
            RTRIM(PTO.TOLERANCIA) AS TOLERANCIA, 
            PTO.QTDE_LOTE_ECONOMICO AS LOTE,
            RTRIM(P.PRODUTO) AS PRODUTO,
            RTRIM(P.DESC_PRODUTO) AS DESC_PRODUTO,
            RTRIM(P.GRUPO_PRODUTO) AS GRUPO,
            RTRIM(P.SUBGRUPO_PRODUTO) AS SUBGRUPO,
            RTRIM(PF.PATH_FOTO) AS CAMINHO

            FROM PRODUTOS_TAB_OPERACOES AS PTO

            LEFT JOIN PRODUTOS P ON P.PRODUTO = PTO.TABELA_OPERACOES
            LEFT JOIN PRODUTOS_FOTO PF ON PF.PRODUTO = P.PRODUTO
            WHERE PTO.TABELA_OPERACOES = ? 
            AND PF.NUMERO_FOTO = '1' ";
            //dd($select);
            $query = DB::connection('linx')->select($select,[$referencia]);
            //dd($query);
        return $query;
    }

    public static function refeoperacao($refeoperacao){
        $select = " SELECT DISTINCT
            RTRIM(PRODUTOS_OPERACOES.SEQUENCIA) AS SEQ,
            RTRIM(PRODUTOS_OPERACOES.OPERACAO) AS OPERACAO,
            RTRIM(PRODUTIV_OPERACOES.DESC_OPERACAO) AS DESC_OPERACAO,
            CAST(PRODUTIV_OPERACOES.TEMPO_FIXO AS VARCHAR(10)) AS TEMPO,
            RTRIM(PRODUTIV_MAQUINAS.DESC_MAQUINA) AS MAQUINA    

            FROM PRODUTOS_OPERACOES PRODUTOS_OPERACOES 

            JOIN PRODUTIV_OPERACOES PRODUTIV_OPERACOES 
            ON PRODUTIV_OPERACOES.OPERACAO = PRODUTOS_OPERACOES.OPERACAO 
            JOIN PRODUTIV_MAQUINAS PRODUTIV_MAQUINAS 
            ON PRODUTIV_MAQUINAS.MAQUINA = PRODUTIV_OPERACOES.MAQUINA 
            JOIN PRODUTIV_OPER_TIPO PRODUTIV_OPER_TIPO 
            ON PRODUTIV_OPER_TIPO.TIPO_OPERACAO = PRODUTIV_OPERACOES.TIPO_OPERACAO 
            LEFT JOIN PRODUCAO_FASE PRODUCAO_FASE 
            ON PRODUTIV_OPERACOES.FASE_PRODUCAO = PRODUCAO_FASE.FASE_PRODUCAO  
            LEFT JOIN PRODUCAO_SETOR PRODUCAO_SETOR 
            ON PRODUTIV_OPERACOES.SETOR_PRODUCAO = PRODUCAO_SETOR.SETOR_PRODUCAO 
            AND PRODUTIV_OPERACOES.FASE_PRODUCAO = PRODUCAO_SETOR.FASE_PRODUCAO 
            LEFT JOIN PRODUTIV_APARELHOS 
            ON PRODUTOS_OPERACOES.APARELHO  = PRODUTIV_APARELHOS.APARELHO 

            WHERE PRODUTOS_OPERACOES.TABELA_OPERACOES = ? ";

            $query = DB::connection('linx')->select($select,[$refeoperacao]);
            //dd($query);
        return $query;
    }

    public static function carregaSelects(){

        // TOLERANCIA
        $tolerancia = "SELECT 
            RTRIM(TOLERANCIA) AS TOLERANCIA
            FROM PRODUTIV_TOLERANCIAS";

        $tolerancia = DB::connection('linx')->select($tolerancia);

        foreach ($tolerancia as $item) {
            $toleranciaArray[] = $item->TOLERANCIA;
        }

        // LINHA
        $linha = "SELECT 
            RTRIM(LINHA_INDUSTRIAL) AS LINHA
            FROM PRODUTIV_LINHA_INDUSTRIAL";

        $linha = DB::connection('linx')->select($linha);

        foreach ($linha as $item) {
            $linhaArray[] = $item->LINHA;
        }

        // GRUPOS
        $grupo = "SELECT 
            CODIGO_GRUPO AS CODIGO,
            RTRIM(GRUPO_PRODUTO) AS GRUPO
            FROM PRODUTOS_GRUPO
            ORDER BY CODIGO_GRUPO";
        
        $grupo = DB::connection('linx')->select($grupo);

        foreach ($grupo as $item) {
            $grupoArray[$item->CODIGO] = $item->GRUPO;
        }

        //DESCRIÇÃO DAS OPERAÇÕES COM MÁQUINAS
        $operacoes = "SELECT 
            RTRIM(PROP.OPERACAO) AS OPERACAO, 
            RTRIM(PROP.DESC_OPERACAO) AS DESC_OPERACAO,
            RTRIM(PRM.DESC_MAQUINA) AS MAQUINA,
            RTRIM(PROP.TEMPO_FIXO) AS TEMPO
            FROM PRODUTIV_OPERACOES AS PROP

            JOIN PRODUCAO_FASE AS PRF
            ON PRF.FASE_PRODUCAO = PROP.FASE_PRODUCAO

            JOIN PRODUTIV_MAQUINAS AS PRM
            ON PRM.MAQUINA = PROP.MAQUINA

            WHERE ( PROP.OPERACAO > '00805' AND PROP.OPERACAO <= '02000' AND NOT PROP.OPERACAO = '0082')
            ORDER BY PROP.OPERACAO ASC";

        $operacoes = DB::connection('linx')->select($operacoes);
        foreach ($operacoes as $item) {
            $operacoesArray[]= $item->OPERACAO. ': ' .$item->DESC_OPERACAO . '/' . $item->MAQUINA;
        }

        $operacoesSeparadas = [];
        foreach ($operacoes as $item) {
            $operacaoSeparada = [
                'codigo' => $item->OPERACAO,
                'descricao' => $item->DESC_OPERACAO,
                'maquina' => $item->MAQUINA,
                'tempo' => $item->TEMPO
            ];
            $operacoesSeparadas[] = $operacaoSeparada;
        }

        return response()->json([
            'tolerancia' => $toleranciaArray,
            'linha' => $linhaArray,
            'grupo' => $grupoArray,
            'operacoes' => $operacoesArray,
            'opeseparadas' => $operacoesSeparadas
        ]);
    }

    public static function imagem(){
        $file = file_get_contents('L:\IMG\BF\PROD\PUMA\NEYMAR\01 PUMA WHITE.jpg');
            $response = \Response::make($file, 200);
            $response->header('Content-Type', 'image/jpg');
        return $response;
    }

    public static function getDadosOpPuma(){
        return "
        ORDEMPRODUCAO,
        PEDIDOCLIENTE,
        REFERENCIAPRODUTO,
        DATACONTROLE,
        PCXS,
        PCS,
        PCM,
        PCL,
        PCXL,
        PCXXL,
        PC3XL,
        PCTOTAL,
        PCXS,
        PCS,
        PCM,
        PCL,
        PCXL,
        PCXXL,
        PC3XL,
        PCTOTAL,
        CLXS,
        CLS,
        CLM,
        CLL,
        CLXL,
        CLXXL,
        CL3XL,
        CLTOTAL,
        DMXS,
        DMS,
        DMM,
        DML,
        DMXL,
        DMXXL,
        DM3XL,
        DMTOTAL,
        FATXS,
        FATS,
        FATM,
        FATL,
        FATXL,
        FATXXL,
        FAT3XL,
        FATTOTAL,
        BGXS,
        BGS,
        BGM,
        BGL,
        BGXL,
        BGXXL,
        BG3XL,
        BGTOTAL,
        CGXS,
        CGS,
        CGM,
        CGL,
        CGXL,
        CGXXL,
        CG3XL,
        CGTOTAL        
        ";
    }

    public static function dadosOpPuma($op){
        $select = "SELECT ".self::getDadosOpPuma().
        " FROM CONTROLEOPPUMA 
        WHERE ORDEMPRODUCAO = ? ";
        
        $query = DB::select($select,[$op]);
        return $query;
    }
}