<!DOCTYPE html>
<html>
<head>
    <title>{{ $subject }}</title>
</head>
<body>
    <h1>{{ $subject }}</h1>
    <p>{{ $body }}</p>
    <div>
        <table border="1" width="500">
            <thead>
                <tr>
                    <th colspan="2" style="padding: 10px; font-size: 18px">TOTAIS POR DESCRIÇÃO</th>
                </tr>
                <tr style="font-size: 14px">
                    <th>Descrição</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($totaisPorDescricao as $item)
                <tr>
                    <td style="border-top: 1px solid black; border-bottom: 1px solid black; padding: 5px 10px;">{{ $item['descricao'] }}</td>
                    <td style="border-top: 1px solid black; border-bottom: 1px solid black; padding: 5px 10px; text-align: center">{{ $item['total'] }}</td>
                </tr>
                @endforeach
                <tr>
                    <td style="font-weight: bold; border-top: 1px solid black; border-bottom: 1px solid black; padding: 5px 10px;">Total</td>
                    <td style="font-weight: bold; border-top: 1px solid black; border-bottom: 1px solid black; padding: 5px 10px; text-align: center">{{ $percentualBGrade }}%</td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>