                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Dispositivo</th>
                                <th>Monitoreo Vence</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($devices as $device)
                                <tr>
                                    @can('devices.show')
                                    <td><a href="{{ route('devices.show', $device->id) }}" class="btn btn-sm btn-default">{{ $device->name }}</a></td>
                                    @endcan
                                    <td>{{ $device->monitor_expires }}</td>
                                </tr>
                            @endforeach
                                <tr><td colspan="5">Dirijase a la pestaña <a href="{{ route('devices.index') }}">Mis Dispositivos</a> para mas informacion</td></tr>
                        </tbody>

                    </table>