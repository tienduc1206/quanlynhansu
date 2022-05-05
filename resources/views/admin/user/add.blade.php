@extends('layouts.admin')

@section('title')
    <title>Trang chủ</title>
@endsection
@section('css')
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="  col-md-6">
                        <form action="{{ route('users.store') }}" method="post">
                            @csrf
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <div class="form-group">
                                <label for="">Tên</label>
                                <input type="text" name="name" id="" class="form-control" placeholder="Nhập tên"
                                    value="{{ old('name') }}">
                            </div>
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="Email" name="email" id="" class="form-control" placeholder="Nhập email"
                                    value="{{ old('email') }}">
                            </div>
                            <div class="form-group">
                                <label for="">Password</label>
                                <input type="password" name="password" id="" class="form-control"
                                    placeholder="Nhập email">
                            </div>
                            <div class="form-group">
                                <label for="">Chọn vai trò</label>
                                <select name="role_id" class="form-control">
                                    <option value="0">Chọn vai trò</option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-success">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@section('js')
@endsection
@endsection
