<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title> Requisição de Produto </title>

        <body>
            <table>
                <tr>
                    <td colspan="2" class="requisicao">
                        <strong>{{ $title }}</strong>
                    </td>
                </tr>
                <tr>
                    <td class="column-left">
                        <label class="lb-left"><strong><br>Requisição Número: </strong>{{ $numerorequisicao }}</label>
                        {{-- <label class="lb-left"><strong><br>Referente entrada: </strong>{{ $doc }}</label> --}}
                        {{-- <label class="lb-left"><strong><br>Estoque 2A linha</strong></label> --}}
                        <label class="lb-left"><strong><br>Requisitante: </strong>{{ $requisitante }}</label>
                        <label class="lb-left"><strong><br>Setor: </strong>{{ $setor }}</label>
                    </td>
                    <td class="column-right">                        
                        <label class="lb-right"><strong>Data: </strong>{{ $datarequisicao }}</label>
                    </td>
                </tr>
            </table>
            
            <table class="tabela2">
                <tr style="font-weight: bolder; text-align: center; background-color: #f3f2f7">
                    <td>Ref.</td>
                    <td>Doc.</td>
                    <td>Produto</td>
                    <td>Cor</td>
                    <td>Descrição</td>
                    <td>XS(116)</td>
                    <td>S(128)</td>
                    <td>M(140)</td>
                    <td>L(152)</td>
                    <td>XL(164)</td>
                    <td>XXL(176)</td>
                    <td>Total</td>
                    <td>OBS</td>
                </tr>
                @foreach ($requisicoes as $requisicao)
                    <tr style="font-size: 10px">
                        <td style="text-align: center">{{ $requisicao['referencia'] }}</td>
                        <td style="text-align: center">{{ $requisicao['doc'] }}</td>
                        <td style="text-align: center">{{ $requisicao['produto'] }}</td>
                        <td style="text-align: center">{{ $requisicao['codCor'] }}</td>
                        <td style="text-align: center">{{ $requisicao['descricaoCor'] }}</td>
                        <td style="text-align: center">{{ $requisicao['quantidades']['XS'] !== 0 ? 
                            $requisicao['quantidades']['XS'] : $requisicao['quantidades']['116'] }}
                        </td>
                        <td style="text-align: center">{{ $requisicao['quantidades']['S'] !== 0 ? 
                            $requisicao['quantidades']['S'] : $requisicao['quantidades']['128'] }}
                        </td>
                        <td style="text-align: center">{{ $requisicao['quantidades']['M'] !== 0 ? 
                            $requisicao['quantidades']['M'] : $requisicao['quantidades']['140']}}
                        </td>
                        <td style="text-align: center">{{ $requisicao['quantidades']['L'] !== 0 ?
                            $requisicao['quantidades']['L'] : $requisicao['quantidades']['152']}}
                        </td>
                        <td style="text-align: center">{{ $requisicao['quantidades']['XL'] !== 0 ?
                            $requisicao['quantidades']['XL'] : $requisicao['quantidades']['164']}}
                        </td>
                        <td style="text-align: center">{{ $requisicao['quantidades']['XXL'] !== 0 ?
                            $requisicao['quantidades']['XXL'] : $requisicao['quantidades']['176']}}
                        </td>
                        <td style="text-align: center">{{ $requisicao['totalQuantidade'] }}</td>
                        {{-- <td style="text-align: center">{{ $requisicao['opPedidoRoman'] }}</td> --}}
                        <td style="text-align: center">
                            <?php
                            // Verifica se a variável $requisicao['opPedidoRoman'] não está vazia
                            if (!empty($requisicao['opPedidoRoman'])) {
                                // Quebra o texto quando encontrar o caractere "/"
                                $opPedidos = explode('/', $requisicao['opPedidoRoman']);
                                
                                // Exibe cada parte do texto em uma nova linha
                                foreach ($opPedidos as $opPedido) {
                                    echo $opPedido . '<br>';
                                }
                            } else {
                                echo '-';
                            }
                            ?>
                        </td>                        
                    </tr>
                @endforeach

                {{-- <tfoot >
                    <td colspan="11" style="font-size: 14px">
                        <strong>Quantidade de Produtos: </strong>
                        {{ $totalprodutos }}
                </tfoot>
                <tfoot>
                    <td colspan="11" style="font-size: 14px">
                        <strong>Quantidade de Itens: </strong>
                        {{ $totalitens }}
                </tfoot> --}}

            </table>
            
            {{-- <table class="totais">
                <tr>
                    <td colspan="2" style="font-size: 12px" ><strong>QUANTIDADES</strong></td>
                </tr>
                <tr>
                    <td style="font-size: 11px"><strong>Produtos</strong></td>
                    <td style="font-size: 11px"><strong>Itens</strong></td>
                </tr>
                <tr style="background-color: #ffffff">
                    <td style="font-size: 10px">{{ $totalprodutos }}</td>
                    <td style="font-size: 10px">{{ $totalitens }}</td>
                </tr>
            </table> --}}
            {{-- <div class="linha-totais mb-1">
                <a class="atotais">Total de Produtos: {{ $totalprodutos }} </a><br>
                <a class="atotais">Total de Itens: {{ $totalitens }} </a>
            </div> --}}
            <div class="total">
                <a class="atotais">Total</a>
            </div>
            <div class="linha-totais">
                <a class="atotais">Produtos</a>
                <span class="totalprodutos">{{ $totalprodutos }}</span><br>
                <a class="atotais">Itens</a>
                <span class="totalitens">{{ $totalitens }}</span>
            </div>

            {{-- <div style="margin-top: 15px">
                <div style="display: flex; align-items: center; margin-bottom: 5px;">
                    <div class="quadrado"></div>
                    <strong style="margin-left: 5px;">APROVADO</strong>
                </div>
                <div style="display: flex; align-items: center;">
                    <div class="quadrado"></div>
                    <strong style="margin-left: 5px;">REPROVADO</strong>
                </div>
            </div> --}}

            <div class="footer">
                <footer class="responsavel">{{--RESPONSAVEL--}}
                    <label style="font-size: 18px">{{ $responsavel }}</label>
                    <div class="linha-assinatura"></div>
                    <strong>Expedição</strong>
                </footer>
    
                <footer class="diretor">{{--DIRETOR--}}
                    <div class="linha-assinatura"></div>
                    <strong>Diretor</strong>
                </footer>
            </div>

        </body>
        
        
    </head>
