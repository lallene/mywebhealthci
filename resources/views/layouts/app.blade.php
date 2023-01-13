<!DOCTYPE html>
<html lang="en">
<head>
    <!-- basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- mobile metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <!-- site metas -->
    <title>{{ $titre ?? '' }}</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- site icon -->
    <link rel="icon" href="images/favicon.png" type="image/png" />
    <!-- bootstrap css -->
    <link rel="stylesheet" href="{{ asset("assets/css/bootstrap.min.css") }}" />
    <!-- site css -->
    <link rel="stylesheet" href="{{ asset("assets/style.css") }}" />
    <!-- responsive css -->
    <link rel="stylesheet" href="{{ asset("assets/css/responsive.css") }}" />
    <!-- color css
    <link rel="stylesheet" href="{{ asset("assets/css/color_2.css") }}" />-->
    <!-- select bootstrap -->
    {{--<link rel="stylesheet" href="{{ asset("assets/css/bootstrap-select.css") }}" />--}}
    <!-- scrollbar css -->
    <link rel="stylesheet" href="{{ asset("assets/css/perfect-scrollbar.css") }}" />
    <!-- custom css -->
    <link rel="stylesheet" href="{{ asset("assets/css/custom.css") }}" />

    <link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="{{ asset("assets/bootstrap/css/bootstrap.min.css") }}" rel="stylesheet">
    <link href="{{ asset("assets/bootstrap-icons/bootstrap-icons.css") }}" rel="stylesheet">


    <meta name="viewport" content="width=device-width, initial-scale=1"><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
    <link rel="stylesheet" href="{{ asset("assets/css/nav.css") }}">


    @yield('link')

    <style>
        /* Style the buttons */
        .btnselected {
          border: none;
          outline: none;
          padding: 70px 16px;
          background-color: #0606063b;;
          cursor: pointer;
          font-size: 25px;
        }

        /* Style the active class, and buttons on mouse-over */
        .active, .btnselected:hover {
          background-color: #cc326254;;
          color: white;
        }
        </style>

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="dashboard dashboard_1">
    <div class="full_container">
        <div class="inner_container">
            <!-- Sidebar  -->


               - <!-- partial:index.partial.html -->
               <header>
                   <section id="desktop-menu" class="desktop-menu">
                       <nav class="sidebar flex-column-nowrap">
                           <a class="sidebar__logo" href="{{ URL('/') }}">
                               <abbr class="logo">WH</abbr>
                           </a>
                           @role('RH Manager')
                           <ul class="sidebar__extra-content" role="menu">

                            <li class="extra-content__language" role="menuitem">
                                <svg height="39.999043" width="40.000126" viewBox="0 0 1.1718787 1.1718469" role="img" aria-labelledby="Language"><path d="M 1.1704687,0.546847 C 1.15125,0.254347 0.9175,0.020519 0.625,0.0013 V 0 H 0.5859375 0.546875 V 0.0013 C 0.254375,0.020519 0.02054688,0.254347 0.00132813,0.546847 H 0 v 0.03906 0.03906 H 0.00132813 C 0.02054688,0.917467 0.254375,1.151217 0.546875,1.170436 v 0.00141 H 0.5859375 0.625 v -0.0014 C 0.9175,1.151227 1.15125,0.917478 1.1704687,0.624978 h 0.00141 V 0.58591 0.546847 Z M 0.36679688,0.127706 c -0.0377344,0.05016 -0.0690625,0.113047 -0.091875,0.184766 H 0.15789063 C 0.20882813,0.233022 0.28117188,0.168722 0.36679688,0.127706 Z M 0.11703125,0.390597 H 0.254375 C 0.2439062,0.439967 0.2372656,0.492394 0.2351562,0.546847 H 0.07960937 C 0.08375,0.491847 0.09671875,0.439269 0.11703125,0.390597 Z M 0.07960937,0.624972 h 0.15554688 c 0.002109,0.05445 0.00875,0.106875 0.0192188,0.15625 H 0.11703125 C 0.09671875,0.73255 0.08375,0.679972 0.07960937,0.624972 Z m 0.07828126,0.234375 h 0.11695312 c 0.0228125,0.07172 0.0541406,0.134609 0.0919531,0.184766 C 0.28117188,1.003097 0.20882813,0.938878 0.15789063,0.859347 Z M 0.546875,1.088722 C 0.4665625,1.067238 0.39742188,0.980988 0.35546875,0.859347 H 0.546875 Z m 0,-0.3075 H 0.33351562 C 0.3225,0.73255 0.31554688,0.679972 0.31328125,0.624972 H 0.546875 Z m 0,-0.234375 H 0.31328125 c 0.002266,-0.055 0.009219,-0.107578 0.0202344,-0.15625 H 0.546875 Z m 0,-0.234375 H 0.35546875 C 0.39742188,0.190831 0.4665625,0.104581 0.546875,0.083175 Z m 0.4671094,0 H 0.89710938 C 0.87421878,0.240752 0.84296878,0.177863 0.80507808,0.127706 0.89062498,0.168726 0.96304683,0.233019 1.0139844,0.312472 Z M 0.625,0.083175 c 0.0802344,0.02141 0.14945312,0.107656 0.19140625,0.229297 H 0.625 Z m 0,0.307422 h 0.21328125 c 0.0110938,0.048672 0.0178906,0.10125 0.0203125,0.15625 H 0.625 Z m 0,0.234375 h 0.23359375 c -0.002266,0.055 -0.009219,0.107578 -0.0203125,0.15625 H 0.625 Z m 0,0.46375 V 0.859347 H 0.81640625 C 0.77445312,0.980988 0.70523437,1.067238 0.625,1.088722 Z m 0.18007812,-0.04461 c 0.0377344,-0.05023 0.0691406,-0.113047 0.0920313,-0.184766 H 1.0139844 C 0.9630469,0.938876 0.890625,1.003096 0.80507812,1.044112 Z M 1.0548437,0.781222 H 0.9175 C 0.9279688,0.731852 0.9346094,0.679425 0.9367188,0.624972 h 0.1554687 c -0.00406,0.055 -0.017031,0.107578 -0.037344,0.15625 z M 0.93671875,0.546847 c -0.002109,-0.05445 -0.00875,-0.106875 -0.0192188,-0.15625 H 1.0548436 c 0.020312,0.04867 0.033281,0.10125 0.037422,0.15625 z" id="path2" style="fill:#c6c6c6;stroke-width:0.078125" /></svg><svg height="17.021526" width="9.999999" viewBox="0 0 9.6094522 16.356756"><g transform="matrix(0.03324517,0,0,0.03324517,-3.3736534,0)" id="g6"><path style="fill:#c6c6c6" id="path2" d="M 382.678,226.804 163.73,7.86 C 158.666,2.792 151.906,0 144.698,0 137.49,0 130.73,2.792 125.666,7.86 l -16.124,16.12 c -10.492,10.504 -10.492,27.576 0,38.064 L 293.398,245.9 109.338,429.96 c -5.064,5.068 -7.86,11.824 -7.86,19.028 0,7.212 2.796,13.968 7.86,19.04 l 16.124,16.116 c 5.068,5.068 11.824,7.86 19.032,7.86 7.208,0 13.968,-2.792 19.032,-7.86 L 382.678,265 c 5.076,-5.084 7.864,-11.872 7.848,-19.088 0.016,-7.244 -2.772,-14.028 -7.848,-19.108 z" /></g></svg>
                                <span class="u-uppercase">CONFIGURATION</span>
                                <ul class="extra-content__language-selector flex-column-nowrap" aria-label="submenu" aria-hidden="true" aria-expanded="false" aria-haspopup="true">
                                    <li class="language-selector__item u-uppercase ca" role="menuitem">
                                        <a href="{{ route("projet.index") }}" tabindex="-1">
                                            <span class="u-uppercase">PROJETS</span>
                                        </a>
                                    </li>

                                    <li class="language-selector__item u-uppercase es" role="menuitem">
                                        <a href="{{ route("effectif.index") }}" tabindex="-1">
                                            <span class="u-uppercase">EFFECTIFS</span>
                                        </a>
                                    </li>
                                    <li class="language-selector__item u-uppercase es" role="menuitem">
                                        <a href="{{ route("sub_fonction.index") }}" tabindex="-1">
                                            <span class="u-uppercase">FONCTIONS</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                        @endrole

                           <ul class="sidebar__nav-list flex-column-nowrap" role="menubar" aria-label="Main desktop menu">


                        @role('Agent de santé')
                               <li class="nav-list__item my-work fake-button flex-column-nowrap" role="menuitem">
                                   <a class="flex-row-wrap" href="{{ route("consultation.index") }}" tabindex="0">
                                       <svg viewBox="0 0 40 25" height="25" width="40" role="img" aria-labelledby="My work"><path d="M 20,0 C 11.276641,0 3.7155469,5.0797656 0,12.5 3.7155469,19.920234 11.276641,25 20,25 28.723125,25 36.284297,19.920234 40,12.5 36.284453,5.0797656 28.723125,0 20,0 Z m 9.861328,6.6290625 C 32.211484,8.1280469 34.202891,10.135859 35.69875,12.5 34.202969,14.864141 32.211328,16.871953 29.861328,18.370938 26.908437,20.254453 23.498359,21.25 20,21.25 16.501562,21.25 13.091563,20.254453 10.138672,18.370938 7.7886719,16.871875 5.7972656,14.864062 4.3014063,12.5 5.7971875,10.135781 7.7886719,8.1279688 10.138672,6.6290625 10.291719,6.5314062 10.446328,6.4367969 10.601875,6.3439062 10.212891,7.4114063 10,8.5635156 10,9.765625 c 0,5.522734 4.477187,10 10,10 5.522734,0 10,-4.477266 10,-10 0,-1.2021094 -0.212891,-2.3542188 -0.601797,-3.4217969 0.155313,0.092891 0.310078,0.1875781 0.463125,0.2852344 z M 20,8.515625 c 0,2.071094 -1.678906,3.75 -3.75,3.75 -2.071094,0 -3.75,-1.678906 -3.75,-3.75 0,-2.0710937 1.678906,-3.75 3.75,-3.75 2.071094,0 3.75,1.6789063 3.75,3.75 z" id="path2" class="path" style="fill:#c6c6c6;stroke-width:0.8;stroke:#1B1D1D;" /></svg>
                                       <span class="u-uppercase">Consultation</span>
                                   </a>
                               </li>
                           </ul>
                           @endrole

                           <ul class="sidebar__extra-content" role="menu" style="margin-bottom: 62PX;">
                            @role('IT')
                               <li class="extra-content__language" role="menuitem">
                                <svg height="39.999043" width="40.000126" viewBox="0 0 1.1718787 1.1718469" role="img" aria-labelledby="About me"><path d="M 1.1704687,0.546847 C 1.15125,0.254347 0.9175,0.020519 0.625,0.0013 V 0 H 0.5859375 0.546875 V 0.0013 C 0.254375,0.020519 0.02054688,0.254347 0.00132813,0.546847 H 0 v 0.03906 0.03906 H 0.00132813 C 0.02054688,0.917467 0.254375,1.151217 0.546875,1.170436 v 0.00141 H 0.5859375 0.625 v -0.0014 C 0.9175,1.151227 1.15125,0.917478 1.1704687,0.624978 h 0.00141 V 0.58591 0.546847 Z M 0.36679688,0.127706 c -0.0377344,0.05016 -0.0690625,0.113047 -0.091875,0.184766 H 0.15789063 C 0.20882813,0.233022 0.28117188,0.168722 0.36679688,0.127706 Z M 0.11703125,0.390597 H 0.254375 C 0.2439062,0.439967 0.2372656,0.492394 0.2351562,0.546847 H 0.07960937 C 0.08375,0.491847 0.09671875,0.439269 0.11703125,0.390597 Z M 0.07960937,0.624972 h 0.15554688 c 0.002109,0.05445 0.00875,0.106875 0.0192188,0.15625 H 0.11703125 C 0.09671875,0.73255 0.08375,0.679972 0.07960937,0.624972 Z m 0.07828126,0.234375 h 0.11695312 c 0.0228125,0.07172 0.0541406,0.134609 0.0919531,0.184766 C 0.28117188,1.003097 0.20882813,0.938878 0.15789063,0.859347 Z M 0.546875,1.088722 C 0.4665625,1.067238 0.39742188,0.980988 0.35546875,0.859347 H 0.546875 Z m 0,-0.3075 H 0.33351562 C 0.3225,0.73255 0.31554688,0.679972 0.31328125,0.624972 H 0.546875 Z m 0,-0.234375 H 0.31328125 c 0.002266,-0.055 0.009219,-0.107578 0.0202344,-0.15625 H 0.546875 Z m 0,-0.234375 H 0.35546875 C 0.39742188,0.190831 0.4665625,0.104581 0.546875,0.083175 Z m 0.4671094,0 H 0.89710938 C 0.87421878,0.240752 0.84296878,0.177863 0.80507808,0.127706 0.89062498,0.168726 0.96304683,0.233019 1.0139844,0.312472 Z M 0.625,0.083175 c 0.0802344,0.02141 0.14945312,0.107656 0.19140625,0.229297 H 0.625 Z m 0,0.307422 h 0.21328125 c 0.0110938,0.048672 0.0178906,0.10125 0.0203125,0.15625 H 0.625 Z m 0,0.234375 h 0.23359375 c -0.002266,0.055 -0.009219,0.107578 -0.0203125,0.15625 H 0.625 Z m 0,0.46375 V 0.859347 H 0.81640625 C 0.77445312,0.980988 0.70523437,1.067238 0.625,1.088722 Z m 0.18007812,-0.04461 c 0.0377344,-0.05023 0.0691406,-0.113047 0.0920313,-0.184766 H 1.0139844 C 0.9630469,0.938876 0.890625,1.003096 0.80507812,1.044112 Z M 1.0548437,0.781222 H 0.9175 C 0.9279688,0.731852 0.9346094,0.679425 0.9367188,0.624972 h 0.1554687 c -0.00406,0.055 -0.017031,0.107578 -0.037344,0.15625 z M 0.93671875,0.546847 c -0.002109,-0.05445 -0.00875,-0.106875 -0.0192188,-0.15625 H 1.0548436 c 0.020312,0.04867 0.033281,0.10125 0.037422,0.15625 z" id="path2" style="fill:#c6c6c6;stroke-width:0.078125" /></svg><svg height="17.021526" width="9.999999" viewBox="0 0 9.6094522 16.356756"><g transform="matrix(0.03324517,0,0,0.03324517,-3.3736534,0)" id="g6"><path style="fill:#c6c6c6" id="path2" d="M 382.678,226.804 163.73,7.86 C 158.666,2.792 151.906,0 144.698,0 137.49,0 130.73,2.792 125.666,7.86 l -16.124,16.12 c -10.492,10.504 -10.492,27.576 0,38.064 L 293.398,245.9 109.338,429.96 c -5.064,5.068 -7.86,11.824 -7.86,19.028 0,7.212 2.796,13.968 7.86,19.04 l 16.124,16.116 c 5.068,5.068 11.824,7.86 19.032,7.86 7.208,0 13.968,-2.792 19.032,-7.86 L 382.678,265 c 5.076,-5.084 7.864,-11.872 7.848,-19.088 0.016,-7.244 -2.772,-14.028 -7.848,-19.108 z" /></g></svg>
                                <span class="u-uppercase">PARAMETRES</span>
                                <ul class="extra-content__language-selector flex-column-nowrap" aria-label="submenu" aria-hidden="true" aria-expanded="false" aria-haspopup="true">
                                    <li class="language-selector__item u-uppercase ca" role="menuitem">
                                        <a href="{{ route("permission.index") }}" tabindex="-1">
                                            <span class="u-uppercase">Permission</span>
                                        </a>
                                    </li>
                                    <li class="language-selector__item u-uppercase es" role="menuitem">
                                        <a href="{{ route("profil.index") }}" tabindex="-1">
                                            <span class="u-uppercase">Profils utilisateurs</span>
                                        </a>
                                    </li>
                                    <li class="language-selector__item u-uppercase eng " role="menuitem">
                                        <a href="{{ route("user.index") }}" tabindex="-1">
                                            <span class="u-uppercase">Utilisateurs</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            @endrole
                           </ul>

                       </nav>
                   </section>

               </header>
               <!-- partial -->

            <!-- end sidebar -->
            <!-- right content -->
            <div id="content">
                <!-- topbar -->
                <div class="topbar">
                    <nav class="navbar navbar-expand-lg navbar-light">
                        <div class="full">

                            <div class="logo_section">
                                <!-- <a href="index.html"><img class="img-responsive" src="images/logo/logo.png" alt="#" /></a> -->
                            </div>
                            <div class="right_topbar">
                                <div class="icon_info">
                                    <img class="img-responsive" src="{{ asset('images/logo/logo.png') }}" alt="#" style="width: 100PX; HEIGHT:70PX" />
                                    <ul class="user_profile_dd">
                                        <li>
                                            <a class="dropdown-toggle" data-toggle="dropdown">
                                                <img class="img-responsive rounded-circle" src="{{ asset('images/layout_img/user_img.jpg') }}" alt="#" />
                                                <span class="name_user">{{ Auth::user()->name }}</span>

                                            </a>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item d-none" href="profile.html">My Profile</a>
                                                <a class="dropdown-item" href="{{ route('logout') }}"
                                                   onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                                    <span>Log Out</span> <i class="fa fa-sign-out"></i>
                                                </a>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </nav>
                </div>
                <!-- end topbar -->
                <!-- dashboard inner -->
                <div class="midde_cont">
                    @include('message')
                    @yield('content')
                    <!-- footer -->
                    <div class="container-fluid">
                        <div class="footer">
                            <p>Copyright © 2022 Designed by <a target="_blank" href="#">Webhelp Côte d'Ivoire</a></a>. Tous droits réservés.<br><br>
                            </p>
                        </div>
                    </div>
                </div>
                <!-- end dashboard inner -->
            </div>
        </div>
    </div>




