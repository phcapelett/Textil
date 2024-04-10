<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Relatório Mensal</title>
</head>
<body>
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

    <div class="container">
        <img class="logo-labor" src="images/logo/logoLabor.png" alt="Labor">
        <div class="texto-centralizado">
            {{ $title }} {{ $nomeMes }}
        </div>
        <div class="subTexto-centralizado">
            {{ $registros }} {{ $qtdRegistro }} eventos.
        </div>
    </div>

    @foreach ($relatorio as $indice => $dados)
        @if ($count % 12 == 0)
            @if ($count != 0)
                </tbody>
                </table>
                <div class="page-break"></div>
            @endif
                <div class="table-container">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>FUNCIONÁRIA(O)</th>
                                <th>PROFISSIONAL</th>
                                <th>PROFISSÃO</th>
                                <th>CID</th>
                                <th>TIPO EVENTO</th>
                                <th>LOCAL</th>
                                <th>EMISSÃO</th>
                                <th>ENTREGUE</th>
                                <th>INICIO</th>
                                <th>FIM</th>
                                <th>BAIXA</th>
                            </tr>
                        </thead>
                        <tbody>
        @endif
        <tr>
            <td>{{ $dados['FUNCIONARIO'] }}</td>
            <td>{{ $dados['PROFISSIONAL']}}</td>
            <td>{{ $dados['PROFISSAO'] }}</td>
            <td>{{ $dados['DESCRICAO'] }}</td>
            <td>{{ $dados['TIPO'] }}</td>
            <td>{{ $dados['LOCAIS']}}</td>
            <td>{{ date('d/m/Y', strtotime($dados['DATAEMISSAO'])) }}</td>
            <td>{{ date('d/m/Y', strtotime($dados['DATAENTREGUE'])) }}</td>
            <td>{{ date('d/m/Y H:i', strtotime($dados['DATAINICIO'])) }}</td>
            <td>{{ date('d/m/Y H:i', strtotime($dados['DATAFIM'])) }}</td>
            <td>{{ date('d/m/Y', strtotime($dados['DATABAIXA'])) }}</td>
        </tr>
        @php
            $count++;
        @endphp
    @endforeach
    </tbody>
    </table>
    </div>
</body>
</html>



<style scoped>
    .page-break {
        page-break-after: always;
    }

    .table-container {
        margin-top: 0px;
    }

    .table {
        width: 100%;
        table-layout: fixed;
        margin: 0 auto;
        text-align: center;
        border-collapse: collapse;
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
        top: 100px; /* Posiciona abaixo do container */
        left: 10px;
        text-align: justify; /* Alinhar o texto à esquerda */
    }

    body {
        font-family: "COURIER", 'Verdana', arial;
    }

    .container {
        position: relative; /* Alterado para relativo */
        width: 100%; /* Largura da página A4 */
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
        margin-top: 30px; /* Espaçamento de 10px entre a imagem e o texto */
    }

    .subTexto-centralizado {
        font-size: 15px;
        margin-top: 33px; /* Espaçamento de 10px entre a imagem e o texto */
    }

</style>
