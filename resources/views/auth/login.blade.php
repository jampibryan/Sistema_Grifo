
<!DOCTYPE html>
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
                background: url(data:image/jpeg;base64,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) no-repeat center center fixed;
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
                                <span style="font-family: fantasy; font-size: 50px; color: #af3415; line-height: 40px">Estación Grifo Primax</span>
                                <img style="filter: brightness(1.1); mix-blend-mode: multiply; margin:auto; width: 200px" src="data:image/png;base64,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" alt="">    
                            </div>
                            {{-- <div class="row mx-auto" style="width: 250px">
                                <div class="mb-2"><label for="" style="font-family: fantasy">Redes</label><br></div>
                                
                                <div class="col">
                                    <a href="">
                                        <img width="30px" src="https://cdn-icons-png.flaticon.com/512/174/174848.png" alt="">
                                    </a>
                                </div>
                                <div class="col">
                                    <a href="">
                                        <img width="30px" src="https://cdn-icons-png.flaticon.com/512/174/174855.png" alt="">
                                    </a>
                                </div>
                                
                                <div class="col">
                                    <a href="">
                                        <img width="30px" src="https://cdn-icons-png.flaticon.com/512/174/174876.png" alt="">
                                    </a>
                                </div>
                                <div class="col">
                                    <a href="">
                                        <img width="30px" src="https://cdn-icons-png.flaticon.com/512/174/174879.png" alt="">
                                    </a>
                                </div>
                                <hr class="row mt-2">
                            </div> --}}
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
                                                    {{-- src="https://raw.githubusercontent.com/sefyudem/Responsive-Login-Form/master/img/avatar.svg"> --}}
                                                    src="https://previews.123rf.com/images/tuktukdesign/tuktukdesign1706/tuktukdesign170600142/81056151-icono-del-trabajador-de-la-construcci%C3%B3n-persona-vectorial-perfil-avatar-en-glyph-pictograma-ilustrac.jpg">
                                            </div>

                                            <h2 class="text-3xl text-center text-gray-700 mb-4" style="font-weight: bold">BIENVENIDO</h2>

                                            <div class="input-div border-b-2 relative grid my-4 py-1 focus:outline-none" style="grid-template-columns: 7% 93%;">
                                                <div class="i">
                                                    <i class="fas fa-user"></i>
                                                </div>
                                                <div class="div">
                                                    <h5>Email</h5>
                                                    <input id="email" type="email" name="email" required class="absolute w-full h-full py-2 px-3 outline-none inset-0 text-orange-600"
                                                        style="background:none;" >
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
                                                        class="absolute w-full h-full py-2 px-3 outline-none inset-0 text-orange-600"
                                                        style="background:none;">
                                                </div>
                                            </div>

                                            

                                            <div class="flex items-center mt-4 row">
                                                
                                                <div class="col-6">
                                                    @error('email')
                                                        <span style="color: #ff7300">* Correo y/o contraseña incorrecta!</span>
                                                    @enderror
                                                </div>

                                                @if (Route::has('password.request'))
                                                <div class="col-6">
                                                    <a class="text-xs text-black-400 hover:text-gray-600 float-right mb-4" href="{{ route('password.request') }}">
                                                        {{ __('
                                                        ¿Olvidaste tu contraseña?') }}
                                                    </a>
                                                </div>
                                                @endif                            
                                            </div>

                                            <button type="submit"
                                             style="opacity: 100%; color: white; background-color: #E06B09; border:#E4A81A"
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
</html>
