<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Relatório Mensal</title>
</head>
<body>
    <!--BUSCAR DESCRIÇÃO DO MÊS-->
    @php
        $count = 0;
        $meses = array(
            '01' => 'JANEIRO',
            '02' => 'FEVEREIRO',
            '03' => 'MARÇO',
            '04' => 'ABRIL',
            '05' => 'MAIO',
            '06' => 'JUNHO',
            '07' => 'JULHO',
            '08' => 'AGOSTO',
            '09' => 'SETEMBRO',
            '10' => 'OUTUBRO',
            '11' => 'NOVEMBRO',
            '12' => 'DEZEMBRO'
        );
        $nomeMes = isset($meses[$mes]) ? $meses[$mes] : '';
    @endphp
    <!--FIM BUSCAR DESCRIÇÃO DO MÊS-->

    <div class="container">
        <img class="logo-labor" src="images/logo/logoLabor.png" alt="Labor">
        <div class="texto-centralizado">
                {{ $title }} {{ $nomeMes }}
        </div>
        <div class="texto-direita">
            <div class="quadrado">
                {{ $ano }}
            </div>
        </div>
        <div class="subTexto-centralizado">
            {{ $registros }}<strong>{{ $qtdRegistro }}{{ $qtdRegistro == 1 ? ' produto.' : ' produtos.' }}</strong><br>
            {{ $malha }} <strong>{{ $somaQtdRealMalha }} metros.</strong><br>
            {{ $tecido }} <strong>{{ $somaQtdRealTecido }} kilos.</strong>
        </div>
    </div>

    @foreach ($relatorio as $indice => $dados )
        @if($count % 13 == 0)
            @if($count != 0)
                </tbody>
                </table>
                <div class="page-break"></div>
            @endif
            <div class="table-container">
                <table class="table">
                    <thead>
                        <tr>
                            {{-- <th>CÓDIGO</th> --}}
                            <th>DIA</th>
                            <th>FORNECEDOR</th>
                            <th>TECIDO</th>
                            <th>COR</th>
                            <th>LOTE</th>
                            <th>QTD FORNECEDOR</th>
                            <th>PESO LIQUIDO</th>
                            <th>RENDIMENTO</th>
                            <th>QTD REAL</th>
                            <th>QTD VARIAVEL</th>
                            <th>MEDIA PONTOS</th>
                            <th>MAXIMO PONTOS</th>
                            <th>STATUS</th>
                            <th>DESCRICAO DEFEITO</th>
                        </tr>
                    </thead>
                    <tbody>
        @endif
        <tr>
            {{-- <td>{{ $dados->CODIGO }}</td> --}}
            <td>{{ date('d', strtotime($dados['DATAINSPECAO'])) }}</td>
            <td>{{ $dados['FORNECEDOR']}}</td>
            {{-- <td>{{ $dados->TECIDO }}</td> --}}
            <td>{{ preg_replace('/\(\d+\)\s+/', '', $dados['TECIDO']) }}</td>
            <td>{{ $dados['COR'] }}</td>
            <td>{{ $dados['NUMEROLOTE']}}</td>
            <td>{{ $dados['QTDFORNECEDOR']}}</td>
            <td>{{ $dados['PESOLIQUIDO']}}</td>
            <td>{{ $dados['RENDIMENTO']}}</td>
            <td>
                {{ $dados['QTDREAL'] }}
                @if ($dados['TIPO'] === 'TECIDO')
                    Kg
                @elseif ($dados['TIPO'] === 'MALHA')
                    Mts
                @endif
            </td>
            <td>{{ $dados['QTDVARIAVEL']}}</td>
            <td>{{ $dados['MEDIAPONTOS']}}</td>
            <td>{{ $dados['MAXIMOPONTOS']}}</td>
            <td>{{ $dados['STATUS']}}</td>
            <td>{{ $dados['DESCRICAODEFEITO']}}</td>
        </tr>
        @php $count++; @endphp
    @endforeach
    </tbody>
    </table>
    </div>
</body>
</html>

<style>
    .page-break {
        page-break-after: always;
    }
    .subTexto-centralizado {
        font-size: 15px;
        margin-top: 10px;
    }

    .table {
        width: 100%;
        table-layout: fixed;
        margin: 0 auto;
        text-align: center;
        border-collapse: collapse;
        margin-top: 30px;
    }

    .table th,
    .table td {
        border: 1px solid black;
        padding: 5px;
        font-size: 10px;
    }

    .table th {
        border: 1px solid black;
        padding: 5px;
        font-size: 10px;
        vertical-align: middle
    }

    .table td {
        font-size: 10px;
    }

    .texto-container {
        position: absolute;
        top: 100px;
        left: 10px;
        text-align: justify;
    }

    body {
        font-family: "COURIER", 'Verdana', arial;
    }

    .container {
        position: relative;
        width: 100%;
        height: 21mm;
        border: 2px solid black;
        text-align: center;
        margin-bottom: 30px; 
    }    

    .logo-labor{
        width: 100px;
        left: 10px;
        position: absolute;
        top: 14px;
    }

    .texto-centralizado {
        font-size: 23px;
        margin-top: 30px;
        /* text-align: center; */
    }

    .texto-direita{
        font-size: 25px;
        margin-top: -51px;
        text-align: right;
    }

    .quadrado {
        width: 50px;
        height: 50px;
        background-color: #3a3939;
        color: #fff; /* Cor do texto dentro do quadrado */
        text-align: center;
        line-height: 50px; /* Centralize verticalmente o texto */
        border: 2px solid #fff;
        border-radius: 10px;
        display: inline-block;
        padding: 10px;
        border-radius: 5px; 
    }

</style>
