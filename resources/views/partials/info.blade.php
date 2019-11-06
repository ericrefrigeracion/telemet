                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                @can('devices.show')
                                    <th>Dispositivo</th>
                                @endcan
                                @can('users.show')
                                    <th>Usuario</th>
                                @endcan
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

                                    @can('users.show')
                                    <td><a href="{{ route('users.show', $device->user->id) }}" class="btn btn-sm btn-default">{{ $device->user->id }}</a></td>
                                    @endcan

                                    <td>{{ $device->monitor_expires }}</td>

                                    @can('pays.create')
                                    <td><a href="{{ route('pays.create', $device->id) }}"><i class="fas fa-dollar-sign" title="Hacer un Pago"></i></a></td>
                                    @endcan
                                </tr>
                            @endforeach
                            @can('devices.index')
                                <tr><td colspan="5">Dirijase a la pestaña <a href="{{ route('devices.index') }}">Mis Dispositivos</a> para mas informacion</td></tr>
                            @endcan
                            @can('home.all')
                                <tr><td colspan="5">Ver el vencimiento de <a href="{{ route('home.all') }}">Todos los Dispositivos</a></td></tr>
                            @endcan
                        </tbody>

                    </table>