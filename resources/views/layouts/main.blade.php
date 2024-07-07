<!DOCTYPE html>
<html lang="en" class="scroll-smooth transition-all duration-300">

    <head>
        <script type='text/javascript' id="preloader">
            window.addEventListener('load', function() {
                document.querySelectorAll('#preloader').forEach(items => items.remove());
            });
        </script>
        {{-- Secure Page By Only Load With HTTPS --}}

        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="/img/favicon.svg" type="image/x-icon">
        <meta charset="utf-8">
        <link rel="stylesheet" href="/css/toastr.min.css" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
            integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
            integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.10/dist/cdn.min.js"></script>
        <style id="preloader">
            .spinner {
                animation: 1.4s linear infinite rotator
            }

            @keyframes rotator {
                0% {
                    transform: rotate(0)
                }

                100% {
                    transform: rotate(270deg)
                }
            }

            .path {
                stroke-dasharray: 187;
                stroke-dashoffset: 0;
                transform-origin: center;
                animation: 1.4s ease-in-out infinite dash, 5.6s ease-in-out infinite colors
            }

            @keyframes colors {

                0%,
                100% {
                    stroke: #4285F4
                }

                25% {
                    stroke: #DE3E35
                }

                50% {
                    stroke: #F7C223
                }

                75% {
                    stroke: #1B9A59
                }
            }

            @keyframes dash {
                0% {
                    stroke-dashoffset: 187
                }

                50% {
                    stroke-dashoffset: 46.75;
                    transform: rotate(135deg)
                }

                100% {
                    stroke-dashoffset: 187;
                    transform: rotate(450deg)
                }
            }
        </style>
       <script>
        toastr.options = {
            "closeButton": true,
            "newestOnTop": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "swing",
            "showMethod": "show",
            "hideMethod": "fadeOut"
        }
    </script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
        <meta name="description"
            content="E-voting SMKN 2 Sumedang adalah sebuah aplikasi web untuk melakukan Pemilihan Umum Ketua OSIS dan MPK di SMKN 2 Sumedang.">
        <meta name="keywords"
            content="sipentas, kumis, sipentaskumis, voting, osis, mpk, smkn2sumedang, smkn 2 sumedang, sekolah menengah kejuruan, smk negeri 2 sumedang, gridas, smea, sumedang, jawa barat, indonesia, indonesian">
        <title>@yield('title') | SIPENTAS KUMIS</title>
        @vite(['resources/js/app.js', 'resources/css/app.css'])
        @yield('head')
    </head>

    <body>
        <div x-transition.duration.300ms
            class="fixed flex flex-col items-center justify-center z-[999] bg-white w-full h-full" id="preloader">
            <svg class="spinner w-1/6 sm:w-[5%]" viewBox="0 0 66 66" xmlns="http://www.w3.org/2000/svg">
                <circle class="path" fill="none" stroke-width="6" stroke-linecap="round" cx="33"
                    cy="33" r="30"></circle>
            </svg>
        </div>

        <div>
            @yield('container')
        </div>
        <script>
            @if (session('kesalahan'))
                toastr.error(
                    `{!! session('kesalahan') !!}`
                )
            @endif
            @if (session('success'))
                toastr.success(
                    `{!! session('success') !!}`
                )
            @endif

            @foreach ($errors->all() as $error)
                toastr.error(`{!! $error !!}`)
            @endforeach
        </script>


    </body>

</html>
