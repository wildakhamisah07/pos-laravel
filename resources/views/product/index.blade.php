@extends('app')
@section('content')
@section('title','Master Data Product')
{{-- add=utk ngecek == vardump--}}
{{-- @add($users) --}}

<div class="d-flex justify-content-end my-2">
    <a href="{{ route('product.create') }}" class="btn btn-primary">Add product</a>
</div>
<table class="table table-bordered">
    <tr>
        <th>No.</th>
        <th>Category</th>
        <th>Photo</th>
        <th>Name</th>
        <th>Price</th>
        <th>Status</th>
        <th>Actions</th>
    </tr>
    @foreach ( $datas as $i => $data )


    <tr>
        {{-- //utk nambah angka 1-10(sesuai data pada no) --}}
        <td>{{$i + 1}}</td>
        <td>{{$data ->category->category_name}}</td>
        <td><img width="100" src="{{ asset('storage/'. $data->product_photo) }}" alt="{{ $data->product_name }}"></td>
        <td>{{$data ->product_name}}</td>
        <td>{{$data ->product_price}}</td>
        <td>
            <span class="{{ $data->is_active_class }}">{{$data->is_active_text}}</span>
        </td>
        <td>
            <a href="{{ route('product.edit',$data->id) }}" class="btn btn-warning btn-sm">Edit</a>
            <form action="{{ route('product.destroy',$data->id) }}" method="post" onsubmit="return confirm('YAKIN MAU INGIN DELETE DEKS?')" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
@endsection
