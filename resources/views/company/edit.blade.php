@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                @if (session()->has('success'))
                    <div class="alert alert-success alert-dismissible m-4">
                        {!! session('success') !!}
                    </div>
                @endif
                <div class="card">
                    <div class="card-header">{{ __('Updated Company') }}</div>
                    <div class="card-body">
                        <form action="{{ route('admin.company.update', $getcompany->id) }}" id="user-form" method="POST"
                            enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="form-group ">
                                <label for="title"><strong>Company Name</strong> <span
                                        class="text-danger">*</span></label>
                                <input type="text" name="nama" id="title"
                                    class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama', $getcompany->nama) }}"
                                    placeholder="Company Name" />
                                @error('nama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group ">
                                <label for="title"><strong>Email</strong> <span class="text-danger">*</span></label>
                                <input type="text" name="email" id="email"
                                    class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $getcompany->email) }}"
                                    placeholder="Email Company" />
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="message"><strong>Logo</strong> <span class="text-danger">*</span></label>
                                <img src="{{ url("storage/{$getcompany->logo}") }}" alt="img" width="50%" class="img-thumbnail">
                                    <br>
                                    <input type="file" name="logo" id="logo"
                                        class="form-control  @error('logo') is-invalid @enderror" value="{{ old('logo', $getcompany->logo) }}">
                                    @error('logo')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                            </div>


                            <div class="form-group ">
                                <label for="title"><strong>Website</strong> <span class="text-danger">*</span></label>
                                <input type="text" name="website" id="website"
                                    class="form-control @error('website') is-invalid @enderror"
                                    value="{{ old('website', $getcompany->website) }}" placeholder="Company Name" />
                                @error('website')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

@endsection
