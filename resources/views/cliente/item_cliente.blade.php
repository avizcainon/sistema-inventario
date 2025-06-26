@if ($clientes->isEmpty())
   No se encontraron clientes que coincidan con la búsqueda.
@else


    <table class="table table-striped table-hover">
        <thead class="thead">
            <tr>
                <th>No</th>
                                            
                <th class="color-secundario">Dni</th>
                <th >Nombre</th>
                <th >Apellido</th>
                <th >Telefono</th>
                <th >Correo</th>

                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($clientes as $cliente)
                <tr>
                    <td>{{ $cliente->id }}</td>
                                                
                    <td >{{ $cliente->dni }}</td>
                    <td >{{ $cliente->nombre }}</td>
                    <td >{{ $cliente->apellido }}</td>
                    <td >{{ $cliente->telefono }}</td>
                    <td >{{ $cliente->correo }}</td>

                    <td>
                        <form action="{{ route('clientes.destroy', $cliente->id) }}" method="POST">
                            <button
                                type="button"
                                class="btn btn-primary btn-sm add-to-list-btn" 
                                data-client-id="{{ $cliente->id }}"
                                data-client-dni="{{ $cliente->dni }}"
                                data-client-nombre="{{ $cliente->nombre }}"
                                data-client-apellido="{{ $cliente->apellido }}">
                                
                               <i class="bi bi-plus-circle"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>


@endif