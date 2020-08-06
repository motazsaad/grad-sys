@extends('layout')
@section('title','الإعدادات')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">إعدادات النظام</h3>
                </div>
                <form role="form" method="post" action="{{route('admin.settings.update')}}">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-3">
                                <label>الحد الأقصى لعدد أعضاء الفريق</label>
                                <input type="text"
                                       class="form-control @error('max_group_members') is-invalid  @enderror"
                                       name="max_group_members"
                                       value="{{$settings['max_group_members']}}">
                                @error('max_group_members')
                                <div class="alert alert-danger" style="margin-top: 10px">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-3">
                                <label>الحد الأدنى لعدد أعضاء الفريق</label>
                                <input type="text"
                                       class="form-control @error('min_group_members') is-invalid  @enderror"
                                       name="min_group_members"
                                       value="{{$settings['min_group_members']}}">
                                @error('min_group_members')
                                <div class="alert alert-danger" style="margin-top: 10px">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-3">
                                <label>الحد الأقصى لعدد المجموعات للمشرف</label>
                                <input type="text"
                                       class="form-control @error('max_teacher_groups') is-invalid  @enderror"
                                       name="max_teacher_groups"
                                       value="{{$settings['max_teacher_groups']}}">
                                @error('max_teacher_groups')
                                <div class="alert alert-danger" style="margin-top: 10px">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">تحديث</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">نوع المشروع</h3>
                </div>
                <div class="card-body p-0">
                    <table class="table table-sm">
                        <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th style="width: 150px;">اسم</th>
                            <th style="width: 125px;">الاستخدام</th>
                            <th>إعدادات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($tags as $key => $tag)
                            <tr>
                                <td style="display: none" class="tag-key">{{$key}}</td>
                                <td>{{$loop->iteration}}</td>
                                <td class="tag-name">{{$tag['name']}}</td>
                                <td>{{$tag['frequency_use']}}</td>
                                <td>
                                    <a class="btn btn-info btn-sm update-click" style="color: white;">
                                        <i class="fa fa-pencil"></i>
                                        تعديل
                                    </a>
                                    <a class="btn btn-danger btn-sm delete-confirm"
                                       href="{{route('admin.tag.destroy',['tag_key'=>$key])}}">
                                        <i class="fa fa-trash"></i>
                                        حذف
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-header" style="padding-top: 25px">
                    <h3 class="card-title">إضافة نوع مشروع جديد</h3>
                </div>
                <form role="form" method="post" action="{{route('admin.tag.update')}}">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-12">

                                <label>نوع المشروع</label>
                                <input type="text" class="form-control" id="tag-input" name="tag"
                                       value="{{old('tag')}}">
                                @error('tag')
                                <div class="alert alert-danger" style="margin-top: 10px">{{ $message }}</div>
                                @enderror
                                <input type="text" style="display: none" id="old-tag-name" name="old_tag_name">
                                <input type="text" id="tag-input-key" style="display: none" name="tag_key">
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" name="action" value="store">إضافة</button>
                        <button type="submit" class="btn btn-primary" name="action" value="update">تحديث</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">التخصصات</h3>
                </div>
                <div class="card-body p-0">
                    <table class="table table-sm">
                        <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th style="width: 150px;">اسم</th>
                            <th>إعدادات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($departments as $department_key => $department)
                            <tr>
                                <td style="display: none" class="department-key">{{$department_key}}</td>
                                <td>{{$loop->iteration}}</td>
                                <td class="department-name" style="width: 300px">{{$department}}</td>
                                <td>
                                    <a class="btn btn-info btn-sm department-update-click" style="color: white;">
                                        <i class="fa fa-pencil"></i>
                                        تعديل
                                    </a>
                                    <a class="btn btn-danger btn-sm department-delete-confirm"
                                       href="{{route('admin.department.destroy',['department_key'=>$department_key])}}">
                                        <i class="fa fa-trash"></i>
                                        حذف
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-header" style="padding-top: 25px">
                    <h3 class="card-title">إضافة تخصص جديد</h3>
                </div>
                <form role="form" method="post" action="{{route('admin.department.update')}}">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-12">

                                <label>التخصص</label>
                                <input type="text" class="form-control" id="department-input" name="department"
                                       value="{{old('department')}}">
                                @error('department')
                                <div class="alert alert-danger" style="margin-top: 10px">{{ $message }}</div>
                                @enderror
                                <input type="text" style="display: none" id="old-department-name"
                                       name="old_department_name">
                                <input type="text" id="department-input-key" style="display: none"
                                       name="department_key">
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" name="action" value="store">إضافة</button>
                        <button type="submit" class="btn btn-primary" name="action" value="update">تحديث</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        $('.delete-confirm').on('click', function (event) {
            event.preventDefault();
            const url = $(this).attr('href');
            swal({
                title: 'هل تريد حذف نوع المشروع؟',
                // text: 'هذا سيقوم بحذف المشرف نهائياً!',
                icon: 'warning',
                buttons: ["إلغاء", "نعم"],
            }).then(function (value) {
                if (value) {
                    window.location.href = url;
                }
            });
        });
        $(".update-click").click(function () {
            var $row = $(this).closest("tr");    // Find the row
            var $tag = $row.find(".tag-name").text(); // Find the text
            var $tag_key = $row.find(".tag-key").text();
            // Let's test it out
            document.getElementById('tag-input').value = $tag;
            document.getElementById('old-tag-name').value = $tag;
            document.getElementById('tag-input-key').value = $tag_key;
        });
        $('.department-delete-confirm').on('click', function (event) {
            event.preventDefault();
            const url = $(this).attr('href');
            swal({
                title: 'هل تريد حذف التخصص؟',
                // text: 'هذا سيقوم بحذف المشرف نهائياً!',
                icon: 'warning',
                buttons: ["إلغاء", "نعم"],
            }).then(function (value) {
                if (value) {
                    window.location.href = url;
                }
            });
        });
        $(".department-update-click").click(function () {
            var $d_row = $(this).closest("tr");    // Find the row
            var $department = $d_row.find(".department-name").text(); // Find the text
            var $department_key = $d_row.find(".department-key").text();
            // Let's test it out
            document.getElementById('department-input').value = $department;
            document.getElementById('old-department-name').value = $department;
            document.getElementById('department-input-key').value = $department_key;
        });
    </script>
@endpush
