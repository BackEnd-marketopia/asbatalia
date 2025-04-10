@if (admin_permission_by_name("admin.languages.store"))
    <div id="language-add" class="mfp-hide large">
        <div class="modal-data">
            <div class="modal-header px-0">
                <h5 class="modal-title">{{ __("Add Language") }}</h5>
            </div>
            <div class="modal-form-data">
                <form class="modal-form" method="POST" action="{{ setRoute('admin.languages.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-10-none mt-2">
                        <div class="col-xl-6 col-lg-6 form-group">
                            @include('admin.components.form.input',[
                                'label'         => __('Language Name')."*",
                                'name'          => 'name',
                                'placeholder'   => __('Name')."...",
                                'value'         => old('name')
                            ])
                        </div>
                        <div class="col-xl-6 col-lg-6 form-group">
                            @include('admin.components.form.input',[
                                'label'         => __('Language Code')."*",
                                'name'          => 'code',
                                'placeholder'   => __('Code')."...",
                                'value'         => old('code')
                            ])
                        </div>
                        <div class="col-xl-12 col-lg-12 form-group">
                            @include('admin.components.form.switcher',[
                                'label'         => __('Direction')."*",
                                'name'          => 'dir',
                                'value'         => old('dir','ltr'),
                                'options'       => ['LTR' => 'ltr','RTL' => 'rtl'],
                            ])
                        </div>
                        <div class="col-xl-12 col-lg-12 form-group d-flex align-items-center justify-content-between mt-4">
                            <button type="button" class="btn btn--danger modal-close">{{ __("Cancel") }}</button>
                            <button type="submit" class="btn btn--base">{{ __("Add") }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push("script")
        <script>
            openModalWhenError("language-add","#language-add");
        </script>
    @endpush
@endif