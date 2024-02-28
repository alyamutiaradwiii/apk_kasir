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
                    From Create
                </div>
                @include('_component.message')
                <div class="pd-30 pd-sm-40 bg-gray-100">
                    <form action="{{ route('detail.store') }}" method="POST">
                        @csrf
                    <div class="row row-xs align-items-center mg-b-20">
                        <div class="col-md-4">
                            <label class="form-label mg-b-0">Pembeli</label>
                        </div>
                        <div class="col-md-8 mg-t-5 mg-md-t-0">
                            <select name="penjualan_id" id="" class="form-control">
                                <option value="" selected disable>Pilih nama pelanggan</option>
                                @foreach ($penjualan as $dt)
                                    <option value="{{ $dt->id }}">{{ $dt->pelanggan->nama_pelanggan }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row row-xs align-items-center mg-b-20">
                        <div class="col-md-4">
                            <label class="form-label mg-b-0"> Produk</label>
                        </div>
                        <div class="col-md-8 mg-t-5 mg-md-t-0">
                            <select onkeyup="sum();" id="produk_id" name="produk_id" class="form-control select2" >
                                <option value="" disabled selected>== Pilih Produk ==</option>
                                @foreach ($produk as $dt)
                                    <option value="{{ $dt->id }}"
                                        data-harga="{{ $dt->harga }}">
                                        {{ $dt->nama_produk }} | {{ $dt->formatRupiah('harga') }}
                                    </option>
                                @endforeach
                            </select>
                    </div>
                    </div>
                    <div class="row row-xs align-items-center mg-b-20">
                        <div class="col-md-4">
                            <label class="form-label mg-b-0">Jumlah</label>
                        </div>
                        <div class="col-md-8 mg-t-5 mg-md-t-0">
                            <input class="form-control" id="jumlah_produk" placeholder="Enter your firstname" onkeyup="sum();" name="jumlah_produk" value="{{ old('jumlah_produk') }}" type="number">
                        </div>
                    </div>
                    <div class="row row-xs align-items-center mg-b-20">
                        <div class="col-md-4">
                            <label class="form-label mg-b-0">Total</label>
                        </div>
                        <div class="col-md-8 mg-t-5 mg-md-t-0">
                            <input class="form-control" id="subtotal" placeholder="Enter your firstname" onkeypress="sum();" name="subtotal" value="{{ old('subtotal') }}" type="number">
                        </div>
                    </div>
                    <button class="btn btn-primary pd-x-30 mg-e-5 mg-t-5" type="submit">Save</button>
                    <a href="{{ route('detail.index') }}" class="btn btn-dark pd-x-30 mg-t-5">Cancel</a>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    function sum() {
            var produk = document.getElementById('produk_id');
            var jumlahProduk = document.getElementById('jumlah_produk').value;

            // Mengambil opsi yang dipilih
            var selectedOption = produk.options[produk.selectedIndex];

            // Mengambil nilai data-harga dari opsi yang dipilih
            var hargaProduk = selectedOption.getAttribute('data-harga');

           var result = parseInt(hargaProduk) * parseInt(jumlahProduk);
 
           if (!isNaN(result)) {
                document.getElementById('subtotal').value=result;
           }
   }
</script>
@endsection