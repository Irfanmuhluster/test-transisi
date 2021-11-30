@extends('layouts.app')

@section('content')

    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible m-4">
            {!! session('success') !!}
        </div>
    @endif
    @if (session()->has('error'))
        <div class="alert alert-danger alert-dismissible m-4">
            {!! session('error') !!}
        </div>
    @endif
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                {{-- <a href="{{ route('admin.company.create') }}" class="btn mt-1 mb-4 min-w-auto btn-success">
                    <i class="fas fa-plus"></i> Tambah Company
                </a> --}}
                <button type="button" class="btn btn-success my-4" data-toggle="modal" data-target="#import">
                    IMPORT
                </button>
                <div class="card">
                    <div class="card-header">List Employee from {{ $company->nama }}</div>
                   
                    <!-- modal -->
                    <div class="modal fade" id="import" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">IMPORT DATA</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{ route('admin.company.importpdf') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label>PILIH FILE</label>
                                            <input type="file" name="file" class="form-control" required>
                                            <input type="hidden" name="id_company" value="{{ $company->id }}">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">TUTUP</button>
                                        <button type="submit" class="btn btn-success">IMPORT</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Email</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($employee as $index => $item)

                                    <tr>
                                        <th scope="row">{{ $rank++ }}</th>
                                        <td>{{ $item->nama }}</td>
                                        <td>{{ $item->email }}</td>

                                    </tr>

                                @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-end my-4">
                            <a href="{{ route('admin.company.printpdf', $company->id) }}" class="btn btn-success">Export
                                PDF</a>
                        </div>
                        <div class="d-flex justify-content-center my-4">
                            {{ $employee->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
