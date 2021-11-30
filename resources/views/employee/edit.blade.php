@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    @if (session()->has('success'))
                        <div class="alert alert-success alert-dismissible m-4">
                            {!! session('success') !!}
                        </div>
                    @endif
                    <div class="card-header">{{ __('Update Employee') }}</div>
                    <div class="card-body">
                        <form action="{{ route('admin.employee.update', $getemployee->id) }}" id="user-form" method="POST"
                            enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="form-group ">
                                <label for="title"><strong>Name</strong> <span class="text-danger">*</span></label>
                                <input type="text" name="nama" id="title"
                                    class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama', $getemployee->nama) }}"
                                    placeholder="Employee Name" />
                                @error('nama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="title"><strong>Company</strong> <span class="text-danger">*</span></label>

                                <select id="select2js" name="select_company" class="js-data-example-ajax form-conrol @error('select_company') is-invalid @enderror "
                                    style="width: 100%">
                                    <option value="{{ $getemployee->id_company }}">{{ $getemployee->company->nama }}</option>
                                </select>
                                    @error('select_company')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                            </div>
                            <input type="hidden" name="id_company" value="">

                            <div class="form-group ">
                                <label for="title"><strong>Email</strong> <span class="text-danger">*</span></label>
                                <input type="text" name="email" id="email"
                                    class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $getemployee->email) }}"
                                    placeholder="Email Company" />
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    @push('js')

        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script type="text/javascript">
            var getUrl = window.location
            var baseUrl = getUrl.protocol + '//' + getUrl.host + '/'

            $(".js-data-example-ajax").select2({
                ajax: {
                    url: baseUrl + 'admin/company/get/company',
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            q: params.term,
                            page: params.page
                        };
                    },
                    processResults: function(data, params) {
                        // console.log(data)
                        // parse the results into the format expected by Select2
                        // since we are using custom formatting functions we do not need to
                        // alter the remote JSON data, except to indicate that infinite
                        // scrolling can be used
                        params.page = params.page || 1;

                        return {
                            results: data.result,
                            pagination: {
                                more: (params.page * 30) < data.total_count
                            },
                            onSelect: function(results) {
                                $('#id_company').val(results.id)
                            }
                        };
                    },
                    cache: true
                },
            });
        </script>

    @endpush
@endsection
