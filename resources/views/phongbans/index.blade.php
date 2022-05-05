@extends('layouts.admin')

@section('title')
    <title>Phòng Ban</title>
@endsection
@section('css')
    <link href="{{ asset('admins/phongban/phongban.css') }}" rel="stylesheet" />
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <h2>Danh sách phòng ban</h2>
                        @can('department-add')
                            <button class="btn btn-success my-3 btn_insert_phongban" data-toggle="modal"
                                data-target="#exampleModalInsert">
                                Thêm phòng ban
                            </button>
                        @endcan
                    </div>
                    <p class="text-success success-text"></p>
                    <div class="  col-md-12">
                        <table class="table table-bordered" id="departmentTable">
                            <thead class="thead-dark">
                                <tr>
                                    <th width="5%" scope="col">STT</th>
                                    <th scope="col">Mã phòng ban</th>
                                    <th scope="col">Tên phòng ban</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- Modal insert-->
            <div class="modal fade" id="exampleModalInsert" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Thêm phòng ban</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="">Mã phòng ban</label>
                                <input type="text" class="form-control ma_phong_ban" name="code" readonly value=""
                                    id="ma_phong_ban_add">
                                <span class="text-danger error-text maPhongBan_error"></span>
                            </div>
                            <div class="form-group">
                                <label for="">Tên phòng ban</label>
                                <input type="text" class="form-control" name="name" placeholder="Nhập tên phòng ban"
                                    id="ten_phong_ban_add">
                                <span class="text-danger error-text tenPhongBan_error"></span>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                                <button type="submit" class="btn btn-primary btn_add_data">Lưu lại</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal edit-->
            <div class="modal fade" id="exampleModalEdit" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Thêm phòng ban</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="">Mã phòng ban</label>
                                <input type="text" class="form-control ma_phong_ban_edit" name="code" readonly value="">
                            </div>
                            <div class="form-group">
                                <label for="">Tên phòng ban</label>
                                <input type="text" class="form-control ten_phong_ban_edit" name="name"
                                    placeholder="Nhập tên phòng ban">
                                <span class="text-danger error-text tenPhongBan_error_edit"></span>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                                <button type="submit" class="btn btn-primary btn_save_edit">Lưu lại</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@section('js')
    <script src="{{ asset('admins/phongban/phongban.js') }}"></script>
@endsection
@endsection
