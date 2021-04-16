<table border="0" cellspacing="0" cellpadding="0">
    <thead>
        <tr>
            @foreach($columnas as $col)
                <td><b>{{ $col }}</b></td>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @php
            foreach ( $datos as $filas ) 
            {
                @endphp
                    <tr>
                @php
                    foreach ( $filas as $data ) 
                    {
                        @endphp
                            <td style="text-align: left;">@php echo isset($data) ? $data : 0;@endphp</td>
                        @php
                    }
                @endphp
                    </tr>
                @php
            }
        @endphp
    </tbody>
</table>