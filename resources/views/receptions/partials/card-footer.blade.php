@if($device->admin_mon)
    @can('receptions.now')
        <a href="{{ route('receptions.now', $device->id) }}" class="btn btn-sm btn-primary m-1">Ultima hora</a>
    @endcan
    @can('receptions.today')
        <a href="{{ route('receptions.today', $device->id) }}" class="btn btn-sm btn-primary m-1">Hoy</a>
    @endcan
    @can('receptions.yesterday')
        <a href="{{ route('receptions.yesterday', $device->id) }}" class="btn btn-sm btn-primary m-1">Ayer</a>
    @endcan
    @can('receptions.week')
        <a href="{{ route('receptions.week', $device->id) }}" class="btn btn-sm btn-primary m-1">Ultima Semana</a>
    @endcan
@endif