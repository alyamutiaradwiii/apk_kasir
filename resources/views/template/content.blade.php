@extends('template.layout')

@section('content')
        @if(isset($konten))
    
                {{ view($konten) }}
        
        @else
    
                {{'File Konten Tidak Ada'}}
    
        @endif
@endsection
