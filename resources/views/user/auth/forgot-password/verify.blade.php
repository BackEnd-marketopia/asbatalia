<!DOCTYPE html>
<html lang="en">
<head>
    @include('frontend.partials.head')
    @include('partials.header-asset')
</head>
<body>

    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    Start Preloader
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->

@include('frontend.partials.preloader')

<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    End Preloader
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->



<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    Start body overlay
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
<div id="body-overlay" class="body-overlay"></div>
<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    End body overlay
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->


<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    Start Account
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
<div class="account-section active">
    <div class="account-area change-form">
        <div class="account-form-area">
            <div class="account-logo text-center">
                <a class="site-logo" href="{{ setRoute('index') }}"><img src="{{ get_logo($basic_settings) }}" alt="logo"></a>
            </div>
            <h5 class="title text-center">{{ __("Please enter the code") }}</h5>
            <p class="d-block text-center">{{ __("We sent a 6-digit code to your email") }}<strong>{{ $user_email ?? ""}}</strong></p>
            <form class="account-form" action="{{ setRoute('user.password.forgot.verify.code',$token) }}" method="POST">
                @csrf
                <div class="row ml-b-20">
                    <div class="col-lg-12 form-group text-center">
                        <input class="otp" type="text"  name="code[]" oninput='digitValidate(this)' onkeyup='tabChange(1)'
                            maxlength=1 required>
                        <input class="otp" type="text"  name="code[]"  oninput='digitValidate(this)' onkeyup='tabChange(2)'
                            maxlength=1 required>
                        <input class="otp" type="text"  name="code[]" oninput='digitValidate(this)' onkeyup='tabChange(3)'
                            maxlength=1 required>
                        <input class="otp" type="text"  name="code[]"  oninput='digitValidate(this)' onkeyup='tabChange(4)'
                            maxlength=1 required>
                        <input class="otp" type="text"  name="code[]"  oninput='digitValidate(this)' onkeyup='tabChange(5)'
                            maxlength=1 required>
                        <input class="otp" type="text"  name="code[]" oninput='digitValidate(this)' onkeyup='tabChange(6)'
                            maxlength=1 required>
                    </div>
                    <div class="col-lg-12 form-group text-end">
                        <div class="time-area">{{ __("You can resend the code after") }}<span id="time"></span></div>
                    </div>
                    <div class="col-lg-12 form-group text-center">
                        <button type="submit" class="btn--base w-100">{{ __("Submit") }}</button>
                    </div>
                    <div class="col-lg-12 text-center">
                        <div class="account-item">
                            <label>{{ __("Already Have An Account?") }}<a href="" class="account-control-btn">{{ __("Login Now") }}</a></label>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    End Account
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->


<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    Start bubbles
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
<ul class="bg-bubbles">
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
</ul>
<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    End bubbles
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->


@include('partials.footer-asset')
@include('admin.partials.notify')

<script>
    var resendTime = "{{ $resend_time ?? 0 }}";
    var resendCodeLink = "{{ setRoute('user.password.forgot.resend.code',$token) }}";
    let digitValidate = function (ele) {
        console.log(ele.value);
        ele.value = ele.value.replace(/[^0-9]/g, '');
    }
    let tabChange = function (val) {
        let ele = document.querySelectorAll('.otp');
        if (ele[val - 1].value != '') {
            ele[val].focus()
        } else if (ele[val - 1].value == '') {
            ele[val - 2].focus()
        }
    }
    $(".otp").parents("form").find("input[type=submit],button[type=submit]").click(function(e){
        // e.preventDefault();
        var otps = $(this).parents("form").find(".otp");
        var result = true;
        $.each(otps,function(index,item){
            if($(item).val() == "" || $(item).val() == null) {
                result = false;
            }
        });
        if(result == false) {
            $(this).parents("form").find(".otp").addClass("required");
        }else {
            $(this).parents("form").find(".otp").removeClass("required");
            $(this).parents("form").submit();
        }
    });
    function resetTime (second = 20) {
        var coundDownSec = second;
        var countDownDate = new Date();
        countDownDate.setMinutes(countDownDate.getMinutes() + 120);
        var x = setInterval(function () {  // Get today's date and time
            var now = new Date().getTime();  // Find the distance between now and the count down date
            var distance = countDownDate - now;  // Time calculations for days, hours, minutes and seconds  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * coundDownSec)) / (1000 * coundDownSec));
            var seconds = Math.floor((distance % (1000 * coundDownSec)) / 1000);  // Output the result in an element with id="time"
            document.getElementById("time").innerHTML =second + "s ";  // If the count down is over, write some text
            if (distance < 0 || second < 2 ) {
                // alert();
                clearInterval(x);
                // document.getElementById("time").innerHTML = "RESEND";
                document.querySelector(".time-area").innerHTML = `{{ __("Didn't get the code") }}? <a class='text--danger' href='${resendCodeLink}'>{{ __("Resend") }}</a>`;
            }
            second--
        }, 1000);
    }
    resetTime(resendTime);
</script>
</body>
</html>