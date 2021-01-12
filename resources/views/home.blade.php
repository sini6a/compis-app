@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

            <div class="card">
                <div class="card-header"><i class="fas fa-fw fa-user"></i> Profil</div>

                <div class="card-body">
                    @if (Auth::user()->name)
                        <h3> {{ Auth::user()->name }} </h3>
                    @else
                        <h3> {{ Auth::user()->phone_number }} </h3>
                    @endif
            
                    <hr>

                    @if (Auth::user()->name) 
                        <p>Telefonnummer: {{ Auth::user()->phone_number }} </p>
                    @endif

                    @if (Auth::user()->email) 
                        <p>E-Post: {{ Auth::user()->email }} </p>
                    @endif

                    <p>Rabatt: {{Auth::user()->discount}}% </p>

                    @if (Auth::user()->address->address && Auth::user()->address->postal_code)
                        <hr>
                        <p>{{ Auth::user()->address->address }}</p>
                        @if (Auth::user()->address->address_two)
                        <p>{{ Auth::user()->address->address_two }}</p>
                        @endif
                        <p>{{ Auth::user()->address->city }}, {{ Auth::user()->address->postal_code }}</p>
                        <p>{{ Auth::user()->address->state }}</p>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-md-8 mt-3">
            <div class="card">
                <div class="card-header"><i class="fas fa-fw fa-list-ul"></i> Abonnemang</div>
                <div class="card-body">

                    <h3> {{ Auth::user()->subscription->name }} </h3>
                    
                    <hr>

                    <ul class="list-unstyled">

                    @if (Auth::user()->subscription->diagnosis)
                    <li><i class="fas fa-check text-success fa-fw"></i> You get ordinary diagnosis and maintenance. 
                    @if (Auth::user()->subscription->diagnosis_interval == 1)
                    (Every month)
                    @elseif (Auth::user()->subscription->diagnosis_interval == 3)
                    (Every 3rd month)
                    @endif
                    </li>
                    @else
                    <li><i class="fas fa-times fa-fw text-danger"></i> You <b>DO NOT</b> get ordinary diagnosis.</li>
                    @endif

                    @if (Auth::user()->subscription->parts)
                    <li><i class="fas fa-check text-success fa-fw"></i> You get free service.</li>
                    @else
                    <li><i class="fas fa-times fa-fw text-danger"></i> You <b>DO NOT</b> get free service on your computers.</li>
                    @endif

                    @if (Auth::user()->subscription->upgrades)
                    <li><i class="fas fa-check text-success fa-fw"></i> You get free upgrades.</li>
                    @else
                    <li><i class="fas fa-times fa-fw text-danger"></i> You <b>DO NOT</b> get free upgrades.</li>
                    @endif

                    @if (Auth::user()->subscription->support)
                    <li><i class="fas fa-check text-success fa-fw"></i> You get free tech support.</li>
                    @else
                    <li><i class="fas fa-times fa-fw text-danger"></i> You <b>DO NOT</b> get free tech support.</li>
                    @endif

                    @if (Auth::user()->subscription->computers)
                    <li><i class="fas fa-check text-success fa-fw"></i> You get free computers.</li>
                    @else
                    <li><i class="fas fa-times fa-fw text-danger"></i> You <b>DO NOT</b> get free computers.</li>
                    @endif

                    <li>Månadskonstnad: <b>{{ Auth::user()->subscription->price }} SEK.</b></li>
                    </ul>
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
                            <td class="text-right align-middle"><a href="{{ route('computer.show', $computer->id) }}" class="btn btn-sm"><i class="fas fa-fw fa-eye"></i></a></td>
                        </tr>
                        @empty
                        <tr>
                            <th scope="row" class="w-100 text-center">Inga dator än!</th>
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
