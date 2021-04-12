@inject('GlobalFunction', 'App\Http\Controllers\MO113\ME5\SM1\Fth5001Controller')
<table border="0" cellspacing="0" cellpadding="0">
    <thead>
        <tr>
            <td><b>COD. TRABAJADOR</b></td>
            <td><b>DNI TRABAJADOR</b></td>
            <td><b>NOMBRE TRABAJADOR</b></td>
            <td><b># CREDITOS</b></td>
            <td><b>MONTO TOTAL</b></td>
        </tr>
    </thead>
    <tbody>
        @foreach ($datos as $sql)
            <tr>
                <td style="text-align: center;">{{ $sql->tcag }}</td>
                <td style="text-align: center;">{{ $sql->tdni }}</td>
                <td style="text-align: left;">{{ $GlobalFunction->LimpiarStrings($sql->tnom) }}</td>
                <td style="text-align: center;">{{ $sql->cant }}</td>
                <td style="text-align: center;">{{ $sql->tota }}</td>
            </tr>
        @endforeach
    </tbody>
</table>