@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

    <div class="col-md-8">
    <a class="btn btn-primary" href="{{ route('admin.index') }}"><i class="fas fa-fw fa-chevron-left"></i> Gå hem</a>
    </div>

    <div class="col-md-8 mt-3">

        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger" role="alert">
                {{ session('error') }}
            </div>
        @endif

        <div class="card">
            <div class="card-header"><i class="fas fa-fw fa-user"></i> Admin Panel</div>

            <div class="card-body">
                <a href="{{ route('admin.computer.create', $user) }}" class="btn btn-sm btn-success">Add Computer</a>
                <a href="{{ route('admin.user.discount', [$user, 5]) }}" 
                    onclick="event.preventDefault();
                    document.getElementById('add-five-form').submit();"class="btn btn-sm btn-success">5%</a>
                <a href="{{ route('admin.user.discount', [$user, 20]) }}" 
                    onclick="event.preventDefault();
                    document.getElementById('add-twenty-form').submit();" class="btn btn-sm btn-success">20%</a>
                <a href="{{ route('admin.user.edit', $user) }}" class="btn btn-sm btn-primary">Edit Details</a>
            </div>
        </div>
    </div>

    <form id="add-five-form" action="{{ route('admin.user.discount', [$user, 5]) }}" method="POST" style="display: none;">
        @csrf
        @method('PATCH')
    </form>

    <form id="add-twenty-form" action="{{ route('admin.user.discount', [$user, 20]) }}" method="POST" style="display: none;">
        @csrf
        @method('PATCH')
    </form>

        <div class="col-md-8 mt-3">

            <div class="card">
                <div class="card-header"><i class="fas fa-fw fa-user"></i> Customer Details</div>

                <div class="card-body">
                    @if ($user->name)
                        <h3> {{ $user->name }} </h3>
                    @else
                        <h3> {{ $user->phone_number }} </h3>
                    @endif
            
                    <hr>

                    @if ($user->name) 
                        <p>Telefonnummer: {{ $user->phone_number }} </p>
                    @endif

                    @if ($user->email) 
                        <p>E-Post: {{ $user->email }} </p>
                    @endif

                    <p>Rabatt: {{$user->discount}}% </p>


                    @if ($user->address->address && $user->address->postal_code)
                        <hr>
                        <p>{{ $user->address->address }}</p>
                        @if ($user->address->address_two)
                        <p>{{ $user->address->address_two }}</p>
                        @endif
                        <p>{{ $user->address->city }}, {{ $user->address->postal_code }}</p>
                        <p>{{ $user->address->state }}</p>
                    @endif

                </div>
            </div>
        </div>

        <div class="col-md-8 mt-3">
            <div class="card">
                <div class="card-header"><i class="fas fa-fw fa-desktop"></i> Dator</div>
                <div class="card-body">

                    <table class="table table-borderless table-sm ">
                    <tbody>
                        @forelse ($computers as $computer)
                        <tr>
                            <td scope="row" class="align-middle {{ $computer->inspection ? 'text-danger' : '' }}">{{ $computer->friendly_name }}</td>
                            <td scope="row" class="text-center align-middle {{ $computer->inspection ? 'text-danger' : '' }}">{{ $computer->services->count() }}</td>
                            <td class="text-right align-middle"><a href="{{ route('admin.computer.show', $computer->id) }}" class="btn btn-sm"><i class="fas fa-fw fa-eye"></i></a></td>
                        </tr>
                        @empty
                        <tr>
                            <td scope="row" class="w-100 text-center">Inga dator än!</td>
                        </tr>
                        @endforelse
                    </tbody>
                    </table>

                    {{ $computers->links() }}

                </div>
            </div>
        </div>

    </div>
</div>
@endsection
