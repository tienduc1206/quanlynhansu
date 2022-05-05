@extends('layouts.admin')

@section('title')
    <title>Trang chủ</title>
@endsection
@section('css')
    <link rel="stylesheet" href="{{ asset('admins/role/add/add.css') }}">
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <form action="{{ route('roles.update', ['id' => $role->id]) }}" method="post" style="width:100%">
                        @csrf
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Tên vai trò</label>
                                <input type="text" name="name" id="" class="form-control" placeholder="Nhập tên vai trò"
                                    value="{{ $role->name }}">
                            </div>
                            <div class="form-group">
                                <label for="">Mô tả vai trò</label>
                                <textarea name="display_name" class="form-control" rows="5">{{ $role->display_name }}</textarea>
                            </div>


                        </div>
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="">
                                        <input type="checkbox" class="checkAll">
                                        Chọn tất cả
                                    </label>

                                </div>
                                @foreach ($permissionsParent as $item)
                                    <div class="card border-primary mb-3 col-md-12">
                                        <div class="card-header">
                                            <label>
                                                <input type="checkbox" name="" id="" class="checkbox_wrapper">
                                            </label>
                                            Module {{ $item->display_name }}
                                        </div>
                                        <div class="row">
                                            @foreach ($item->permissionsChildrent as $item)
                                                <div class="card-body text-primary col-md-3">
                                                    <h5 class="card-title">
                                                        <label>
                                                            <input type="checkbox" name="perrmission_id[]"
                                                                {{ $permissionsChecked->contains('id', $item->id) ? 'checked' : '' }}
                                                                value="{{ $item->id }}" class="checkbox_childrent">
                                                        </label>
                                                        {{ $item->display_name }}
                                                    </h5>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                        <button type="submit" class="btn btn-success">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@section('js')
    <script src="{{ asset('admins/role/add/add.js') }}"></script>
@endsection
@endsection
