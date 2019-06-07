                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th width="15%">ID</th>
                                <th width="40%">Ultima Conexion</th>
                                <th width="25%">Ultima Medicion</th>
                                <th width="20%">Señal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($devices as $device)
                                <tr>
                                    <td>{{ $device->id }}</td>
                                    <td>{{ $device->last_created_at }}</td>
                                    <td>{{ $device->last_data01 }}</td>
                                    <td>{{ $device->last_rssi }}</td>
                                </tr>
                            @endforeach
                                <tr><td colspan="5">Dirijase a la pestaña dispositivos para mas informacion</td></tr>
                        </tbody>

                    </table>