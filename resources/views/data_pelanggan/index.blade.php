@extends('template.layout')
<title>Pelanggan</title>
@section('content')

<div class="main-container container-fluid">
<div class="breadcrumb-header justify-content-between">
    <div>
        <h4 class="content-title mb-2">Hi, welcome back!</h4>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a   href="javascript:void(0);">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Pelanggan</li>
            </ol>
        </nav>
    </div>
</div>
</div>

<div class="row row-sm">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Data Pelanggan</h3>
                <div  class="d-flex my-auto btn-list justify-content-end">
                    <a href="{{ route('pelanggan.create') }}" class="btn btn-info"><i class="fa fa-plus"></i> Tambah</a>
                    <a href="{{ route('export_pdf_pelanggan') }}" class="btn btn-danger"><i class="fe fe-upload"></i> export PDF</a>
                    <a href="{{ route('export_excel_pelanggan') }}" class="btn btn-success"><i class="fa fa-plus"></i> Export Excel</a>
                    <a class="modal-effect btn btn-dark" data-bs-effect="effect-rotate-bottom" data-bs-toggle="modal" href="#modaldemo8"><i class="fe fe-download"></i> Import Excel</a>		
                </div>
            </div>
            <div class="card-body">
                @include('_component.message')
                <div class="table-responsive">
                    <table class="table border-top-0 table-bordered text-nowrap border-bottom" id="basic-datatable">
                        <thead>
                            <tr>
                                <th width="20px">No</th>
                                <th style="text-align:center">Nama Pelanggan</th>
                                <th style="text-align:center">Alamat</th>
                                <th style="text-align:center">Nomor Telpon</th>
                                <th style="text-align:center">Action</th>
                        </ul>
                        </thead>
                        <tbody>
                            @foreach ($pelanggan as $pl)  
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $pl->nama_pelanggan }}</td>
                                <td>{{ $pl->alamat }}</td>
                                <td>{{ $pl->nomor_telpon }}</td>
                                <td>
                                    <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('pelanggan.destroy', $pl->id)}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <a href="{{ route('pelanggan.edit',$pl->id) }}" title="Edit" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
                                        <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash" title="Edit"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@include('data_pelanggan.modal_import')
@endsection