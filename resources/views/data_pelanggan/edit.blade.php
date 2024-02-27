@extends('template.layout')
@section('content')

<div class="main-container container-fluid">
    <div class="breadcrumb-header justify-content-between">
        <div>
            <h4 class="content-title mb-2">Hi, welcome back!</h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a   href="javascript:void(0);">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Project</li>
                </ol>
            </nav>
        </div>
    </div>
    </div>

<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="main-content-label mg-b-5">
                    Left Label Alignment
                </div>
                <p class="mg-b-20">It is Very Easy to Customize and it uses in your website apllication.</p>
                <div class="pd-30 pd-sm-40 bg-gray-100">
                    <form action="{{ route('pelanggan.update',$dt->id) }}" method="POST">
                        @csrf @method('PUT')
                    <div class="row row-xs align-items-center mg-b-20">
                        <div class="col-md-4">
                            <label class="form-label mg-b-0">Nama</label>
                        </div>
                        <div class="col-md-8 mg-t-5 mg-md-t-0">
                            <input class="form-control" value="{{ $dt->nama_pelanggan }}" placeholder="Enter your firstname" name="nama_pelanggan" type="text">
                        </div>
                    </div>
                    <div class="row row-xs align-items-center mg-b-20">
                        <div class="col-md-4">
                            <label class="form-label mg-b-0">Alamat</label>
                        </div>
                        <div class="col-md-8 mg-t-5 mg-md-t-0">
                            <input class="form-control" value="{{ $dt->alamat }}" placeholder="Enter your lastname" name="alamat" type="text">
                        </div>
                    </div>
                    <div class="row row-xs align-items-center mg-b-20">
                        <div class="col-md-4">
                            <label class="form-label mg-b-0">Nomer Telpon</label>
                        </div>
                        <div class="col-md-8 mg-t-5 mg-md-t-0">
                            <input class="form-control" value="{{ $dt->nomor_telpon }}" placeholder="Enter your email" name="nomor_telpon" type="integer">
                        </div>
                    </div>
                    <button class="btn btn-primary pd-x-30 mg-e-5 mg-t-5" type="submit">Save</button>
                    <a href="{{ route('pelanggan.index') }}" class="btn btn-dark pd-x-30 mg-t-5">Cancel</a>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection