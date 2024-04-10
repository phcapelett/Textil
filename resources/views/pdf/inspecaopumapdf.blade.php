<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>Relatório Puma</title>
    </head>
    <body>
        <div class="page-1">{{--PÁGINA 1--}}
            <div class="header">
                <img class="logo-left" src="images/logo/logoLabor.png" alt="Labor">
                <h1 class="title">{{ $title }}</h1>
                <img class="logo-right" src="images/logo/puma-logo-vector.png" alt="Puma">  
            </div>

            <table>{{--CABEÇALHO--}}
                <thead>
                    <tr>
                        <th>Número do Pedido</th>
                        <td>{{ $numPedido }}</td>
                    </tr>
                    <tr>
                        <th>Ordem de Produção</th>
                        <td>{{ $ordemProducao }}</td>
                    </tr>
                    <tr>
                        <th>Quantidade do Pedido</th>
                        <td>{{ $qtdePedidoOriginal }}</td>
                    </tr>
                    <tr>
                        <th>Descrição do Estilo</th>
                        <td>{{ $descriEstilo }}</td>
                    </tr>
                    <tr>
                        <th>Estilo</th>
                        <td>{{ $estilo }}</td>
                    </tr>
                    <tr>
                        <th>Cor</th>
                        <td>{{ $cor }}</td>
                    </tr>
                </thead>
            </table>

            <div class="table-container">{{--TABELA AMOSTRAGEM E TOTAL--}}
                <table id="tabela-amostra">
                    <caption class="head-table">TABELA AMOSTRAGEM</caption>
                    <thead>
                        <tr>{{--CABEÇALHO--}}
                            <th>QT DO PEDIDO</th>
                            <th>TAM. AMOSTRA</th>
                            <th>ACEITA</th>
                            <th>REJEITA</th>
                            <th>QT DO PEDIDO</th>
                            <th>TAM. AMOSTRA</th>
                            <th>ACEITA</th>
                            <th>REJEITA</th>
                        </tr>
                        <tr>{{--PRIMEIRA LINHA--}}
                            <td>90</td>
                            <td>13</td>
                            <td>0</td>
                            <td>1</td>
                            <td>501 - 1200</td>
                            <td>80</td>
                            <td>2</td>
                            <td>3</td>                    
                        </tr>
                        <tr>{{--SEGUNDA LINHA--}}
                            <td>91 - 150</td>
                            <td>20</td>
                            <td>0</td>
                            <td>1</td>
                            <td>1201 - 3200</td>
                            <td>125</td>
                            <td>3</td>
                            <td>4</td>
                        </tr>
                        <tr>{{--TERCEIRA LINHA--}}
                            <td>151 - 280</td>
                            <td>32</td>
                            <td>0</td>
                            <td>1</td>
                            <td>3201 - 10000</td>
                            <td>200</td>
                            <td>5</td>
                            <td>6</td>
                        </tr>
                        <tr>{{--QUARTA LINHA--}}
                            <td>281 - 500</td>
                            <td>50</td>
                            <td>1</td>
                            <td>2</td>
                            <td>10001 - 35000</td>
                            <td>315</td>
                            <td>7</td>
                            <td>8</td>
                        </tr>
                    </thead>
                </table>
                <div class="table-totais">{{--AMOSTRA INSPECIONADA--}}
                    <table>
                        <tr>
                            <td><strong>Tamanho da amostra Inspecionada:</strong></td>
                            <td>{{ $amostraEtiquetas }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="table-container">{{-- TABELA GRUPO DEFEITOS E TOTAL--}}
                {{-- <strong>DEFEITOS</strong> --}}
                <table id="tabela-amostra">
                    <caption class="head-table">DEFEITOS</caption>
                    <thead>
                        <tr>
                            <th>Grupo de Defeitos</th>
                            <th>Descrição Defeito</th>
                            <th>QT Defeitos</th>
                        </tr>
                    </thead>
                    <tbody>     
                        <!--?php dd($gruposSelecionados); ?-->
                        @php                   
                            usort($grupos, function($a, $b) {
                                return $a['codigo'] <=> $b['codigo'];
                            });
                        @endphp
                        @if ($grupos){
                            <!--?php dd($gruposSelecionados); ?-->
                            @foreach ($grupos as $grupo)
                                @php 
                                    $linha = ['quantidade' => $grupo['quantidade']]; 
                                @endphp
                                <tr>
                                    <td>{{ $grupo['codigo'] }}</td>
                                    <td>{{ $grupo['descricao'] }}</td>
                                    <td>{{ $linha['quantidade'] }}</td>
                                </tr>
                            @endforeach
                        }@else{
                            <tr><td>Sem Grupo</td><td>Sem defeitos</td><td>0</td></tr>
                        }
                        @endif
                    </tbody>
                </table>
                <div class="table-totais">
                    <table>
                        <tr>
                            <td><strong>Total de Defeitos:</strong></td>
                            <td>{{ $totalDefeitos }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="passou">{{--PASSOU--}}
                <strong>{{ $passou == 'sim' ? 'INSPEÇÃO APROVADA' : 'INSPEÇÃO REPROVADA' }}</strong>
            </div>

            <div class="observacao"> {{--OBSERVACAO--}}
                @if ($observacaoInspecao)
                    <strong>Observações</strong>
                    <textarea>{{ $observacaoInspecao }}</textarea>
                @else
                    <strong>Observações</strong>
                    <textarea>Sem observações</textarea>
                @endif
            </div>

            <div class="observacao">{{--ACAO TOMADA--}}
                @if ($acaoTomada)
                    <strong>Ação Tomada pela Fábrica</strong>
                    <textarea>{{ $acaoTomada }}</textarea> 
                @else
                    <strong>Ação Tomada pela Fábrica</strong>
                    <textarea>Sem ações</textarea>            
                @endif
            </div>

            <div class="footer">
                <footer id="data">{{--DATA INSPECAO--}}
                    <label style="font-size: 20px">{{ $dataInspecao }}</label>
                    <div class="linha-assinatura"></div>
                    <strong>Data da Inspeção</strong>
                </footer>
    
                <footer id="inspet">{{--INSPETOR--}}
                    <label style="font-size: 20px">{{ $inspetor }}</label>
                    <div class="linha-assinatura"></div>
                    <strong>Inspetor</strong>
                </footer>
    
                <footer id="assinatura-inspet">{{--ASSINATURA--}}
                    <div class="linha-assinatura"></div>
                    <strong>Assinatura Inspetor</strong>
                </footer>
            </div>
        </div>
        
        <div class="page-2" style="page-break-before: always;">{{--PÁGINA 2--}}
            <div class="header">
                <img class="logo-left2" src="images/logo/logoBr5.png" alt="BR5">
                <h1 class="title2">{{ $title2 }}</h1>
                <h1 class="title2_1">{{ $title2_1 }}</h1>
                <img class="logo-right2" src="images/logo/puma-logo-vector.png" alt="Puma">  
            </div>

            <table>{{--CABEÇALHO--}}
                <thead>
                    <tr>
                        <th>Código da Fábrica</th>
                        <td>TBRAR</td>
                    </tr>
                    <tr>
                        <th>Estilo #</th>
                        <td>{{ $descriEstilo }}</td>
                    </tr>
                    <tr>
                        <th>Cor #</th>
                        <td>{{ $cor }}</td>
                    </tr>
                    <tr>
                        <th>P.O #</th>
                        <td>{{ $numPedido }}</td>
                    </tr>
                    <tr>
                        <th>Data da Inspeção</th>
                        <td>{{ $dataInspecao }}</td>
                    </tr>
                    <tr>
                        <th>Estação</th>
                        <td>{{ $colecao }}</td>
                    </tr>
                    <tr>
                        <th>P.O Quantidade</th>
                        <td>{{ $qtdePedidoOriginal }}</td>
                    </tr>
                    <tr>
                        <th>QT Enviada</th>
                        <td>{{ $totalInspecao }}</td>
                    </tr>
                </thead>
            </table>

            <div class="table-container">{{--TABELA TIPO DETECTOR--}}
                <table id="tabela-amostra">
                    <caption class="head-table">INFORMAÇÃO</caption>
                    <thead>
                        <tr>
                            <th>Tipo de Detector</th>
                            <th>Transportador 01</th>
                            <th>Transportador 02 ( Portão Duplo )</th>
                            <th>Portátil</th>
                        </tr>
                        <tr>
                            <td>Marca</td>
                            <td>Detronix</td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Modelo #</td>
                            <td>MettusAT - 46408</td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Sensibilidade</td>
                            <td>1.00 mm</td>
                            <td>1.00 mm</td>
                            <td>1.00 mm</td>
                        </tr>
                    </thead>
                </table>
            </div>

            <div class="table-container">{{--TABELA PASSAGEM METAL--}}
                <table id="tabela-amostra">
                    <caption class="head-table">QUANTIDADES DE PASSAGEM DE METAL DETECTADAS POR TAMANHO</caption>
                    <thead>
                        {{-- <tr> GRADE POR TAMANHO ENTREGUE
                            <th>XS</th>
                            <th>S</th>
                            <th>M</th>
                            <th>L</th>
                            <th>XL</th>
                            <th>XXL</th>
                            <th>3XL</th>
                        </tr>
                        <tr>
                            @for ($i = 1; $i <= 7; $i++)
                                <td>{{ ${"tam$i"} }}</td>
                            @endfor
                        </tr> --}}
                        <tr>
                            <th>XS</th>
                            <th>S</th>
                            <th>M</th>
                            <th>L</th>
                            <th>XL</th>
                            <th>XXL</th>
                            <th>3XL</th>
                        </tr>
                        <tbody>
                            {{-- <tr>
                                <td>{{ $tam1 }}</td>
                                <td>{{ $tam2 }}</td>
                                <td>{{ $tam3 }}</td>
                                <td>{{ $tam4 }}</td>
                                <td>{{ $tam5 }}</td>
                                <td>{{ $tam6 }}</td>
                                <td>{{ $tam7 }}</td>
                            </tr> --}}
                            <tr>
                                @for ($i = 0; $i < 7; $i++)
                                    <td>{{ $amsTams[$i] }}</td>
                                @endfor
                            </tr>
                            {{--<tr>
                                @php $tamanhos=['XS','S','M','L','XL','XXL','3XL'] @endphp
                                @foreach($tamanhos as $tamanho)
                                    <td>{{ isset($somaPorTamanho[$tamanho]) ? $somaPorTamanho[$tamanho] : '0' }}</td>
                                @endforeach
                            </tr> --}}
                        </tbody>
                    </thead>
                </table>
            </div>

            <div class="aprovado">{{--APROVADO--}}
                <strong>{{ $aprovado == 'sim' ? 'TESTE APROVADO' : 'TESTE REPROVADO' }}</strong>
                {{-- <p>{{ $aprovado == 'sim' ? 'SIM' : 'NÃO' }}</p> --}}
            </div>

            <div class="informativo">{{--INFORMATIVO--}}
                Nós, por meio deste, confirmamos que inspecionamos o estilo / quantidade acima mencionado
                por detector de metais de ambas as diferenças e separamos qualquer produto contaminado com
                metal de envio.
            </div>

            <div class="footer">{{--RODAPÉ--}}
                <footer class="inspet">{{--INSPETOR--}}
                    <label style="font-size: 20px">{{ $inspetor }}</label>
                    <div class="linha-assinatura"></div>
                    <strong>Representante da Fábrica</strong>
                </footer>
    
                <footer id="assinatura-inspet">{{--ASSINATURA--}}
                    <div class="linha-assinatura"></div>
                    <strong>Ger. De Qualidade da Fábrica</strong>
                </footer>
            </div>
        </div>

        {{-- <div class="page-3" style="page-break-before: always;">--PAGINA 3
            <div class="header">
                <img class="logo-left" src="images/logo/logoBr5.png" alt="BR5">
                <h1 class="title">{{ $title }}</h1>
                <img class="logo-right" src="images/logo/puma-logo-vector.png" alt="Puma">  
            </div>

            <div class="footer">{{--RODAPÉ}}
                <footer class="inspet">{{--INSPETOR-
                    <label style="font-size: 20px">{{ $inspetor }}</label>
                    <div class="linha-assinatura"></div>
                    <strong>Inspetor</strong>
                </footer>
    
                <footer id="assinatura-inspet">{{--ASSINATURA
                    <div class="linha-assinatura"></div>
                    <strong>Assinatura Inspetor</strong>
                </footer>
            </div>
        </div> --}}
    </body>
</html>



<style type="text/css">
    .passou{
        text-align: center;
        margin-top: 50px;
        font-size: 20px;
    }

    .aprovado{
        text-align: center;
        margin-top: 120px;
        font-size: 20px;
    }

    .page-2 .footer .inspet {
        position: fixed;
        left: 0;
        bottom: 0;
        width: 30%;
        text-align: center;
    }

    .page-3 .footer .inspet {
        position: fixed;
        left: 0;
        bottom: 0;
        width: 30%;
        text-align: center;
    }

    .informativo {
        border: 1px solid #000;
        padding: 10px;
        text-align: justify;
        font-size: 19px;
        margin-top: 100px;
    }

    .head-table{
        caption-side: top; 
        text-align: center; 
        font-weight: bold;
    }

    .observacao{
        margin-top: 10px;
    }

    #data {
        position: fixed;
        left: 0;
        bottom: 0;
        width: 20%;
        text-align: center;
    }

    #inspet {
        position: fixed;
        left: 200px;
        bottom: 0;
        width: 30%;
        text-align: center;
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

    #assinatura-inspet {
        position: fixed;
        left: 490px;
        bottom: 0;
        width: 30%;
        text-align: center;
    }

    textarea {
        font-size: 0.8rem;
        padding: 5px;
        max-width: 100%;
        line-height: 1.5;
        border: 1px solid #000000;
        font-family: Arial;
        font-size: 16px;
    }

    .table-totais{
        float: right;
        width: 30%;
    }

    .table-container{
        text-align: center;
        margin-top: 15px;
        margin-bottom: 48px;
    }

    #tabela-amostra th, td {
        text-align: center;
    }

    table, td, th {
        border: 1px solid black;
        font-size: 16px;
        height: 25px;
    }

    table {
        border-collapse: collapse;
        width: 100%;
        margin-bottom: 5px;
    }

    th {
        text-align: left;
    }

    .header {
        border: 2px solid black;
        padding: 25px;
        margin-bottom: 15px;
    }

    .logo-left {
        max-width: 100px;     
        position:absolute;
        left: 10px;
        top: 10px;
    }

    .logo-left2 {
        max-width: 100px;     
        position:absolute;
        left: 10px;
        top: 20px;
    }

    .logo-right2 {
        max-width: 100px;
        position:absolute;
        right: 10px;
        top: 20px;
    }

    .logo-right {
        max-width: 100px;
        position:absolute;
        right: 10px;
        top: 10px;
    }

    .title {
        font-size: 20px;
        font-weight: bold;
        text-align: center;
        margin: 0px;
    }

    .title2, .title2_1{
        font-size: 16px;
        font-weight: bold;
        text-align: center;
        margin: 0px;
    }
</style>
        