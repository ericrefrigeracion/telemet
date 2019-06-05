                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th width="15%">Id</th>
                                <th width="40%">Ultima Conexion</th>
                                <th width="25%">Estado</th>
                                <th width="20%">Señal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($devices as $device)
                                <tr>
                                    <td>{{ $device->id }}</td>
                                    <td>{{ $device->last_connection->diffForHumans() }}</td>
                                    <td>OK</td>
                                    <td>{{ $device->rssi }}</td>
                                </tr>
                            @endforeach
                                <tr><td colspan="5">Dirijase a la pestaña dispositivos para mas informacion</td></tr>
                        </tbody>

                    </table>