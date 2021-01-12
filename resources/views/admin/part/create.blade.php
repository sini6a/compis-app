@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Part') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('admin.part.store') }}">
                        @csrf

                        <h4 class="text-center">Information</h4>
                        <hr> 
                        <div class="form-group row">
                            <label for="service_id" class="col-md-4 col-form-label text-md-right">{{ __('Service ID') }}</label>

                            <div class="col-md-6">
                                <input id="service_id" type="text" class="form-control @error('service_id') is-invalid @enderror" name="service_id" value="{{ old('service_id') ?? $service->id }}" required autocomplete="service_id" readonly>

                                @error('service_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="computer" class="col-md-4 col-form-label text-md-right">{{ __('Computer') }}</label>

                            <div class="col-md-6">
                                <input id="computer" type="text" class="form-control @error('computer') is-invalid @enderror" name="computer" value="{{ old('computer') ?? $service->computer->friendly_name }}" required autocomplete="computer" readonly>

                                @error('computer')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="customer" class="col-md-4 col-form-label text-md-right">{{ __('Customer') }}</label>

                            <div class="col-md-6">
                                <input id="customer" type="text" class="form-control @error('customer') is-invalid @enderror" name="customer" value="{{ $service->computer->user->name ?? $service->computer->user->phone_number }}" required autocomplete="customer" readonly>

                                @error('customer')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <h4 class="text-center">Part</h4>
                        <hr> 
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name">

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="price" class="col-md-4 col-form-label text-md-right">{{ __('Price') }}</label>

                            <div class="col-md-6">
                                <input id="price" type="text" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price') }}" required autocomplete="price">

                                @error('price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="discount" class="col-md-4 col-form-label text-md-right">{{ __('Discount') }}</label>

                            <div class="col-md-6">
                                <input id="discount" type="text" class="form-control @error('discount') is-invalid @enderror" name="discount" value="{{ old('discount') }}" required autocomplete="discount">

                                @error('discount')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>           
                        
                        <div class="form-group row">
                            <label for="discounted_price" class="col-md-4 col-form-label text-md-right">{{ __('Discounted Price') }}</label>

                            <div class="col-md-6">
                                <input id="discounted_price" type="text" class="form-control @error('discounted_price') is-invalid @enderror" name="discounted_price" value="{{ old('discounted_price') }}" required autocomplete="discounted_price">

                                @error('discounted_price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>                 


                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Create') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
