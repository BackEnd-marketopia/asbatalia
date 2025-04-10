@extends('admin.layouts.master')

@push('css')

    <style>
        .fileholder {
            min-height: 200px !important;
        }

        .fileholder-files-view-wrp.accept-single-file .fileholder-single-file-view,.fileholder-files-view-wrp.fileholder-perview-single .fileholder-single-file-view{
            height: 330px !important;
        }
    </style>
@endpush

@section('page-title')
    @include('admin.components.page-title',['title' => __($page_title)])
@endsection

@section('breadcrumb')
    @include('admin.components.breadcrumb',['breadcrumbs' => [
        [
            'name'  => __("Dashboard"),
            'url'   => setRoute("admin.dashboard"),
        ],
        [
            'name'  => __("Doctors"),
            'url'   => setRoute("admin.doctor.care.index")
        ]
    ], 'active' => __("Doctor Edit")])
@endsection

@section('content')
<div class="custom-card">
    <div class="card-header">
        <h6 class="title">{{ __($page_title) }}</h6>
    </div>
    <div class="card-body">
        <form class="card-form" action="{{ setRoute('admin.doctor.care.update',$doctors->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method("PUT")
            <div class="row justify-content-center">
                <div class="col-xl-4 col-lg-4 form-group">
                    @include('admin.components.form.input-file',[
                        'label'             => __("Image"),
                        'name'              => "image",
                        'class'             => "file-holder",
                        'old_files_path'    => files_asset_path("site-section"),
                        'old_files'         => old("old_image",$doctors->image),
                    ])
                </div>
            </div>
            <div class="row justify-content-center mb-10-none">
                <div class="col-xl-6 col-lg-6 form-group">
                    <label>{{ __("Select Branch") }}*</label>
                    <select class="form--control select2-basic" name="branch">
                        <option disabled selected>{{ __("Select Branch") }}</option>
                        @foreach ($hospital_branch as $branch)
                            <option value="{{ $branch->id }}" {{ $branch->id == $doctors->hospital_branch_id ? 'selected' : '' }}>{{ $branch->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-xl-6 col-lg-6 form-group">
                    <label>{{ __("Select Department") }}*</label>
                    <select class="form--control select2-basic" name="department">
                        @foreach ($hospital_department as $department)
                            <option value="{{ $department->id }}" {{ $department->id == $doctors->hospital_department_id ? 'selected' : '' }}>{{ $department->name }}</option>
                        @endforeach
                        
                    </select>
                </div>
                <div class="col-xl-6 col-lg-6 form-group">
                    @include('admin.components.form.input',[
                        'label'             => __("Doctor Name")."*",
                        'name'              => "name",
                        'placeholder'       => __("Write Name")."...",
                        'value'             => old('name',$doctors->name),   
                    ])
                </div>
                <div class="col-xl-6 col-lg-6 form-group">
                    @include('admin.components.form.input',[
                        'label'             => __("Doctor Title")."*",
                        'name'              => "doctor_title",
                        'placeholder'       => __("Write Title")."...",
                        'value'             => old("doctor_title",$doctors->doctor_title),   
                    ])
                </div>
                <div class="col-xl-6 col-lg-6 form-group">
                    @include('admin.components.form.input',[
                        'label'             => __("Doctor Qualification")."*",
                        'name'              => "qualification",
                        'placeholder'       => __("Write Qualification")."...",
                        'value'             => old('qualification',$doctors->qualification),   
                    ])
                </div>
                <div class="col-xl-6 col-lg-6 form-group">
                    @include('admin.components.form.input',[
                        'label'             => __("Doctor Speciality"),
                        'name'              => "speciality",
                        'placeholder'       => __("Write Speciality")."...",
                        'value'             => old('speciality',$doctors->speciality),   
                    ])
                </div>
                <div class="col-xl-6 col-lg-6 form-group">
                    @php
                        $languagesData = $doctors->language;
                        $languages     = explode(',',$languagesData);

                    @endphp
                    <label>{{ __("Language Spoken") }}<span>*</span></label>
                    <select name="language[]" class="form-control select2-auto-tokenize"  multiple="multiple" data-placeholder="Add Language">
                        @foreach ($languages as $item)
                            <option value="{{ $item }}" @selected(true)>{{$item}}</option>
                        @endforeach

                    </select>
                </div>
                <div class="col-xl-6 col-lg-6 form-group">
                    @include('admin.components.form.input',[
                        'label'             => __("Doctor Designation")."*",
                        'name'              => "designation",
                        'placeholder'       => __("Write Designation")."...",
                        'value'             => old('designation',$doctors->designation),   
                    ])
                </div>
                <div class="col-xl-6 col-lg-6 form-group">
                    @include('admin.components.form.input',[
                        'label'             => __("Doctor Contact")."*",
                        'name'              => "contact",
                        'placeholder'       => __("Write Contact")."...",
                        'value'             => old('contact',$doctors->contact),   
                    ])
                </div>
                <div class="col-xl-6 col-lg-6 form-group">
                    @include('admin.components.form.input',[
                        'label'             => __("Doctor Off Days")."*",
                        'name'              => "off_days",
                        'placeholder'       => __("Write Off Days")."...",
                        'value'             => old('off_days',$doctors->off_days),   
                    ])
                </div>
                <div class="col-xl-6 col-lg-6 form-group">
                    @include('admin.components.form.input',[
                        'label'             => __("Doctor Floor Number"),
                        'name'              => "floor_number",
                        'placeholder'       => __("Write Floor Number")."...",
                        'value'             => old('floor_number',$doctors->floor_number),   
                    ])
                </div>
                <div class="col-xl-6 col-lg-6 form-group">
                    @include('admin.components.form.input',[
                        'label'             => __("Doctor Room Number"),
                        'name'              => "room_number",
                        'placeholder'       => __("Write Room Number")."...",
                        'value'             => old('room_number',$doctors->room_number),   
                    ])
                </div>
                <div class="col-xl-6 col-lg-6 form-group">
                    @include('admin.components.form.input',[
                        'label'             => __("Doctor Address"),
                        'name'              => "address",
                        'placeholder'       => __("Write Address")."...",
                        'value'             => old('address',$doctors->address),   
                    ])
                </div>
                <div class="col-xl-6 col-lg-6 form-group">
                    <label>{{ __("Doctor Fees") }}*</label>
                    <div class="input-group">
                        @include('admin.components.form.input',[
                        'name'              => "fees",
                        'class'             => "number-input",
                        'placeholder'       => __("Write Fees")."...",
                        'value'             => old('fees',get_amount($doctors->fees)),   
                        ])
                        <span class="input-group-text">{{ get_default_currency_code($default_currency) }}</span>
                    </div>
                </div>
                
                <div class="col-xl-12 col-lg-12 form-group">
                    <div class="custom-inner-card">
                        <div class="card-inner-header">
                            <h6 class="title">{{ __("Schedule") }}</h6>
                            <button type="button" class="btn--base add-schedule-btn"><i class="fas fa-plus"></i> {{ __("Add") }}</button>
                        </div>
                        <div class="card-inner-body">
                            <div class="results">
                                @include('admin.components.doctor-care.schedule-item',compact('weeks','doctor_has_schedule'))    
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-12 col-lg-12 form-group">
                    @include('admin.components.button.form-btn',[
                        'class'         => "w-100 btn-loading",
                        'text'          => "Submit",
                        'permission'    => "admin.hospital.branch.store"
                    ])
                </div>
            </div>
        </form>
    </div>
</div>

@endsection

@push('script')
    <script>

        $(document).ready(function(){

            var getDepartmentURL = "{{ setRoute('admin.doctor.care.get.branch.departments') }}";

            $('select[name="branch"]').on('change',function(){
                var branch = $(this).val();

                if(branch == "" || branch == null) {
                    return false;
                }

                $.post(getDepartmentURL,{branch:branch,_token:"{{ csrf_token() }}"},function(response){
                    // console.log(response.data.branch.departments);
                    var option = '';
                    if(response.data.branch.departments.length > 0) {
                        $.each(response.data.branch.departments,function(index,item) {
                            option += `<option value="${item.hospital_department_id}">${item.department.name}</option>`
                        });

                        // console.log(option);
                        $("select[name=department]").html(option);
                        $("select[name=department]").select2();

                    }
                }).fail(function(response) {

                    var errorText = response.responseJSON;
                    
                });

            });
        });
        //getScheduleDays
        $(document).ready(function(){

            var getDayURL = "{{ setRoute('admin.doctor.care.get.days') }}";
            $('.add-schedule-btn').click(function(){
                $.get(getDayURL,function(data){
                    $('.results').prepend(data);
                    $('.results').find('.row').first().find("select").select2();
                });
            });
        });
    </script>
@endpush