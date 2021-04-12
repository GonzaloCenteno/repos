@inject('GlobalFunction', 'App\Http\Controllers\MO113\ME5\SM1\Fth5001Controller')
<table border="0" cellspacing="0" cellpadding="0">
    <thead>
        <tr>
            <td><b># CREDITO</b></td>
            <td><b>TIPO DE CREDITO</b></td>
            <td><b>COD. TRABAJADOR</b></td>
            <td><b>DNI TRABAJADOR</b></td>
            <td><b>NOMBRE TRABAJADOR</b></td>
            <td><b>COD. DEUDOR</b></td>
            <td><b>DNI DEUDOR</b></td>
            <td><b>NOMBRE DEUDOR</b></td>
            <td><b>FECHA DE PAGO</b></td>
            <td><b># CUOTA</b></td>
            <td><b>MONTO CUOTA</b></td>
            <td><b>TOTAL CUOTAS</b></td>
            <td><b>CUOTAS PENDIENTES</b></td>
            <td><b>SALDO CAPITAL</b></td>
        </tr>
    </thead>
    <tbody>
        @foreach ($datos as $sql)
            <tr>
                <td style="text-align: center;">{{ $sql->npre }}</td>
                <td style="text-align: left;">{{ $sql->tpag }}</td>
                <td style="text-align: left;">{{ $sql->tcag }}</td>
                <td style="text-align: center;">{{ $sql->tdni }}</td>
                <td style="text-align: left;">{{ $GlobalFunction->LimpiarStrings($sql->tnom) }}</td>
                <td style="text-align: left;">{{ $sql->dcag }}</td>
                <td style="text-align: left;">{{ $sql->ddni }}</td>
                <td style="text-align: left;">{{ $GlobalFunction->LimpiarStrings($sql->dnom) }}</td>
                <td style="text-align: left;">{{ $sql->fpag }}</td>
                <td style="text-align: left;">{{ $sql->ncuo }}</td>
                <td style="text-align: left;">{{ $sql->mcuo }}</td>
                <td style="text-align: left;">{{ $sql->tcuo }}</td>
                <td style="text-align: left;">{{ $sql->pcuo }}</td>
                <td style="text-align: left;">{{ $sql->sald }}</td>
            </tr>
        @endforeach
    </tbody>
</table>