@extends('app')
@section('content')
@section('title','Master Data User')
{{-- add=utk ngecek == vardump--}}
{{-- @add($users) --}}

<div class="d-flex justify-content-end my-2">
    <a href="{{ route('user.create') }}" class="btn btn-primary">ADD</a>
</div>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>No.</th>
            <th>Username</th>
            <th>Email</th>
            <th>Actions</th>
        </tr>

    </thead>
    @foreach ( $users as $i => $user )
    <tbody>
        <tr>
            {{-- //utk nambah angka 1-10(sesuai data pada no) --}}
            <td>{{$i + 1}}</td>
            <td>{{$user ->name}}</td>
            <td>{{$user->email}}</td>
            <td>
                <a href="{{ route('user.edit',$user->id) }}" class="btn btn-warning btn-sm">Edit</a>
                <form action="{{ route('user.destroy',$user->id) }}" method="post" onsubmit="return confirm('YAKIN MAU INGIN DELETE DEKS?')" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                </form>
            </td>
        </tr>

    </tbody>

    @endforeach
</table>
@endsection
