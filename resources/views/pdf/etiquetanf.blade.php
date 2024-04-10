<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Etiqueta NF de Entrada</title>

    <style type="text/css">
        .header {
            text-align: center;
            font-size: 15px;
            margin-left: 0px;
            margin-top: -70px;
            position: relative;
            white-space: nowrap;
        }
        .tabela{
            border: 0.3px solid black;
            font-size: 7.5px;
            margin-left: -70px;
            margin-top: -30px;
            position: absolute;
            text-align: center;
            border-collapse: collapse;
        }
        .tddados{
            font-size: 4px;
        }
        .tabela td {
            border: 0.3px solid black;
        }
    </style>

</head>
<body>
    <div class="header">
        <strong>Relação de Itens</strong>
        <strong>{{ $dataetiqueta }}</strong>
    </div>
    
    <table class="tabela">
        <tr class="cabecalho">
            <td>ROM</td>
            <td>OP</td>
            <td>PRODUTO</td>
            <td>COR</td>
            <td>XS</td>
            <td>S</td>
            <td>M</td>
            <td>L</td>  
            <td>XL</td>
            <td>XXL</td>
            <td>TOTAL</td>
        </tr>
        @foreach ($itensTabela as $itens)
                <tr class="tddados">
                <td style="width: 15px">{{ $itens['ROM'] }}</td>
                <td style="width: 15px">{{ $itens['OP'] }}</td>
                <td style="width: 58px">{{ $itens['DESCPRODUTO'] }}</td>
                <td style="width: 2px">{{ $itens['COR'] }}</td>
                <td style="width: 1px">{{ $itens['XS'] }}</td>
                <td style="width: 1px">{{ $itens['S'] }}</td>
                <td style="width: 1px">{{ $itens['M'] }}</td>
                <td style="width: 1px">{{ $itens['L'] }}</td>
                <td style="width: 1px">{{ $itens['XL'] }}</td>
                <td style="width: 1px">{{ $itens['XXL'] }}</td>
                <td style="width: 2px">{{ $itens['TOTAL'] }}</td>
            </tr>
        @endforeach
    </table>
</body>
</html>
