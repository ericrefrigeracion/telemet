@can('receptions.show-hour')
    <a href="{{ route('receptions.show-hour', $device->id) }}" class="btn btn-sm btn-primary m-1">Ver ultima hora</a>
@endcan
@if($device->admin_mon)
    @can('receptions.show-day')
        <a href="{{ route('receptions.show-day', $device->id) }}" class="btn btn-sm btn-primary m-1">Ver ultimo dia</a>
    @endcan
    @can('receptions.show-week')
        <a href="{{ route('receptions.show-week', $device->id) }}" class="btn btn-sm btn-primary m-1">Ver ultima semana</a>
    @endcan
    @can('receptions.show-month')
        <a href="{{ route('receptions.show-month', $device->id) }}" class="btn btn-sm btn-primary m-1">Ver ultimo mes</a>
    @endcan
    @can('receptions.show-all')
        <a href="{{ route('receptions.show-all', $device->id) }}" class="btn btn-sm btn-primary m-1 active">Ver todos los datos</a>
    @endcan
@endif