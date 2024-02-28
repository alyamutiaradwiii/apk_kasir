<!DOCTYPE html>
<html>
<head>
	<title>Laporan Data Produk</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
	<style type="text/css">
		table tr td,
		table tr th{
			font-size: 9pt;
		}
		table tr th{
			font-weight:bold;
			text-align:center;
			background:#f4f4f4;
		}
	</style>
	<center>
		<h4>DATA PRODUK</h4>
		<p>Waktu Export : {{date('d-m-Y H:i')}}</p>
	</center>
 
	<table class='table table-bordered'>
		<thead>
		<tr>
            <th width="20px">No</th>
            <th style="text-align:center">Nama Produk</th>
            <th style="text-align:center">Harga</th>
            <th style="text-align:center">Stok</th>
		</tr>
		</thead>
		<tbody>
		@php $no=1; @endphp
		@if(count($produk))
		@foreach($produk as $item)
			<tr>
                <td style="text-align:center">{{ $loop->iteration }}</td>
                <td style="text-align:center">{{ $item->nama_produk }}</td>
                <td style="text-align:center">{{ $item->formatRupiah('harga')}}</td>
                <td style="text-align:center">{{ $item->stok }}</td>
			</tr>
		@endforeach
		@endif
		</tbody>
	</table>
 
</body>
</html>