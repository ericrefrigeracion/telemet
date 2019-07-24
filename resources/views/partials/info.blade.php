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
                                    @can('devices.show')
                                    <td><a href="{{ route('devices.show', $device->id) }}" class="btn btn-sm btn-default">{{ $device->id }}</a></td>
                                    @endcan
                                    <td>{{ $device->last_created_at }}</td>
                                    <td>{{ $device->last_data01 }}</td>
                                    <td>{{ $device->last_rssi }}</td>
                                </tr>
                            @endforeach
                                <tr><td colspan="5">Dirijase a la pestaña <a href="{{ route('devices.index') }}">Mis Dispositivos</a> para mas informacion</td></tr>
                        </tbody>

                    </table>