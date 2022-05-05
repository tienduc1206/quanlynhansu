@extends('layouts.admin')

@section('title')
    <title>Trang chủ</title>
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-8">
                        <form action="{{ route('permissions.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="">Chọn tên module</label>
                                <select class="form-control" name="module_parent">
                                    <option value="0">Chọn tên module</option>
                                    @foreach (config('permissions.table_module') as $moduleItem)
                                        <option>{{ $moduleItem }}</option>
                                    @endforeach

                                </select>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    @foreach (config('permissions.module_childrent') as $moduleItemChildrent)
                                        <div class="col-md-3">
                                            <label for="">
                                                <input type="checkbox" value="{{ $moduleItemChildrent }}"
                                                    name="module_childrent[]">
                                                {{ $moduleItemChildrent }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
