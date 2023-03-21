<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Go-Wisata ID</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>
    <style>
        .height-100 {
            height: 100vh
        }

        .card {
            width: 400px;
            border: none;
            height: 300px;
            box-shadow: 0px 5px 20px 0px #d2dae3;
            z-index: 1;
            display: flex;
            justify-content: center;
            align-items: center
        }

        .card h6 {
            color: rgb(0, 255, 55);
            font-size: 20px
        }

        .inputs input {
            width: 40px;
            height: 40px
        }

        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            margin: 0
        }

        .card-2 {
            background-color: #fff;
            padding: 10px;
            width: 350px;
            height: 100px;
            bottom: -50px;
            left: 20px;
            position: absolute;
            border-radius: 5px
        }

        .card-2 .content {
            margin-top: 50px
        }

        .card-2 .content a {
            color: red
        }

        .form-control:focus {
            box-shadow: none;
            border: 2px solid rgb(0, 255, 55);
        }

        .validate {
            border-radius: 20px;
            height: 40px;
            background-color: rgb(0, 255, 55);
            border: 1px solid rgb(0, 255, 55);
            width: 140px
        }
    </style>
    <div class="container height-100 d-flex justify-content-center align-items-center">
        <div class="position-relative">
            <div class="card p-2 text-center">
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ $error }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @endforeach
                @endif
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @if (session('warning'))
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        {{ session('warning') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <h6>Please enter the one time password <br> to verify your account</h6>
                <div> <span>A code has been sent to</span> <small>{{ $email }}</small> </div>
                <div> <span>This code is eligible for 10 minutes</small> </div>
                <form action="{{ url('otp/' . $userID) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div id="otp" class="inputs d-flex flex-row justify-content-center mt-2"> <input
                            class="m-2 text-center form-control rounded" type="text" id="first" maxlength="1"
                            name="first" />
                        <input class="m-2 text-center form-control rounded" type="text" id="second" maxlength="1"
                            name="second" />
                        <input class="m-2 text-center form-control rounded" type="text" id="third" maxlength="1"
                            name="third" />
                        <input class="m-2 text-center form-control rounded" type="text" id="fourth" maxlength="1"
                            name="fourth" />
                        <input class="m-2 text-center form-control rounded" type="text" id="fifth" maxlength="1"
                            name="fifth" />
                        <input class="m-2 text-center form-control rounded" type="text" id="sixth" maxlength="1"
                            name="sixth" />
                    </div>
                    <div class="card-2">
                        <div class="content d-flex justify-content-between align-items-center">
                            <div> <span>Didn't receive the code?</span> <a
                                    href="{{ url('otp/' . $userID . '/resend') }}">Resend</a> </div>
                            <div> <span>Need help?</span> <a href="https://wa.me/6285852535905" target="_blank">Contact
                                    us</a> </div>
                        </div>
                    </div>
                    <div class="mt-2"> <button type="submit" class="btn btn-danger px-4 validate">Validate</button>
                    </div><br>
                </form>

            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function(event) {

            function OTPInput() {
                const inputs = document.querySelectorAll('#otp > *[id]');
                for (let i = 0; i < inputs.length; i++) {
                    inputs[i].addEventListener('keydown', function(event) {
                        if (event.key === "Backspace") {
                            inputs[i].value = '';
                            if (i !== 0) inputs[i - 1].focus();
                        } else {
                            if (i === inputs.length - 1 && inputs[i].value !== '') {
                                return true;
                            } else if (event.keyCode > 47 && event.keyCode < 58) {
                                inputs[i].value = event.key;
                                if (i !== inputs.length - 1) inputs[i + 1].focus();
                                event.preventDefault();
                            } else if (event.keyCode > 64 && event.keyCode < 91) {
                                inputs[i].value = String.fromCharCode(event.keyCode);
                                if (i !== inputs.length - 1) inputs[i + 1].focus();
                                event.preventDefault();
                            }
                        }
                    });
                }
            }
            OTPInput();
        });

        // function verifyOTP() {
        //     var o1 = document.getElementById('first').value;
        //     var o2 = document.getElementById('second').value;
        //     var o3 = document.getElementById('third').value;
        //     var o4 = document.getElementById('fourth').value;
        //     var o5 = document.getElementById('fifth').value;
        //     var o5 = document.getElementById('sixth').value;

        //     var alert_box = document.getElementById('alert_box');
        //     if (o1 != "" && o2 != "" && o3 != "" && o4 != "" && o5 != "" && o6 != "") {
        //         var otp = parseInt(o1 + o2 + o3 + o4 + o5 + o6);
        //         console.log(otp);
        //         $.ajax({
        //             type: "POST", //type of method
        //             url: "profile.php", //your page
        //             data: {
        //                 otp: otp,
        //             }, // passing the values
        //             success: function(res) {
        //                 //do what you want here...
        //             }
        //         });
        //     } else {
        //         // alert_box.style.display = 'block';
        //         console.log('Please enter OTP');
        //     }
        // }
    </script>
</body>

</html>