<form action="{{ route('logout') }}" method="POST" id="logout-form">
    @csrf
</form>

<!-- jQuery -->
<script src="{{ asset("assets/js/jquery.min.js") }}"></script>
<script src="{{ asset("assets/js/popper.min.js") }}"></script>
<script src="{{ asset("assets/js/bootstrap.min.js") }}"></script>
<!-- wow animation -->
<script src="{{ asset("assets/js/animate.js") }}"></script>
<!-- select country -->
{{--<script src="{{ asset("assets/js/bootstrap-select.js") }}"></script>--}}
<!-- owl carousel -->
{{--<script src="{{ asset("assets/js/owl.carousel.js") }}"></script>--}}
<!-- chart js -->
{{--<script src="{{ asset("assets/js/Chart.min.js") }}"></script>--}}
{{--<script src="{{ asset("assets/js/Chart.bundle.min.js") }}"></script>--}}
{{--<script src="{{ asset("assets/js/utils.js") }}"></script>--}}
{{--<script src="{{ asset("assets/js/analyser.js") }}"></script>--}}
<!-- nice scrollbar -->
<!-- partial -->
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js'>
</script><script  src="{{ asset("assets/js/nav.js") }}"></script>

<script src="{{ asset("assets/js/perfect-scrollbar.min.js") }}"></script>
<script>
    var ps = new PerfectScrollbar('#sidebar');
</script>
<!-- custom js -->
<script src="{{ asset("assets/js/custom.js") }}"></script>
<script src="https://code.jquery.com/jquery-3.6.1.slim.min.js" integrity="sha256-w8CvhFs7iHNVUtnSP0YKEg00p9Ih13rlL9zGqvLdePA=" crossorigin="anonymous"></script>
<script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<!-- Axios for Ajax Requests -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.27.2/axios.min.js" integrity="sha512-odNmoc1XJy5x1TMVMdC7EMs3IVdItLPlCeL5vSUPN2llYKMJ2eByTTAIiiuqLg+GdNr9hF6z81p27DArRFKT7A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="{{ asset("assets/bootstrap/js/bootstrap.bundle.min.js") }}"></script>
@yield('script')
<script>
    $(document).ready( function () {
        $('#zero_config').DataTable();

        $('.select2').select2();
    });

            // Add active class to the current button (highlight it)
        var header = document.getElementById("selectedactive");
        var btns = header.getElementsByClassName("btn");
        for (var i = 0; i < btns.length; i++) {
        btns[i].addEventListener("click", function() {
        var current = document.getElementsByClassName("active");
        current[0].className = current[0].className.replace(" active", "");
        this.className += " active";
        });
        }
</script>
</body>
</html>
