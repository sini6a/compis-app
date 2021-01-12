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
                <div class="card-header"><i class="fas fa-fw fa-user"></i> Admin Panel</div>
                <div class="card-body">
                <a href="{{ route('admin.user.create') }}" class="btn btn-success btn-sm">Add new customer</a>

                </div>
            </div>
        </div>

        <div class="col-md-8 mt-3">
            <div class="card">
                <div class="card-header"><i class="fas fa-fw fa-truck"></i> Inspections</div>
                <div class="card-body">

                <table class="table table-borderless table-sm">
                    <thead>
                        <tr>
                        <th scope="col" class="">Telefonnummer</th>
                        <th scope="col" class="text-center">Name</th>
                        <th scope="col" class="text-center">Computer</th>
                        <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($computers_for_inspection as $computer)
                        <tr>
                            <td class="align-middle">{{ $computer->user->phone_number }}</td>
                            <td class="text-center align-middle">{{ $computer->user->name ? $computer->user->name : '/' }}</td>
                            <td class="text-center align-middle">{{ $computer->friendly_name }}</td>
                            <td class="text-right align-middle"><a href="{{ route('admin.computer.show', $computer) }}" class="btn btn-sm"><i class="fas fa-fw fa-eye"></i></a></td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan=3 class="w-100 text-center">No inspections!</td>
                        </tr>
                        @endforelse
                    </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-8 mt-3">
            <div class="card">
                <div class="card-header"><i class="fas fa-fw fa-truck"></i> Users</div>
                <div class="card-body">

                <table class="table table-borderless table-sm">
                    <thead>
                        <tr>
                        <th scope="col" class="">Telefonnummer</th>
                        <th scope="col" class="text-center">No. of computers</th>
                        <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                        <tr>
                            <td class="align-middle">{{ $user->phone_number }}</td>
                            <td class="text-center align-middle">{{ $user->computers->count() }}</td>
                            <td class="text-right align-middle"><a href="{{ route('admin.user.show', $user) }}" class="btn btn-sm"><i class="fas fa-fw fa-eye"></i></a></td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan=3 class="w-100 text-center">No users!</td>
                        </tr>
                        @endforelse
                    </tbody>
                    </table>
                </div>
            </div>
        </div>


    </div>
</div>
@endsection
