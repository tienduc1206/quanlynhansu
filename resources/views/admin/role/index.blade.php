@extends('layouts.admin')

@section('title')
    <title>Trang chủ</title>
@endsection
@section('css')
    {{-- <link href="{{ asset('admins/nhanvien/nhanvien.css') }}" rel="stylesheet" /> --}}
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <h2>Danh sách vai trò</h2>
                        @can('role-add')
                            <a class="btn btn-primary my-2" href="{{ route('roles.create') }}">Thêm vài trò mới</a>
                        @endcan
                    </div>
                    <div class="  col-md-12">
                        <table class="table table-bordered ">
                            <thead class="thead-dark">
                                <tr>
                                    <th width="5%" scope="col">STT</th>
                                    <th scope="col">Tên vai trò</th>
                                    <th scope="col">Mô tả vai trò</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($roles as $key => $role)
                                    <tr>
                                        <td widtd="5%" scope="col">{{ ++$key }}</td>
                                        <td scope="col">{{ $role->name }}</td>
                                        <td scope="col">{{ $role->display_name }}</td>
                                        <td scope="col">
                                            @can('role-edit')
                                                <a href="{{ route('roles.edit', ['id' => $role->id]) }}"
                                                    class="btn btn-primary mr-2"><i class="fa-regular fa-pen-to-square"></i></a>
                                            @endcan

                                            @can('role-delete')
                                                <a data-url="{{ route('roles.delete', ['id' => $role->id]) }}" href=""
                                                    class="btn btn-danger action_delete"><i class="fa-solid fa-trash-can"></i></a>
                                            @endcan
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@section('js')
    <script src="{{ asset('admins/role/delete/delete.js') }}"></script>
@endsection
@endsection
