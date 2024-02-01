<div class="modal-content">
    <div class="modal-header {{ $headerStyleClass ?? '' }}">
        <h5 class="modal-title {{ $headerTextStyleClass ?? '' }}" id="exampleModalLabel">
            {{ __($modalTitle ?? 'ADD NEW') }}
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    @php
        $editmodal = false;
        if (isset($edit) && $edit === true && isset($data) && !empty($data)) {
            $editmodal = true;
        }
    @endphp
    <form action="{{ $submitUrl ?? '#' }}" id="form-add-package" class="custom-validation needs-validation ajax-form"
        novalidate method="post">
        @csrf

        <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group mb-3">
                        <label for="username" class="mb-1">{{ __('User Name') }} <span
                                class="text-danger">*</span></label>
                        <input type="text" class="form-control " name="username" id="username"
                            placeholder="{{ __('User Name') }}" required>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group mb-3">
                        <label for="email" class="mb-1">{{ __('Email') }} <span
                                class="text-danger">*</span></label>
                        <input type="email" class="form-control " name="email" id="email"
                            placeholder="{{ __('Email') }}" required>
                    </div>
                </div>
                <div class="col-md-12  mb-3">
                    <label for="password" class="mb-1">{{ __('Password') }} <span
                        class="text-danger">*</span></label>
                    <div class="input-group mb-3">
                        <input type="password" name="password" id="password" class="form-control" placeholder="{{ __('Password') }}" aria-label="{{ __('Password') }}" aria-describedby="password_btn" required>
                        <button class="btn btn-outline-secondary" type="button" id="password_btn">Show</button>
                      </div>
                </div>
                <div class="col-md-12  mb-3">
                    <label for="password_confirmation" class="mb-1">{{ __('Confirm Password') }} <span
                        class="text-danger">*</span></label>
                    <div class="input-group mb-3">
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="{{ __('Confirm Password') }}" aria-label="{{ __('Confirm Password') }}" aria-describedby="password_confirmation_btn" required>
                        <button class="btn btn-outline-secondary" type="button" id="password_confirmation_btn">Show</button>
                      </div>
                </div>
            </div>
        </div>

        <div class="modal-footer {{ $footerStyleClass ?? '' }}">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit"
                class="btn {{ $footerSubmitStyleClass ?? 'btn-primary' }}">{{ __($submitButton ?? 'Save') }}</button>
        </div>

    </form>
</div>


<script type="text/javascript">
    // Show password
    $(document).ready(function() {
        $('#password_btn').on('click', function() {
            if ($('#password').attr('type') == 'password') {
                $('#password').attr('type', 'text');
                $('#password_btn').text('Hide');
            } else {
                $('#password').attr('type', 'password');
                $('#password_btn').text('Show');
            }
        });
        $('#password_confirmation_btn').on('click', function() {
            if ($('#password_confirmation').attr('type') == 'password') {
                $('#password_confirmation').attr('type', 'text');
                $('#password_confirmation_btn').text('Hide');
            } else {
                $('#password_confirmation').attr('type', 'password');
                $('#password_confirmation_btn').text('Show');
            }
        });
    });
    (function() {
        'use strict'
        const forms = document.querySelectorAll('.needs-validation')
        Array.from(forms).forEach(form => {
            form.addEventListener('submit', event => {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }

                form.classList.add('was-validated')
            }, false)
        })

    })();
</script>
