                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Dispositivo</th>
                                <th>Monitoreo Vence</th>
                                @can('pays.create')
                                <th></th>
                                @endcan
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($devices as $device)
                                <tr>
                                    @can('devices.show')
                                    <td><a href="{{ route('devices.show', $device->id) }}" class="btn btn-sm btn-default">{{ $device->id }}</a></td>
                                    @endcan

                                    <td>{{ $device->monitor_expires }}</td>

                                    @can('pays.create')
                                    <td><a href="{{ route('pays.create', $device->id) }}">Hacer un Pago</a></td>
                                    @endcan
                                </tr>
                            @endforeach
                            @can('devices.index')
                                <tr><td colspan="5">Dirijase a la pestaña <a href="{{ route('devices.index') }}">Mis Dispositivos</a> para mas informacion</td></tr>
                            @endcan
                        </tbody>

                    </table>