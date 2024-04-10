<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Protocolo Atestado</title>
</head>
<body>
    <div class="container">
        <img class="logo-labor" src="images/logo/logoLabor.png" alt="Labor">
        <div class="texto-centralizado">
            RECEBIMENTO DE ATESTADO
        </div>
        <div class="borda-ao-redor">
            <div class="texto-direita">
                <div>PROTOCOLO</div>
                <div class="numero-protocolo">{{ $protocolo}}</div>
            </div>
        </div>
    </div>
    <div class="texto-container">
        @php
            $diaAtual = date('d');
            $mesAtual = date('m');
            $anoAtual = date('Y');

            $meses = array(
                '01' => 'Janeiro',
                '02' => 'Fevereiro',
                '03' => 'Março',
                '04' => 'Abril',
                '05' => 'Maio',
                '06' => 'Junho',
                '07' => 'Julho',
                '08' => 'Agosto',
                '09' => 'Setembro',
                '10' => 'Outubro',
                '11' => 'Novembro',
                '12' => 'Dezembro'
            );
            $mesAtualNome = $meses[$mesAtual];
        @endphp
        <p>Recebemos de <strong>{{ $funcionario }}</strong>, inscrito(a) no CPF sob o nº 
            <strong>{{ $cpfFuncionario }}</strong>, nesta data, o atestado médico emitido pelo(a) 
            <strong>Dr(a). {{ $profissional }}</strong>, com registro profissional nº 
            <strong>{{ $orgaoprof }} {{ $numeroregistro }}</strong>, com CID <strong>{{ $cid }}</strong>.<br>
            O atestado possui validade do dia <strong>{{ $datainicio }}</strong> até o dia <strong>{{ $datafim }}</strong>.</p>
            <p><strong>Local de emissão: {{ $locaisatendimento }}.</strong></p>
            <p><strong>Cascavel - PR, {{ $diaAtual }} de {{ $mesAtualNome }} de {{ $anoAtual }}.</strong></p><br>
        <p>------------------------------------<br>
        {{-- <strong>{{ $funcionario}}<br> --}}
        <strong>Labor Têxtil Eireli<br>
        26.886.695/0001-44</strong></p>
    </div>

    <div class="linha-horizontal"></div>

    <div class="container-2">
        <img class="logo-labor" src="images/logo/logoLabor.png" alt="Labor">
        <div class="texto-centralizado">
            RECEBIMENTO DE ATESTADO
        </div>
        <div class="borda-ao-redor">
            <div class="texto-direita">
                <div>PROTOCOLO</div>
                <div class="numero-protocolo">{{ $protocolo}}</div>
            </div>
        </div>
    </div>
    <div class="texto-container-2">
        <p>Recebemos de <strong>{{ $funcionario }}</strong>, inscrito(a) no CPF sob o nº 
            <strong>{{ $cpfFuncionario }}</strong>, nesta data, o atestado médico emitido pelo(a) 
            <strong>Dr(a). {{ $profissional }}</strong>, com registro profissional nº 
            <strong>{{ $orgaoprof }} {{ $numeroregistro }}</strong>, com CID <strong>{{ $cid }}</strong>.
            O atestado possui validade do dia <strong>{{ $datainicio }}</strong> até o dia <strong>{{ $datafim }}</strong>.</p>
            <p><strong>Local de emissão: {{ $locaisatendimento }}.</strong></p>
            <p><strong>Cascavel - PR, {{ $diaAtual }} de {{ $mesAtualNome }} de {{ $anoAtual }}.</strong></p><br>
        <p>------------------------------------<br>
        {{-- <strong>{{ $funcionario}}<br> --}}
       <strong>Labor Têxtil Eireli<br>
        26.886.695/0001-44</strong></p>
    </div>
</div>
</body>
</html>

<style>

    .linha-horizontal {
        border-bottom: 1px dotted black;
        position: absolute;
        width: 272mm; /* Largura da página A4 */
        left: -40;
        top: 407px; /* Ajuste a posição vertical da linha conforme necessário */
    }

    .texto-container {
        position: absolute;
        top: 100px; /* Posiciona abaixo do container */
        left: 10px;
        text-align: justify; /* Alinhar o texto à esquerda */
    }

    .texto-container-2 {
        position: absolute;
        top: 550px; /* Posiciona abaixo do container */
        left: 10px;
        text-align: justify; /* Alinhar o texto à esquerda */
    }


    body {
        font-family: "COURIER", 'Verdana', arial;
    }

    .container {
        position: absolute;
        top: 0;
        left: 0;
        width: 185mm; /* Largura da página A4 */
        /* height: 272mm; Altura da página A4 */
        height: 95mm;
        border: 2px solid black;
        text-align: center;
    }

    .container-2 {
        position: absolute;
        top: 450px;
        left: 0;
        width: 185mm; /* Largura da página A4 */
        /* height: 272mm; Altura da página A4 */
        height: 95mm;
        border: 2px solid black;
        text-align: center;
    }

    .container-2::after {
        content: "";
        display: block;
        width: 100%;
        height: 0;
        border-top: 2px solid black;
        position: absolute;
        top: 23%; /* Posiciona a linha exatamente no meio do container */
        transform: translateY(-50%); /* Centraliza verticalmente a linha */
    }

    .container::after {
        content: "";
        display: block;
        width: 100%;
        height: 0;
        border-top: 2px solid black;
        position: absolute;
        top: 23%; /* Posiciona a linha exatamente no meio do container */
        transform: translateY(-50%); /* Centraliza verticalmente a linha */
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

    .borda-ao-redor {
        border: 2px solid black;
        padding: 5px 60px; 
        position: absolute;
        top: 18px; 
        right: 15px;
        left: 565px;
        background-color: silver
    }

    .texto-direita {
        position: relative; /* Alterando para relative para ajustar a borda corretamente */
        transform: translateX(50%); /* Ajustar o posicionamento do texto centralizado */
        text-align: center; /* Centralizar o texto horizontalmente */
    }

    .numero-protocolo {
        font-size: 14px;
    }

</style>
