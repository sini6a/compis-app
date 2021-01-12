@extends('layouts.app')

@section('content')
<style>
.navigation {
    justify-content: center;
}
</style>

<div class="container">
    <div class="row justify-content-center">
    
    <div class="col-md-8">
    <a class="btn btn-primary" href="{{ route('admin.index') }}"><i class="fas fa-fw fa-home"></i> Gå hem</a>
    </div>

    <form id="request-inspection-form" action="{{ route('admin.computer.update', $computer) }}" method="POST" style="display: none;">
        @csrf
        @method('PATCH')
    </form>

    <div class="col-md-8 mt-3">

    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

        <div class="card">
            <div class="card-header"><i class="fas fa-fw fa-user"></i> Admin Panel</div>

            <div class="card-body">
                <a href="{{ route('admin.service.create', $computer) }}" class="btn btn-sm btn-success">Add Service</a>
                @if ($computer->inspection)
                <a class="btn btn-success btn-sm" href="{{ route('admin.computer.update', $computer) }}"
                    onclick="event.preventDefault();
                    document.getElementById('request-inspection-form').submit();">Mark as inspected</a>
                @else
                <a class="btn btn-danger btn-sm" href="{{ route('admin.computer.update', $computer) }}"
                    onclick="event.preventDefault();
                    document.getElementById('request-inspection-form').submit();">Mark for inspection</a>
                @endif
                <a href="{{ route('admin.user.show', $computer->user) }}" class="btn btn-sm btn-info">Customer Details</a>
            </div>
        </div>
    </div>

        <div class="col-md-8 mt-3">
            <div class="card">
                <div class="card-header"><i class="fas fa-fw fa-desktop"></i> Configuration</div>

                <div class="card-body">

                    <h3 class="{{ $computer->inspection ? 'text-danger' : '' }}">@if ($computer->inspection)<i class="fas fa-fw fa-exclamation"></i>@endif {{ $computer->friendly_name }}</h3>

                    <hr>
                    @if ($computer->inspection)
                            <p class="text-danger">* <i class="fas fa-fw fa-exclamation"></i> - Inspektion beställd!</p>
                    @endif
                    <p>Processor: {{ $computer->processor }}</p>
                    <p>Grafikkort: {{ $computer->graphics }} </p>
                    <p>RAM Minne: {{ $computer->ram }} GB. </p>
                    <p>Kapacitet: {{ $computer->storage }} GB. </p>

                    <hr>
                    <p>
                    Nästa inspektion: 
                    @if ($computer->next_inspection)
                        {{ $computer->next_inspection }} 
                    @else
                        Om det behöver
                    @endif 
                    </p>
                </div>
            </div>
        </div>

        <div class="col-md-8 mt-3">
            <div class="card">
                <div class="card-header"><i class="fas fa-fw fa-truck"></i> Services</div>
                <div class="card-body">

                <table class="table table-borderless table-sm">
                    <thead>
                        <tr>
                        <th scope="col" class="">Datum</th>
                        <th scope="col" class="text-center">Pris</th>
                        <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($services as $service)
                        <tr>
                            <td class="align-middle">{{ $service->created_at }}</td>
                            <td class="text-center align-middle">{{ $service->cost }}</td>
                            <td class="text-right align-middle">
                                <a href="{{ route('admin.service.show', $service) }}" class="btn btn-sm"><i class="fas fa-fw fa-eye"></i></a>
                                <a href="{{ route('admin.service.destroy', $service) }}" onclick="event.preventDefault(); document.getElementById('destroy-form').submit();" class="btn btn-sm"><i class="text-danger fas fa-fw fa-times"></i></a>                         
  
                            </td>
                        </tr>

                        <form id="destroy-form" action="{{ route('admin.service.destroy', $service) }}" method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                        @empty
                        <tr>
                            <td colspan=3 class="w-100 text-center">Inga services än!</td>
                        </tr>
                        @endforelse
                    </tbody>
                    </table>
                    {{ $services->links() }}
                </div>
            </div>
        </div>

    </div>
</div>
@endsection