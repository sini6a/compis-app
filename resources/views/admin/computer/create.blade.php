@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Computer') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('admin.computer.store') }}">
                        @csrf

                        <h4 class="text-center">Information</h4>
                        <hr> 

                        <div class="form-group row">
                            <label for="user_id" class="col-md-4 col-form-label text-md-right">{{ __('Customer ID') }}</label>

                            <div class="col-md-6">
                                <input id="user_id" type="text" class="form-control @error('user_id') is-invalid @enderror" name="user_id" value="{{ $user->id }}" required autocomplete="user_id" readonly>

                                @error('user_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="user" class="col-md-4 col-form-label text-md-right">{{ __('Customer') }}</label>

                            <div class="col-md-6">
                                <input id="user" type="text" class="form-control @error('user') is-invalid @enderror" name="user" value="{{ $user->name ?? $user->phone_number }}" required autocomplete="user" readonly>

                                @error('user')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <h4 class="text-center">Computer</h4>
                        <hr> 
                        <div class="form-group row">
                            <label for="friendly_name" class="col-md-4 col-form-label text-md-right">{{ __('Friendly name') }}</label>

                            <div class="col-md-6">
                                <input id="friendly_name" type="text" class="form-control @error('friendly_name') is-invalid @enderror" name="friendly_name" value="{{ old('friendly_name') }}" required autocomplete="friendly_name">

                                @error('friendly_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="processor" class="col-md-4 col-form-label text-md-right">{{ __('Processor') }}</label>

                            <div class="col-md-6">
                                <input id="processor" type="text" class="form-control @error('processor') is-invalid @enderror" name="processor" value="{{ old('processor') }}" required autocomplete="processor">

                                @error('processor')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="graphics" class="col-md-4 col-form-label text-md-right">{{ __('Graphics') }}</label>

                            <div class="col-md-6">
                                <input id="graphics" type="text" class="form-control @error('graphics') is-invalid @enderror" name="graphics" value="{{ old('graphics') }}" required autocomplete="graphics">

                                @error('graphics')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="ram" class="col-md-4 col-form-label text-md-right">{{ __('RAM') }}</label>

                            <div class="col-md-6">
                                <input id="ram" type="number" class="form-control @error('ram') is-invalid @enderror" name="ram" value="{{ old('ram') }}" required autocomplete="ram">

                                @error('ram')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="storage" class="col-md-4 col-form-label text-md-right">{{ __('Storage') }}</label>

                            <div class="col-md-6">
                                <input id="storage" type="number" class="form-control @error('storage') is-invalid @enderror" name="storage" value="{{ old('storage') }}" required autocomplete="storage">

                                @error('storage')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="os" class="col-md-4 col-form-label text-md-right">{{ __('Operating System') }}</label>

                            <div class="col-md-6">

                                <select class="form-control @error('os') is-invalid @enderror" name="os" required>
                                    @foreach($os as $key => $value)
                                    <option value="{{ $key }}" {{ ($key == old('os')) ? 'selected' : '' }} >{{ $value }}</option>
                                    @endforeach
                                </select>

                                @error('os')
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
