@extends('layouts.app')

@section('content')

    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible m-4">
            {!! session('success') !!}
        </div>
    @endif
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <a href="{{ route('admin.employee.create') }}" class="btn mt-1 mb-4 min-w-auto btn-success">
                    <i class="fas fa-plus"></i> Add Employee
                </a>
                {{-- <a href="#" class="btn mt-1 mb-4 min-w-auto btn-success">
                    <i class="fas fa-plus"></i> Import Excel
                </a> --}}
                <div class="card">
                    <div class="card-header">{{ __('List Employee') }}</div>

                    <div class="card-body">

                        <div class="d-flex justify-content-center my-4">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Employee Name</th>
                                        <th scope="col">Company</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($employee as $index => $item)
                                        
                                    <tr>
                                        <th scope="row">{{ $rank++ }}</th>
                                        <td>{{ $item->nama }}</td>
                                        <td>{{ $item->company->nama }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>
                                            <div style="display: inline-flex" class="mr-2">
                                            <a href="{{ route('admin.employee.edit', $item->id) }}" title="Ubah" class="btn btn-sm btn-primary pull-right mr-1 edit">
                                           Edit
                                        </a>
                                        <button type="button" class="btn btn-sm btn-danger pull-right delete" title="Hapus" data-toggle="modal" data-target="#deleteMenu-{{ $index }}" data-id="2">
                                         Delete
                                        </button> </div>
                                        <div class="modal fade scale" id="deleteMenu-{{ $index }}" tabindex="-1" role="dialog" aria-labelledby="deleteMenuTitle" aria-hidden="true">
                                            <div class="modal-dialog">
                                              <div class="modal-content">
                                                    <div class="modal-header">
                                                    <h5 class="modal-title">Hapus Employee </h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="modal-body">    
                                                        <form id="role-menu-form-delete" action="{{ route('admin.employee.destroy', $item->id) }}" spellcheck="false"  method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <div class="mb-4 pb-2">Apa Anda yakin ingin menghapus data ini ?</div>
                                                            <div id="role-menu-form-delete-errors"></div>
                                                            <button type="submit" class="btn btn-danger mb-2">Hapus</button>
                                                        </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    
                                        </td>
                                    </tr>
                                    
                                    @endforeach
                                </tbody>
                            </table>
                          
                        </div>
                        <div class="d-flex justify-content-center my-4">
                            {{  $employee->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
