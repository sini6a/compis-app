@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
    <div class="col-md-8">
    <a class="btn btn-primary" href=""><i class="fas fa-fw fa-chevron-left"></i> Tillbaka</a>
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
            </div>
        </div>

    </div>

        <div class="col-md-8 mt-3">
            <div class="card">
                <div class="card-header"><i class="fas fa-fw fa-truck"></i> Confirm deletion</div>

                <div class="card-body">

                    <h3>Confirm delete: </h3>
                    <hr>

                    <p>
                    Are you sure that you want to delete following:
                    </p>
                </div>
            </div>
        </div>


    </div>
</div>
@endsection