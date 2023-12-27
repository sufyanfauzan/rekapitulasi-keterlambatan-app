<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
            background: #ececec;
        }

        .box-area {
            width: 930px;
        }

        .right-box {
            padding: 40px 30px 40px 40px;
        }

        ::placeholder {
            font-size: 16px;
        }

        .rounded-4 {
            border-radius: 20px;
        }

        .rounded-5 {
            border-radius: 30px;
        }

        @media only screen and (max-width: 768px) {

            .box-area {
                margin: 0 10px;

            }

            .left-box {
                height: 100px;
                overflow: hidden;
            }

            .right-box {
                padding: 20px;
            }

        }
    </style>
</head>

<body>
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="row border rounded-5 bg-white shadow box-area">
            <div class="col-md-6 rounded-4 d-flex justify-content-center align-items-center flex-column left-box"
                style="background: #103cbe;">
                <div class="featured-image mt-5 mb-3">
                    <img src="https://cdn3.iconfinder.com/data/icons/business-people-concept-ii/1123/People_Elements-25-03-1024.png"
                        class="img-fluid" style="width: 300px;">
                </div>
                <p class="text-white fs-2 text-center mb-5"
                    style="font-family: 'Courier New', Courier, monospace; font-weight: 600;">Rekapitulasi Keterlambatan
                </p>
            </div>
            <div class="col-md-6 right-box">
                <div class="row align-items-center">
                    <form action="{{ route('login.auth') }}" class="card p-4 mt-5" method="POST">
                        @csrf
                        @if (Session::get('failed'))
                            <div class="alert alert-danger mt-3">{{ Session::get('failed') }}</div>
                        @endif
                        <div class="input-group mb-3 mt-5">
                            <input type="text" name="email" class="form-control form-control-lg bg-light fs-6"
                                placeholder="Email" @error('email') is-invalid @enderror>
                        </div>
                        @error('email')
                            <small class="text-danger mb-2">{{ $message }}</small>
                        @enderror
                        <div class="input-group mb-3">
                            <input type="password" name="password" class="form-control form-control-lg bg-light fs-6"
                                placeholder="Password" @error('password') is-invalid @enderror>
                        </div>
                        @error('password')
                            <small class="text-danger mb-2">{{ $message }}</small>
                        @enderror
                        <div class="input-group mb-3">
                            <button class="btn btn-lg btn-primary w-100 fs-6">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
