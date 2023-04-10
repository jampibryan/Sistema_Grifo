{{-- <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        <title>Laravel</title>
        <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
        <script src="https://kit.fontawesome.com/a81368914c.js"></script>
        <style>
           body:before {
                    content: '';
                    z-index: -1;
                    position: absolute;
                    left: 0;
                    right: 0;
                    top: 0;
                    bottom: 0;
                    -webkit-filter: blur(6px);
                    background: url(https://i.pinimg.com/originals/78/20/e8/7820e81754716bc32119ca0ac27ecdb7.jpg) no-repeat center center fixed;
                    background-size: cover;
                    }
                    .i {
        color: #d9d9d9;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .i i {
        transition: .3s;
    }

    .input-div>div {
        position: relative;
        height: 45px;
    }

    .input-div>div>h5 {
        position: absolute;
        left: 10px;
        top: 50%;
        transform: translateY(-50%);
        color: #999;
        font-size: 15px;
        transition: .3s;
    }

    .input-div:before,
    .input-div:after {
        content: '';
        position: absolute;
        bottom: -2px;
        width: 0%;
        height: 2px;
        background-color: #408080;
        transition: .4s;
    }

    .input-div:before {
        right: 50%;
    }

    .input-div:after {
        left: 50%;
    }

    .input-div.focus:before,
    .input-div.focus:after {
        width: 50%;
    }

    .input-div.focus>div>h5 {
        top: -5px;
        font-size: 14px;
    }

    .input-div.focus>.i>i {
        color: #408080;
    }
        </style>
    </head>
    <body class="m-0 vh-100 row justify-content-center align-items-center">
            <div class="col-auto text-center">
                <div class="card bg-light mb-3" style="max-width: 60rem; height: 410px; opacity: 90%;">
                    <div class="card-body row">
                        <div class="col-6 row align-items-center">
                            <div class="mt-4">
                                <span style="margin: 0px; font-family: monospace; font-size: 50px; color: gray; line-height : 50px;">Estación de servicio</span>
                                <img style="filter: brightness(1.1); mix-blend-mode: multiply" src="https://i.ibb.co/rbFvw2G/logo.jpg" alt="">    
                            </div>
                            <div class="row mx-auto" style="width: 250px">
                                <div class="mb-1"><label for="" style="font-family: fantasy">Redes</label></div>
                               
                                <div class="col">
                                    <a href="">
                                        <img width="30px" src="https://cdn-icons.flaticon.com/png/512/2504/premium/2504903.png?token=exp=1640752095~hmac=2f6b4b05a60e17847e85132bb8cbb231" alt="">
                                    </a>
                                </div>
                                <div class="col">
                                    <a href="">
                                        <img width="30px" src="https://cdn-icons.flaticon.com/png/512/2504/premium/2504918.png?token=exp=1640752100~hmac=ce77b800a3c8e8e6f98ebd2c621127fa" alt="">
                                    </a>
                                </div>
                                <div class="col">
                                    <a href="">
                                        <img width="30px" src="https://cdn-icons.flaticon.com/png/512/2504/premium/2504957.png?token=exp=1640752146~hmac=0c1c10e076f0ff2d2250b84465a4d22f" alt="">
                                    </a>
                                </div>
                                <div class="col">
                                    <a href="">
                                        <img width="30px" src="https://cdn-icons.flaticon.com/png/512/2504/premium/2504965.png?token=exp=1640752165~hmac=a719a1be21c1d51ea07a2877dfe93b04" alt="">
                                    </a>
                                </div>
                                <hr class="row mt-2">
                            </div>
                        </div>
    
                        <div class="col-6 row justify-content-center align-items-center">
                            @if (Route::has('login'))
                                    @auth
                                    <div class="flex font-bold justify-center" >
                                        <img class="h-20 w-20"
                                            src="https://raw.githubusercontent.com/sefyudem/Responsive-Login-Form/master/img/avatar.svg">
                                    </div>

                                    <h2 class="text-3xl text-center text-gray-700 " >BIENVENIDO</h2>
                                        <div>
                                            <a class="w-60 rounded-full btn btn-success " type="button" href="{{ url('/dashboard') }}">Ingresar</a>
                                        </div>
                                    @else
                                        

                                        <form style="width: 400px;" method="POST" action="{{ route('login') }}">
                                            @csrf
                                            <div class="flex font-bold justify-center">
                                                <img class="h-20 w-20"
                                                    src="https://raw.githubusercontent.com/sefyudem/Responsive-Login-Form/master/img/avatar.svg">
                                            </div>

                                            <h2 class="text-3xl text-center text-gray-700 mb-4">BIENVENIDO</h2>

                                            <div class="input-div border-b-2 relative grid my-4 py-1 focus:outline-none" style="grid-template-columns: 7% 93%;">
                                                <div class="i">
                                                    <i class="fas fa-user"></i>
                                                </div>
                                                <div class="div">
                                                    <h5>Email</h5>
                                                    <input id="email" type="email" name="email" required class="absolute w-full h-full py-2 px-3 outline-none inset-0 text-gray-700"
                                                        style="background:none;">
                                                </div>
                                            </div>

                                            <div class="input-div border-b-2 relative grid py-1 focus:outline-none"
                                                style="grid-template-columns: 7% 93%;">
                                                <div class="i">
                                                    <i class="fas fa-lock"></i>
                                                </div>
                                                <div class="div">
                                                    <h5>Contraseña</h5>
                                                    <input id="password" type="password" name="password" required autocomplete="current-password" 
                                                        class="absolute w-full h-full py-2 px-3 outline-none inset-0 text-gray-700"
                                                        style="background:none;">
                                                </div>
                                            </div>

                                            

                                            <div class="flex items-center justify-end mt-4">
                                                
                                                @if (Route::has('password.request'))
                                                    <a class="text-xs text-black-400 hover:text-gray-400 float-right mb-4" href="{{ route('password.request') }}">
                                                        {{ __('
                                                        ¿Olvidaste tu contraseña?') }}
                                                    </a>
                                                @endif                            
                                            </div>

                                            <button type="submit"
                                             style="opacity: 100%; color: white; background-color: rgb(64, 128, 128)"
                                                class="w-60 rounded-full btn btn-info">{{ __('Iniciar sesión') }}
                                            </button>
                                        </form>
                                    @endauth
                            @endif
                        </div>
                    </div>    
                </div>
            </div>
    
            <script>
                const inputs = document.querySelectorAll("input");
        
        
                function addcl() {
                    let parent = this.parentNode.parentNode;
                    parent.classList.add("focus");
                }
        
                function remcl() {
                    let parent = this.parentNode.parentNode;
                    if (this.value == "") {
                        parent.classList.remove("focus");
                    }
                }
        
        
                inputs.forEach(input => {
                    input.addEventListener("focus", addcl);
                    input.addEventListener("blur", remcl);
                });
            </script>
    </body>
</html> --}}
