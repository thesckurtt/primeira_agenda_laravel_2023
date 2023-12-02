@if ($mensagem = Session::get('erro'))
    {{ $mensagem }}
@endif
@php
    if (session()->has('login_error')) {
        $login_error = session()->get('login_error');
        // dd( old('password'));
    }
@endphp
{{-- @if ($errors->any())
    @foreach ($errors->all() as $error)
        {{ $error }}
    @endforeach
@endif --}}
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php //TODO: reformular página e colocar asset()
    ?>
    <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
    <link rel="stylesheet" href="{{ asset('css/imports.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('_dashboard/css/alert.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <title>Login | Primeira Agenda </title>
</head>

<body>
    <main class="main-site limit">
        <?php //Logo Primeira Agenda
        ?>
        <div class="div-logo-site-login">
            <div class="div-logo-login-svg">
                <svg viewBox="0 0 422 163" fill="none" xmlns="http://www.w3.org/2000/svg" width="200"
                    height="120">
                    <g clip-path="url(#clip0_38_2)">
                        <path
                            d="M100.169 0C83.6891 0 67.8841 6.57461 56.231 18.2775L18.1999 56.4708C6.54668 68.1737 0 84.0461 0 100.597C0 135.061 27.8203 163 62.1384 163C78.6186 163 94.4236 156.425 106.077 144.722L132.383 118.304C132.384 118.304 132.383 118.303 132.383 118.304L209.031 41.3292C214.596 35.74 222.145 32.6 230.015 32.6C243.193 32.6 254.364 41.2249 258.237 53.1601L282.427 28.8671C271.392 11.5096 252.042 0 230.015 0C213.535 0 197.73 6.57461 186.077 18.2775L83.1232 121.671C77.5576 127.26 70.0093 130.4 62.1384 130.4C45.7483 130.4 32.4615 117.057 32.4615 100.597C32.4615 92.6921 35.5882 85.1115 41.1537 79.5223L79.1845 41.3292C84.75 35.74 92.2984 32.6 100.169 32.6C113.347 32.6 124.518 41.2253 128.391 53.1609L152.582 28.8677C141.546 11.51 122.197 0 100.169 0Z"
                            fill="#fff"></path>
                        <path
                            d="M212.969 121.671C207.404 127.26 199.855 130.4 191.985 130.4C178.809 130.4 167.638 121.777 163.764 109.844L139.575 134.137C150.611 151.492 169.959 163 191.985 163C208.465 163 224.27 156.425 235.923 144.722L338.877 41.3292C344.442 35.74 351.991 32.6 359.862 32.6C376.252 32.6 389.538 45.9434 389.538 62.4035C389.538 70.3079 386.412 77.8885 380.846 83.4777L342.815 121.671C337.25 127.26 329.702 130.4 321.831 130.4C308.654 130.4 297.483 121.776 293.609 109.841L269.42 134.134C280.455 151.491 299.804 163 321.831 163C338.311 163 354.116 156.425 365.769 144.722L403.8 106.529C415.453 94.8263 422 78.9539 422 62.4035C422 27.939 394.18 0 359.862 0C343.381 0 327.576 6.57461 315.923 18.2775L212.969 121.671Z"
                            fill="#fff"></path>
                    </g>
                    <defs>
                        <clipPath id="clip0_38_2">
                            <rect width="422" height="163" fill="white"></rect>
                        </clipPath>
                    </defs>
                </svg>
            </div>
            <h1>Primeira Agenda</h1>
        </div>

        <?php //Section Formulário Primeira Agenda
        ?>
        <section class="section-login-formulario">
            @if ($errors->any() || session()->has('login_error'))
                @if ($errors->any())
                    <div class="alert-error-login">
                        <span><strong>ATENÇÃO!</strong> <br>Alguns campos foram preenchidos de forma errada! </span>
                    </div>
                @elseif(session()->has('login_error'))
                    <div class="alert-error-login">
                        <span><strong>ATENÇÃO!</strong> <br>{{ session()->get('login_error') }} </span>
                        @php
                            session()->pull('login_error');
                        @endphp
                    </div>
                @endif
            @endif
            <form class="form-login" action="{{ route('login.auth') }}" method="post">
                @csrf
                <div class="div-form-email">
                    <label for="email">Email</label>
                    <div>
                        <input <?= old('email') ? 'class="error-input"' : '' ?> type="email" name="email" value="{{ old('email') }}">
                        <i class="fa-solid fa-envelope" style="margin-right: 10px;"></i>
                    </div>
                    @if ($errors->hasAny('email'))
                        @foreach ($errors->get('email') as $error)
                            <span>*{{ $error }}</span>
                        @endforeach
                    @endif
                </div>
                <div class="div-form-senha">
                    <label for="senha">Senha</label>
                    <div>
                        <div style="position: absolute;">
                            <i data-i-fa="password-eye" class="fa-solid fa-eye-slash"></i>
                        </div>
                        <input <?= old('password') ? 'class="error-input"' : '' ?> id="password" type="password" name="password" value="{{ old('password') }}">
                        <i class="fa-solid fa-lock" style="margin-right: 10px;"></i>
                    </div>
                    @if ($errors->hasAny('password'))
                        @foreach ($errors->get('password') as $error)
                            <span>*{{ $error }}</span>
                        @endforeach
                    @endif
                </div>
                <span class="span-form-recuperar-senha"><a href="#">Esqueci minha senha</a></span>
                <input class="btn-form-login" type="submit" value="Entrar">
            </form>
        </section>
    </main>
    <script>
        $('[data-i-fa="password-eye"]').click(() => {
            if ($('[data-i-fa="password-eye"]').hasClass('fa-eye-slash')) {
                $('[data-i-fa="password-eye"]').removeClass('fa-eye-slash');
                $('[data-i-fa="password-eye"]').addClass('fa-eye');
                $('#password').attr('type', 'text');

            } else {
                $('#password').attr('type', 'password');
                $('[data-i-fa="password-eye"]').removeClass('fa-eye');
                $('[data-i-fa="password-eye"]').addClass('fa-eye-slash');
                att
            }

        })
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script>
</body>

</html>
