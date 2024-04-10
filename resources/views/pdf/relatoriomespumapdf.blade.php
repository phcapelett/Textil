<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>Relatório do Mês</title>
    </head>
    <body>
        @foreach ($relatorio as $indice => $dados)
        <div style="page-break-inside: avoid;">
            
        <div class="page-1">
            <div class="header">
                <img class="logo-left" src="images/logo/logoLabor.png" alt="Labor">
                <h1 class="title">{{ $title }}</h1>
                <h1 class="title">{{ $mesSelecionado }}</h1>
                <img class="logo-right" src="images/logo/puma-logo-vector.png" alt="Puma">  
            </div>
        </div>
            <h1>Dados da(o) {{ $indice + 1}}° OP</h1>
                <!-- Loop para percorrer os elementos de cada array -->
                {{-- @foreach ($dados as $chave => $valor)
                    <li>{{ $chave }}: {{ $valor }}</li>
                   @php dd($chave. ':'. $valor) @endphp
                @endforeach --}}
                <table>
                    <tr>
                        <td style="font-weight: bold;">ORDEM DE PRODUÇÃO</td>
                        <td>{{ $dados['ORDEMPRODUCAO'] }}</td>
                        <td style="font-weight: bold;">DATA DO CONTROLE</td>
                        <td>{{ app('Carbon\Carbon')->parse($dados['DATACONTROLE'])->format('d/m/Y') }}</td>
                    </tr>                   
                    <tr>
                        <td style="font-weight: bold;">PEDIDO DO CLIENTE</td>
                        <td>{{ $dados['PEDIDOCLIENTE'] }}</td>
                        <td style="font-weight: bold;">REFERÊNCIA DO PRODUTO</td>
                        <td>{{ $dados['REFERENCIAPRODUTO'] }}</td>
                    </tr>
                </table>
                <h2>RELAÇÃO DAS GRADES</h2>
                <h3>PEDIDO DO CLIENTE</h3>
                <table>
                    <tr>
                        @foreach (['XS', 'S', 'M', 'L', 'XL', 'XXL', '3XL','TOTAL'] as $tamanho)
                            <th style="text-align: center; width: 75px">{{ $tamanho }}</th>
                        @endforeach
                    </tr>
                    <tr>
                        <!-- Loop para percorrer os campos específicos do array $dados e criar as células da tabela -->
                        @foreach (['PCXS', 'PCS', 'PCM', 'PCL', 'PCXL', 'PCXXL', 'PC3XL','PCTOTAL'] as $campo)
                            <td style="text-align: center">{{ $dados[$campo] }}</td>
                        @endforeach
                    </tr>
                </table>
                <h3>CORTADO PELA LABOR</h3>
                <table>
                    <tr>
                        @foreach (['XS', 'S', 'M', 'L', 'XL', 'XXL', '3XL','TOTAL'] as $tamanho)
                            <th style="text-align: center; width: 75px">{{ $tamanho }}</th>
                        @endforeach
                    </tr>
                    <tr>
                        <!-- Loop para percorrer os campos específicos do array $dados e criar as células da tabela -->
                        @foreach (['CLXS', 'CLS', 'CLM', 'CLL', 'CLXL', 'CLXXL', 'CL3XL','CLTOTAL'] as $campo)
                            <td style="text-align: center">{{ $dados[$campo] }}</td>
                        @endforeach
                    </tr>
                </table>
                <h3>DETECTOR DE METAIS</h3>
                <table>
                    <tr>
                        @foreach (['XS', 'S', 'M', 'L', 'XL', 'XXL', '3XL','TOTAL'] as $tamanho)
                            <th style="text-align: center; width: 75px">{{ $tamanho }}</th>
                        @endforeach
                    </tr>
                    <tr>
                        <!-- Loop para percorrer os campos específicos do array $dados e criar as células da tabela -->
                        @foreach (['DMXS', 'DMS', 'DMM', 'DML', 'DMXL', 'DMXXL', 'DM3XL','DMTOTAL'] as $campo)
                            <td style="text-align: center">{{ $dados[$campo] }}</td>
                        @endforeach
                    </tr>
                </table>
                <h3>FATURADA</h3>
                <table>
                    <tr>
                        @foreach (['XS', 'S', 'M', 'L', 'XL', 'XXL', '3XL','TOTAL'] as $tamanho)
                            <th style="text-align: center; width: 75px">{{ $tamanho }}</th>
                        @endforeach
                    </tr>
                    <tr>
                        <!-- Loop para percorrer os campos específicos do array $dados e criar as células da tabela -->
                        @foreach (['FATXS', 'FATS', 'FATM', 'FATL',  'FATXL', 'FATXXL', 'FAT3XL','FATTOTAL'] as $campo)
                            <td style="text-align: center">{{ $dados[$campo] }}</td>
                        @endforeach
                    </tr>
                </table>
                <h3>B-GRADE</h3>
                <table>
                    <tr>
                        @foreach (['XS', 'S', 'M', 'L', 'XL', 'XXL', '3XL','TOTAL'] as $tamanho)
                            <th style="text-align: center; width: 75px">{{ $tamanho }}</th>
                        @endforeach
                    </tr>
                    <tr>
                        <!-- Loop para percorrer os campos específicos do array $dados e criar as células da tabela -->
                        @foreach (['BGXS', 'BGS', 'BGM', 'BGL', 'BGXL', 'BGXXL', 'BG3XL','BGTOTAL'] as $campo)
                            <td style="text-align: center">{{ $dados[$campo] }}</td>
                        @endforeach
                    </tr>
                </table>
                <h3>C-GRADE</h3>
                <table>
                    <tr>
                        @foreach (['XS', 'S', 'M', 'L', 'XL', 'XXL', '3XL','TOTAL'] as $tamanho)
                            <th style="text-align: center; width: 75px">{{ $tamanho }}</th>
                        @endforeach
                    </tr>
                    <tr>
                        <!-- Loop para percorrer os campos específicos do array $dados e criar as células da tabela -->
                        @foreach (['CGXS', 'CGS', 'CGM', 'CGL', 'CGXL', 'CGXXL', 'CG3XL', 'CGTOTAL'] as $campo)
                            <td style="text-align: center">{{ $dados[$campo] }}</td>
                        @endforeach
                    </tr>
                </table>
        </div>
        @endforeach   
        <div style="page-break-inside: avoid;">
            <table style="border: 1px">
                <thead>
                    <tr>
                        <th colspan="2" style="padding: 10px; font-size: 20px; text-align: center">TOTAIS POR DESCRIÇÃO</th>
                    </tr>
                    <tr style="font-size: 18px">
                        <th style="text-align: center">DESCRIÇÃO</th>
                        <th style="text-align: center">TOTAL</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="border-top: 1px solid black; border-bottom: 1px solid black; padding: 5px 10px;">PEDIDO CLIENTE</td>
                        <td style="border-top: 1px solid black; border-bottom: 1px solid black; padding: 5px 10px; text-align: center">{{ $totalpc }}</td>
                    </tr>
                    <tr>
                        <td style="border-top: 1px solid black; border-bottom: 1px solid black; padding: 5px 10px;">CORTADA PELA LABOR</td>
                        <td style="border-top: 1px solid black; border-bottom: 1px solid black; padding: 5px 10px; text-align: center">{{ $totalcl }}</td>
                    </tr>
                    <tr>
                        <td style="border-top: 1px solid black; border-bottom: 1px solid black; padding: 5px 10px;">FATURADA</td>
                        <td style="border-top: 1px solid black; border-bottom: 1px solid black; padding: 5px 10px; text-align: center">{{ $totalfat }}</td>
                    </tr>
                    <tr>
                        <td style="border-top: 1px solid black; border-bottom: 1px solid black; padding: 5px 10px;">B-GRADE</td>
                        <td style="border-top: 1px solid black; border-bottom: 1px solid black; padding: 5px 10px; text-align: center">{{ $totalbg }}</td>
                    </tr>
                    <tr>
                        <td style="border-top: 1px solid black; border-bottom: 1px solid black; padding: 5px 10px;">C-GRADE</td>
                        <td style="border-top: 1px solid black; border-bottom: 1px solid black; padding: 5px 10px; text-align: center">{{ $totalcg }}</td>
                    </tr>
                    <tr>
                        <td style="border-top: 1px solid black; border-bottom: 1px solid black; padding: 5px 10px; font-weight: bold">EFICIÊNCIA</td>
                        <td style="border-top: 1px solid black; border-bottom: 1px solid black; padding: 5px 10px; text-align: center; font-weight: bold">{{ $bgrade }}%</td>
                    </tr>
                </tbody>
            </table>
        </div>     
    </body>
</html>



<style type="text/css">

    h2{
        text-align: center;
    }

    .head-table{
        caption-side: top; 
        text-align: center; 
        font-weight: bold;
    }

    table, td, th {
        border: 1px solid black;
        font-size: 16px;
        height: 25px;
        text-align: left;
    }

    table {
        border-collapse: collapse;
        width: 100%;
        margin-bottom: 5px;
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
        top: 25px;
    }

    .logo-right {
        max-width: 100px;
        position:absolute;
        right: 10px;
        top: 20px;
    }

    .title {
        font-size: 20px;
        font-weight: bold;
        text-align: center;
        margin: 0px;
    }
</style>
        