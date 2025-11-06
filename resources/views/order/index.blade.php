@extends('app')
@section('content')
@section('title','Master Data Order')
{{-- add=utk ngecek == vardump--}}
{{-- @add($users) --}}

<div class="d-flex justify-content-end my-2">
    <a href="{{ route('order.create') }}" class="btn btn-primary">Add order</a>
</div>
<table class="table table-bordered">
    <tr>
        <th>No.</th>
        <th>Order Number</th>
        <th>Order Amout</th>
        <th>Order Change</th>
        <th>Order Subtotal</th>
        <th>Order Status</th>
        <th>Date</th>
        <th>Actions</th>
    </tr>
    @foreach ( $datas as $i => $data )


    <tr>
        {{-- //utk nambah angka 1-10(sesuai data pada no) --}}
        <td>{{$i + 1}}</td>
        <td>{{$data ->order_name}}</td>
        <td>{{$data ->order_name}}</td>
        <td>{{$data ->order_name}}</td>
        <td>{{$data ->order_name}}</td>
        <td>{{$data ->order_name}}</td>
        <td>{{$data ->order_name}}</td>
        <td>
            <a href="{{ route('order.edit',$data->id) }}" class="btn btn-warning btn-sm">Edit</a>
            <form action="{{ route('order.destroy',$data->id) }}" method="post" onsubmit="return confirm('YAKIN MAU INGIN DELETE DEKS?')" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
@endsection
