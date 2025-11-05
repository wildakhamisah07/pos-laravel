@extends('app')
@section('content')
@if (session('error'))
<div style="color: red">{{session('error')}}</div>
@endif
@if ($errors->any())
<div style="color: red">
    <ul>
        @foreach ($errors->all() as $er )
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong>Alert!</strong>{{$er}}
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
        @endforeach
    </ul>
</div>
@endif

<form action="{{ route('product.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-sm-6">
            <div class="mb-3">
                <label for="" class="form-label">Category Name</label>
                <select name="category_id" id="" class="form-control">
                    <option value="">--Select One--</option>
                    @foreach ($categories as $category )
                    <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                    @endforeach
                </select>
            </div>
            {{-- kiri --}}
            <div class="mb-3">
                <label for="" class="form-label">Price</label>
                <input type="number" placeholder="Enter Product Price" class="form-control" name="product_price">
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Status</label>
                <br>
                <input type="radio" id="is_active_1" name="is_active" value="1">Publish
                <input type="radio" id="is_active_2" name="is_active" value="0">Draft
            </div>
        </div>
        {{-- kanan --}}
        <div class="col-sm-6">
            <div class="mb-3">
                <label for="" class="form-label">Name</label>
                <input type="text" placeholder="Enter Product Name" class="form-control" name="product_name">
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Description</label>
                <textarea name="product_description" id="" class="form-control" ></textarea>
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Photo</label>
                <br>
                <input type="file" name="product_photo" class="form-control"  >
            </div>
        </div>

    </div>
    <button type="submit" class="btn btn-primary mt-2">Save</button>
</form>
@endsection
