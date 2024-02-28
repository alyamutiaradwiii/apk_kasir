
<table>
    <thead>
    <tr>
        <th style="font-weight:bold;text-align:center;background:#f4f4f4;border:1px solid #000000;">No</th> <!-- kolom A -->
        <th style="font-weight:bold;text-align:center;background:#f4f4f4;border:1px solid #000000;">Nama Pelanggan</th> <!-- kolom B -->
        <th style="font-weight:bold;text-align:center;background:#f4f4f4;border:1px solid #000000;">Nama Produk</th> <!-- kolom C -->
        <th style="font-weight:bold;text-align:center;background:#f4f4f4;border:1px solid #000000;">Jumlah Produk</th> <!-- kolom D -->
        <th style="font-weight:bold;text-align:center;background:#f4f4f4;border:1px solid #000000;">Jumlah Total Harga</th> <!-- kolom D -->
    </tr>
    </thead>
    <tbody>
    @php $no=1; @endphp
    @if(count($data))
    @foreach($data as $dt)
        <tr>
            <td>{{$no++}}</td>
            <td>{{$dt->penjualan->pelanggan->nama_pelanggan??''}}</td>
            <td>{{$dt->produk->nama_produk??''}}</td>
            <td>{{$dt->jumlah_produk??''}}</td>
            <td>{{$dt->formatRupiah('subtotal')??''}}</td>
        </tr>
    @endforeach
    @endif
    </tbody>
</table>