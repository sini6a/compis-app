@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
    <div class="col-md-8">
    <a class="btn btn-primary" href="{{ route('admin.computer.show', $service->computer) }}"><i class="fas fa-fw fa-chevron-left"></i> Tillbaka</a>
    <a class="btn btn-secondary" href="{{ route('admin.index') }}"><i class="fas fa-fw fa-home"></i> Gå hem</a>
    </div>

    <div class="col-md-8 mt-3">

@if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
@endif

    <div class="card">
        <div class="card-header"><i class="fas fa-fw fa-user"></i> Admin Panel</div>

        <div class="card-body">
            <a href="{{ route('admin.part.create', $service) }}" class="btn btn-sm btn-success">Add Part</a>
            <a href="{{ route('admin.part.destroy', $service) }}" onclick="event.preventDefault(); document.getElementById('destroy-form').submit();" class="btn btn-sm btn-danger">Delete</a>
            <form id="destroy-form" action="{{ route('admin.service.destroy', $service) }}" method="POST" style="display: none;">
                @csrf
                @method('DELETE')
            </form>
        </div>
    </div>
</div>

        <div class="col-md-8 mt-3">
            <div class="card">
                <div class="card-header"><i class="fas fa-fw fa-truck"></i> Information</div>

                <div class="card-body">

                    <h3>{{ $service->created_at }} </h3>
                    <hr>

                    <p>Pris: {{ $service->cost }} </p>
                    <p>Dator: {{ $service->computer->friendly_name }} </p>
                    <p>
                    Nästa inspektion: 
                    @if ($service->computer->next_inspection)
                        {{ $service->computer->next_inspection }} 
                    @else
                        Om det behöver
                    @endif 
                    </p>
                </div>
            </div>
        </div>

        <div class="col-md-8 mt-3">
            <div class="card">
                <div class="card-header"><i class="fas fa-fw fa-plug"></i> Delar</div>
                <div class="card-body">

                <table class="table table-borderless table-sm">
                    <thead>
                        <tr>
                        <th scope="col" class="w-50">Namn</th>
                        <th scope="col" class="text-center">Pris</th>
                        <th scope="col" class="text-center">Rabatt</th>
                        <th scope="col" class="text-center">Total</th>
                        <th scope="col" class="text-center"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($parts as $part)
                        <tr>
                            <td class="align-middle">{{ $part->name }}</td>
                            <td class="text-center align-middle">{{ $part->price }}</td>
                            <td class="text-center align-middle">{{ $part->discount }}%</td>
                            <td class="text-center align-middle">{{ $part->discounted_price }}</td>
                            <td class="text-center align-middle">
                                <a href="{{ route('admin.part.destroy', $part) }}" onclick="event.preventDefault(); document.getElementById('destroy-form').submit();" class="btn btn-sm "><i class="text-danger fas fa-times"></i></a>
                            </td>                            
                        </tr>

                        <form id="destroy-form" action="{{ route('admin.part.destroy', $part) }}" method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                        @empty
                        <tr>
                            <td colspan=4 class="w-100 text-center">Inga bytta delar!</td>
                        </tr>             
                        @endforelse
                    </tbody>
                    </table>

                    {{ $parts->links() }}

                </div>
            </div>
        </div>

    </div>
</div>
@endsection