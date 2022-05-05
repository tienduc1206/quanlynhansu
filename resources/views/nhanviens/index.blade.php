@extends('layouts.admin')

@section('title')
    <title>Trang chủ</title>
@endsection
@section('css')
    <link href="{{ asset('admins/nhanvien/nhanvien.css') }}" rel="stylesheet" />
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <h2>Danh sách nhân viên</h2>
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6">
                                @can('employee-add')
                                    <button class="btn btn-success my-3 btn_insert_employee" data-toggle="modal"
                                        data-target="#exampleModalInsert">
                                        Thêm nhân viên mới
                                    </button>
                                @endcan
                                    <input class="form-control mr-sm-2 search-employee" type="search" placeholder="Tìm kiếm"
                                        name="search">
                               
                            </div>
                            <div class="col-md-8 align-items-center">

                            </div>
                        </div>
                    </div>

                    <div class="  col-md-12">
                        <table class="table table-bordered " id="employeeTable">
                            <thead class="thead-dark">
                                <tr>
                                    <th width="5%" scope="col">STT</th>
                                    <th scope="col">Mã nhân viên</th>
                                    <th scope="col">Tên nhân viên</th>
                                    <th scope="col">Giới tính</th>
                                    <th scope="col">Ngày sinh</th>
                                    <th scope="col">Nơi sinh</th>
                                    <th scope="col">Bằng cấp</th>
                                    <th scope="col">Phòng ban</th>
                                    <th scope="col">Ảnh</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- @foreach ($employees as $key => $employee)
                                    <tr>
                                        <td>{{ ++$key }}</td>
                                        <td>{{ $employee->ten_nv }}</td>
                                        <td>{{ $employee->ma_nv }}</td>
                                        <td>{{ $employee->gioi_tinh == 0 ? 'Nam' : 'Nữ' }}</td>
                                        <td>{{ $employee->ngay_sinh }}</td>
                                        <td>{{ $employee->noi_sinh }}</td>
                                        <td>{{ $employee->phongBan->ten_phong_ban }}</td>
                                        <td>{{ $employee->degree->degree_name }}</td>
                                        <td><img class="image_nhanvien" src="{{ $employee->image_path }}" alt=""></td>
                                    </tr>
                                @endforeach --}}
                                <img src="" alt="">
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12">
                        {{-- @php
                            $maxPage = ceil($totalNhanVien / $perPage);
                        @endphp --}}
                        <nav aria-label="Page navigation example">
                            <ul class="pagination justify-content-end">
                                {{-- <li class="page-prev page-item">
                                    <a class="page-link" href="#" tabindex="-1">Previous</a>
                                </li>
                                @for ($index = 1; $index <= $maxPage; $index++)
                                    <li class="page-item {{ $index == $maxPage ? 'last-page' : '' }}"
                                        value="{{ $index }}"><a class="page-link"
                                            href="">{{ $index }}</a>
                                    </li>
                                @endfor
                                <li class="page-next page-item">
                                    <a class="page-link" href="">Next</a>
                                </li> --}}
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
            <!-- Modal insert-->
            <div class="modal fade" id="exampleModalInsert" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Thông tin nhân viên</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form method="POST" enctype="multipart/form-data" id="formInsert">
                            @csrf
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="">Tên nhân viên</label>
                                    <input type="text" class="form-control" name="employeeName"
                                        placeholder="Nhập tên nhân viên">
                                    <span class="text-danger error-text employeeName_error"></span>
                                </div>
                                <div class="form-group">
                                    <label for="">Mã nhân viên</label>
                                    <input type="text" class="form-control" name="employeeCode" placeholder="Mã nhân viên"
                                        readonly>
                                </div>
                                <div class="form-group">
                                    <label for="">Giới tính</label>
                                    <select class="form-control" id="" name="gender">
                                        <option>Chọn giới tính</option>
                                        <option value="0">Nam</option>
                                        <option value="1">Nữ</option>
                                    </select>
                                    <span class="text-danger error-text gender_error"></span>
                                </div>
                                <div class="form-group">
                                    <label for="">Nơi sinh</label>
                                    <input type="text" class="form-control" name="address" placeholder="Nơi sinh">
                                    <span class="text-danger error-text address_error"></span>
                                </div>
                                <div class="form-group">
                                    <label for="">Ngày sinh</label>
                                    <input type="date" class="form-control" name="birthday">
                                    <span class="text-danger error-text birthday_error"></span>
                                </div>
                                <div class="form-group">
                                    <label for="">Phòng ban</label>
                                    <select class="form-control" id="" name="phongban_id">
                                        <option>Chọn phòng ban</option>
                                        @foreach ($listPhongBan as $item)
                                            <option value="{{ $item->id }}">{{ $item->ten_phong_ban }}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger error-text phongban_error"></span>
                                </div>
                                <div class="form-group">
                                    <label for="">Bằng cấp</label>
                                    <select class="form-control" id="" name="bangcap_id">
                                        <option>Chọn bằng cấp</option>
                                        @foreach ($listDegree as $item)
                                            <option value="{{ $item->id }}">{{ $item->degree_name }}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger error-text bangcap_error"></span>
                                </div>
                                <div class="form-group">
                                    <label for="">Ảnh 4x6</label>
                                    <input type="file" class="form-control-file" name="imageEmployee"
                                        placeholder="Chọn file">
                                </div>
                                <span class="text-danger error-text imageEmployee_error"></span>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                                <button type="submit" class="btn btn-primary btn_save_data">Lưu lại</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Modal edit-->
            <div class="modal fade" id="exampleModalEdit" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Thông tin nhân viên</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="" enctype="multipart/form-data" id="formEdit">
                            @csrf
                            <div class="modal-body">
                                <div class="form-group">
                                    <input type="hidden" class="idUpdate">
                                </div>
                                <div class="form-group">
                                    <label for="">Tên nhân viên</label>
                                    <input type="text" class="form-control" name="employeeNameEdit"
                                        placeholder="Nhập tên nhân viên">
                                </div>
                                <div class="form-group">
                                    <label for="">Mã nhân viên</label>
                                    <input type="text" class="form-control" name="employeeCodeEdit"
                                        placeholder="Mã nhân viên" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="">Giới tính</label>
                                    <select class="form-control" id="" name="genderEdit">
                                        <option>Chọn giới tính</option>
                                        <option value="0">Nam</option>
                                        <option value="1">Nữ</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Nơi sinh</label>
                                    <input type="text" class="form-control" name="addressEdit" placeholder="Nơi sinh">
                                </div>
                                <div class="form-group">
                                    <label for="">Ngày sinh</label>
                                    <input type="date" class="form-control" name="birthdayEdit">
                                </div>
                                <div class="form-group">
                                    <label for="">Phòng ban</label>
                                    <select class="form-control" id="" name="phongban_idEdit">
                                        <option>Chọn phòng ban</option>
                                        @foreach ($listPhongBan as $item)
                                            <option value="{{ $item->id }}">{{ $item->ten_phong_ban }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Bằng cấp</label>
                                    <select class="form-control" id="" name="bangcap_idEdit">
                                        <option>Chọn bằng cấp</option>
                                        @foreach ($listDegree as $item)
                                            <option value="{{ $item->id }}">{{ $item->degree_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Ảnh 4x6</label>
                                    <input type="file" class="form-control-file" name="imageEmployee">
                                    <img class="imageEmployeeEdit" src="" alt="">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                                <button type="submit" class="btn btn-primary btn_save_data">Lưu lại</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@section('js')
    <script src="{{ asset('admins/nhanvien/nhanvien.js') }}"></script>
@endsection
@endsection
