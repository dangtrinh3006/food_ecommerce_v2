<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{!! asset('admin_asset/css/css_page_login.css') !!}">

    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reset password</title>
    
</head>

<body class="align">
        <div class="grid">
            @if (session('error_login'))
                <h4 style="color: red">{{ Session::get('error_login') }}</h4>
            @endif
            @if (session('change_pass'))
                <h4 style="color: red">{{ Session::get('change_pass') }}</h4>
            @endif
            @if (session('sendmailrs'))
                <h4 style="color: red">{{ Session::get('sendmailrs') }}</h4>
            @endif
            {{ Session::forget('error_login') }}
            {{ Session::forget('change_pass') }}
            {{ Session::forget('sendmailrs') }}
            <form action="{{ route('sendmailreset') }}" method="post" class="form login">
                @csrf
                    <h4>Nhập email của bạn:</h4>

                <div class="form__field">
                    <label for="login__username"><svg class="icon">
                            <use xlink:href="#icon-user"></use>
                        </svg><span class="hidden">Username</span></label>
                    <input  id="emailreset" type="text" name="emailreset"
                        class="form__input" placeholder="Email" required>
                </div>

                

                <div class="form__field">
                    <input type="submit" value="Gửi">
                </div>

            </form>

        </div>

        
    
</body>

</html>
