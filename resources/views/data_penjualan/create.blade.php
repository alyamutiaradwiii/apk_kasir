@extends('template.layout')
@section('content')

<div class="main-container container-fluid">
    <div class="breadcrumb-header justify-content-between">
        <div>
            <h4 class="content-title mb-2">Hi, welcome back!</h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a   href="javascript:void(0);">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Penjualan Form Create</li>
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
                    Form Create Penjualan
                </div>
                @include('_component.message')
                <div class="pd-30 pd-sm-40 bg-gray-100">
                    <form action="{{ route('penjualan.store') }}" method="POST">
                        @csrf
                    <div class="row row-xs align-items-center mg-b-20">
                        <div class="col-md-4">
                            <label class="form-label mg-b-0">Tanggal penjualan</label>
                        </div>
                        <div class="col-md-8 mg-t-5 mg-md-t-0">
                            <input class="form-control" placeholder="Enter your firstname" name="tanggal_penjualan" type="date" value="{{ old('tanggal_penjualan') }}">
                        </div>
                    </div>
                    <div class="row row-xs align-items-center mg-b-20">
                        <div class="col-md-4">
                            <label class="form-label mg-b-0"> Total Harga</label>
                        </div>
                        <div class="col-md-8 mg-t-5 mg-md-t-0">
                            <input class="form-control" placeholder="Enter your lastname" name="Total_harga" value="{{ old('Total_harga') }}" type="number">
                        </div>
                    </div>
                    <div class="row row-xs align-items-center mg-b-20">
                        <div class="col-md-4">
                            <label class="form-label mg-b-0">nama pelanggan</label>
                        </div>
                        <div class="col-md-8 mg-t-5 mg-md-t-0">
                            <select name="pelanggan_id" id="" class="form-control">
                                <option value="" selected disable>Pilih nama pelanggan</option>
                                @foreach ($pelanggan as $dt)
                                    <option value="{{ $dt->id }}">{{ $dt->nama_pelanggan }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <button class="btn btn-primary pd-x-30 mg-e-5 mg-t-5" type="submit">Save</button>
                    <a href="{{ route('penjualan.index') }}" class="btn btn-dark pd-x-30 mg-t-5">Cancel</a>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- <script>
    function sum(){
        var txtFirstNumberValue = document.getElementById('judul').value;
        var txtSecondNumberValue = document.getElementById('judul').value;
        var result = parseInt(txtFirstNumberValue) + parseInt(txtSecondNumberValue);
        if(!isNaN(result)) {
            document.getElementById('hasil').valueresult;
        }
        
    }
</script> --}}

@endsection