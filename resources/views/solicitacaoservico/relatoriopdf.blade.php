<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>Relatório Sintético</title>
    </head>
    <body>
        <!--FIM BUSCAR DESCRIÇÃO DO MÊS-->
        <div class="container">
            <img class="logo-labor" src="images/logo/logoLabor.png" alt="Labor">
            <div class="texto-centralizado">
                    {{ $title }} {{ $mes }}
            </div>
        </div>
        <div>{{ $relatorio }}</div>
    </body>
</html>

<style scoped>
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
    }
</style>