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
                        <h3>Danh sách tài khoản</h3>
                        @can('user-add')
                            <a class="btn btn-primary my-2" href="{{ route('users.create') }}">Thêm tài khoản mới
                            </a>
                        @endcan
                    </div>
                    <div class="  col-md-12">
                        <table id="example" class="table table-bordered" style="width:100%">
                            <thead class="thead-dark">
                                <tr>
                                    <th width="5%" scope="col">STT</th>
                                    <th scope="col">Tên</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Vai trò</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $key => $user)
                                    <tr>
                                        <td widtd="5%" scope="col">{{ ++$key }}</td>
                                        <td scope="col">{{ $user->name }}</td>
                                        <td scope="col">{{ $user->email }}</td>
                                        <td scope="col">
                                            @foreach ($user->roles as $role)
                                                {{ $role->display_name }}
                                            @endforeach
                                        </td>
                                        <td scope="col">
                                            @can('user-edit')
                                                <a href="{{ route('users.edit', ['id' => $user->id]) }}"
                                                    class="btn btn-primary mr-2"><i class="fa-regular fa-pen-to-square"></i></a>
                                            @endcan
                                            @can('user-delete')
                                                <a data-url="{{ route('users.delete', ['id' => $user->id]) }}" href=""
                                                    class="btn btn-danger action_delete"><i
                                                        class="fa-solid fa-trash-can"></i></a>
                                            @endcan
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{-- <table class="table table-bordered ">
                            <thead class="thead-dark">
                                <tr>
                                    <th width="5%" scope="col">STT</th>
                                    <th scope="col">Tên</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Vai trò</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $key => $user)
                                    <tr>
                                        <td widtd="5%" scope="col">{{ ++$key }}</td>
                                        <td scope="col">{{ $user->name }}</td>
                                        <td scope="col">{{ $user->email }}</td>
                                        <td scope="col">
                                            @foreach ($user->roles as $role)
                                                {{ $role->display_name }}
                                            @endforeach
                                        </td>
                                        <td scope="col">
                                            @can('user-edit')
                                                <a href="{{ route('users.edit', ['id' => $user->id]) }}"
                                                    class="btn btn-primary mr-2"><i class="fa-regular fa-pen-to-square"></i></a>
                                            @endcan
                                            @can('user-delete')
                                                <a data-url="{{ route('users.delete', ['id' => $user->id]) }}" href=""
                                                    class="btn btn-danger action_delete"><i
                                                        class="fa-solid fa-trash-can"></i></a>
                                            @endcan
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table> --}}
                    </div>
                    {{-- <div class="col-md-12">
                        {!! $users->links() !!}
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
@section('js')
    <script src="{{ asset('admins/user/user.js') }}"></script>
@endsection
@endsection