</html>



<style type="text/css">
    body {
        font-family: 'Courier New', Courier, monospace;
    }

    .tabela2{
        margin-top: 25px;
        font-size: 12px;
    }

    .tabela2 td:nth-child(3) { /* Ajusta a largura da coluna 'Descrição' */
        width: 80px; /* Ajuste este valor conforme necessário */
        white-space: normal; /* Permite a quebra de texto */
    }

    .tabela2 td:nth-child(13) { /* Ajusta a largura da coluna 'Descrição' */
        white-space: normal; /* Permite a quebra de texto */
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    .quadrado {
        width: 20px;
        height: 20px;
        margin-bottom: 5px;
        border: 1px solid black;
    }

    td {
        padding: 2px;
        border: 1px solid #ddd;
    }

    .requisicao {
        font-size: 14px;
        text-align: center;
        margin-bottom: 10px;
        background-color: #f3f2f7;
    }

    .totais {
        text-align: center;
        margin-top: 70px;
        width: 25%;
        background-color: #f3f2f7;
    }

    label {
        font-size: 14px;
    } 
    
    .column-left {
        width: 50%;
        text-align: left;
    }

    .lb-left {
        font-size: 12px;
    }

    .lb-right {
        font-size: 18px;
    }

    .column-right {
        width: 50%;
        text-align: right;
    }

    #data {
        position: fixed;
        left: 0;
        bottom: 0;
        width: 20%;
        text-align: center;
    }

    .responsavel {
        position: fixed;
        font-size: 14px;
        left: 0px;
        bottom: 0;
        width: 30%;
        text-align: center;
    }

    .atotais {
        font-size: 12px; 
        font-style: italic;
    }

    .linha-totais {
        border-top: 1px dashed #000;
        position: relative;
        width: 100%;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .totalprodutos {
        margin-left: 550px;
        font-size: 12px; 
        font-style: italic;
    }

    .totalitens {
        margin-left: 569px;
        font-size: 12px; 
        font-style: italic;
    }

    .total {
        margin-top: 48px;
        margin-left: 606px;
        font-size: 12px; 
        font-style: italic;
    }

    .linha-assinatura {
        content: "";
        display: block;
        border-top: 1px solid #000;
        margin-bottom: 5px;
        position: relative;
        width: 100%;
        padding-top: 10px;
    }

    .diretor {
        font-size: 14px;
        position: fixed;
        /* left: 490px; */
        right: 0px;
        bottom: 0;
        width: 30%;
        text-align: center;
    }

</style>
        