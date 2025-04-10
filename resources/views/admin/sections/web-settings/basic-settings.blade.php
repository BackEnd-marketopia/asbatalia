@extends('admin.layouts.master')

@push('css')

@endpush

@section('page-title')
    @include('admin.components.page-title',['title' => __($page_title)])
@endsection

@section('breadcrumb')
    @include('admin.components.breadcrumb',['breadcrumbs' => [
        [
            'name'  => __("Dashboard"),
            'url'   => setRoute("admin.dashboard"),
        ]
    ], 'active' => __("Web Settings")])
@endsection

@section('content')
    <div class="custom-card">
        <div class="card-header">
            <h6 class="title">{{ __("Basic Settings") }}</h6>
        </div>
        <div class="card-body">
            <form class="card-form" method="POST" action="{{ setRoute('admin.web.settings.basic.settings.update') }}">
                @csrf
                @method("PUT")
                <div class="row">
                    <div class="col-xl-4 col-lg-4 form-group">
                        <label>{{ __("Site Base Color") }}*</label>
                        <div class="picker">
                            <input type="color" value="{{ old('base_color',$basic_settings->base_color) }}" class="color color-picker">
                            <input type="text" autocomplete="off" spellcheck="false" class="color-input" value="{{ old('base_color',$basic_settings->base_color) }}" name="base_color">
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 form-group">
                        <label>{{ __("Timezone") }}*</label>
                        <select name="timezone" class="form--control select2-auto-tokenize timezone-select" data-old="{{ old('timezone',$basic_settings->timezone) }}">
                            <option selected disabled>Select Timezone</option>
                        </select>
                    </div>
                    <div class="col-xl-4 col-lg-4 form-group">
                        @include('admin.components.form.input',[
                            'label'         => "Web Version*",
                            'type'          => "text",
                            'class'         => "form--control",
                            'placeholder'   => "Write Name...",
                            'name'          => "web_version",
                            'value'         => old('web_version',$basic_settings->web_version),
                        ])
                    </div>
                    <div class="col-xl-4 col-lg-4 form-group">
                        @include('admin.components.form.input',[
                            'label'         => __("Site Name")."*",
                            'type'          => "text",
                            'class'         => "form--control",
                            'placeholder'   => __("Write Name")."...",
                            'name'          => "site_name",
                            'value'         => old('site_name',$basic_settings->site_name),
                        ])
                    </div>
                    <div class="col-xl-4 col-lg-4 form-group">
                        @include('admin.components.form.input',[
                            'label'         => __("Site Title")."*",
                            'type'          => "text",
                            'class'         => "form--control",
                            'placeholder'   => __("Write Name")."...",
                            'name'          => "site_title",
                            'value'         => old('site_title',$basic_settings->site_title),
                        ])
                    </div>
                    <div class="col-xl-4 col-lg-4 form-group">
                        <label>{{ __("OTP Expiration") }}*</label>
                        <div class="input-group">
                            <input type="number" class="form--control" value="{{ old('otp_exp_seconds',$basic_settings->otp_exp_seconds) }}" name="otp_exp_seconds">
                            <span class="input-group-text">{{ __("Seconds") }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-xl-12 col-lg-12">
                    @include('admin.components.button.form-btn',[
                        'class'         => "w-100 btn-loading",
                        'text'          => "Update",
                        'permission'    => "admin.web.settings.basic.settings.update",
                    ])
                </div>
            </form>
        </div>
    </div>
    <div class="custom-card mt-15">
        <div class="card-header">
            <h6 class="title">{{ __("Activation Settings") }}</h6>
        </div>
        <div class="card-body">
            <div class="custom-inner-card mt-10 mb-10">
                <div class="card-inner-body">
                    <div class="row mb-10-none">
                        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 form-group">
                            @include('admin.components.form.switcher',[
                                'label'         => __("User Registration"),
                                'name'          => 'user_registration',
                                'value'         => old('user_registration',$basic_settings->user_registration),
                                'options'       => [__("Activated") => 1,__("Deactivated") => 0],
                                'onload'        => true,
                                'permission'    => "admin.web.settings.basic.settings.activation.update",
                            ])
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 form-group">
                            @include('admin.components.form.switcher',[
                                'label'         => __("Secure Password"),
                                'name'          => 'secure_password',
                                'value'         => old('secure_password',$basic_settings->secure_password),
                                'options'       => [__("Activated") => 1,__("Deactivated") => 0],
                                'onload'        => true,
                                'permission'    => "admin.web.settings.basic.settings.activation.update",
                            ])
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 form-group">
                            @include('admin.components.form.switcher',[
                                'label'         => __("Agree Policy"),
                                'name'          => 'agree_policy',
                                'value'         => old('agree_policy',$basic_settings->agree_policy),
                                'options'       => [__("Activated") => 1,__("Deactivated") => 0],
                                'onload'        => true,
                                'permission'    => "admin.web.settings.basic.settings.activation.update",
                            ])
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 form-group">
                            @include('admin.components.form.switcher',[
                                'label'         => __("Force SSL"),
                                'name'          => 'force_ssl',
                                'value'         => old('force_ssl',$basic_settings->force_ssl),
                                'options'       => [__("Activated") => 1,__("Deactivated") => 0],
                                'onload'        => true,
                                'permission'    => "admin.web.settings.basic.settings.activation.update",
                            ])
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 form-group">
                            @include('admin.components.form.switcher',[
                                'label'         => __("Email Verification"),
                                'name'          => 'email_verification',
                                'value'         => old('email_verification',$basic_settings->email_verification),
                                'options'       => [__("Activated") => 1,__("Deactivated") => 0],
                                'onload'        => true,
                                'permission'    => "admin.web.settings.basic.settings.activation.update",
                            ])
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 form-group">
                            @include('admin.components.form.switcher',[
                                'label'         => __("Email Notification"),
                                'name'          => 'email_notification',
                                'value'         => old('email_notification',$basic_settings->email_notification),
                                'options'       => [__("Activated") => 1,__("Deactivated") => 0],
                                'onload'        => true,
                                'permission'    => "admin.web.settings.basic.settings.activation.update",
                            ])
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 form-group">
                            @include('admin.components.form.switcher',[
                                'label'         => __("Push Notification"),
                                'name'          => 'push_notification',
                                'value'         => old('push_notification',$basic_settings->push_notification),
                                'options'       => [__("Activated") => 1,__("Deactivated") => 0],
                                'onload'        => true,
                                'permission'    => "admin.web.settings.basic.settings.activation.update",
                            ])
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 form-group">
                            @include('admin.components.form.switcher',[
                                'label'         => __("KYC Verification"),
                                'name'          => 'kyc_verification',
                                'value'         => old('kyc_verification',$basic_settings->kyc_verification),
                                'options'       => [__("Activated") => 1,__("Deactivated") => 0],
                                'onload'        => true,
                                'permission'    => "admin.web.settings.basic.settings.activation.update",
                            ])
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        $(document).ready(function() {
            $(".color-picker").on("input",function() {
                $(this).siblings("input").val($(this).val());
            });

            // Get Timezone
            getTimeZones("{{ setRoute('global.timezones') }}");

            switcherAjax("{{ setRoute('admin.web.settings.basic.settings.activation.update') }}");
        });
    </script>
@endpush