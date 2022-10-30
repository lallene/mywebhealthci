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
    <link href="{{ asset("assets/css/style.css") }}" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="dashboard dashboard_1">
<div class="full_container">
    <div class="inner_container">
        <!-- Sidebar  -->
        <nav id="sidebar">
            <div class="sidebar_blog_1">
                <div class="sidebar-header">
                    <div class="logo_section">
                        <a href="{{ URL('/') }}">
                            <img class="logo_icon img-responsive" src="{{ asset('images/logo/logo.png') }}" alt="#" />
                        </a>
                    </div>
                </div>
                <div class="sidebar_user_info">
                    <div class="icon_setting"></div>
                    <div class="user_profle_side">
                        <div class="user_img"><img class="img-responsive" src="{{ asset('images/layout_img/user_img.jpg') }}" alt="#" /></div>
                        <div class="user_info">
                            <h6>{{ Auth::user()->name }}</h6>
                            <p><span class="online_animation"></span> Online</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="sidebar_blog_2">
                <h4>General</h4>
                <ul class="list-unstyled components">
                    <li><a href="{{ url('/') }}"><i class="fa fa-home orange_color"></i> <span>Accueil</span></a></li>

                    <li class="<?= (isset($menu) AND $menu == 'params') ? 'active' : '' ?>">
                        <a href="#params" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                            <i class="fa fa-key gs red_color"></i>
                            <span>Paramètres</span>
                        </a>
                        <ul class="collapse list-unstyled" id="params">
                            <li>
                                <a href="{{ route("permission.index") }}">> <span>Permissions</span></a>
                            </li>
                            <li>
                                <a href="{{ route("profil.index") }}">> <span>Profils Utilisateur</span></a>
                            </li>
                            <li>
                                <a href="{{ route("user.index") }}">> <span>Utilisateurs</span></a>
                            </li>
                        </ul>
                    </li>

                    <li class="<?= (isset($menu) AND $menu == 'config') ? 'active' : '' ?>">
                        <a href="#config" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                            <i class="fa fa-cogs gs yellow_color"></i>
                            <span>Configuration</span>
                        </a>
                        <ul class="collapse list-unstyled" id="config">
                            <li>
                                <a href="{{ route("societe.index") }}">> <span>Sociétés</span></a>
                            </li>
                            <li>
                                <a href="{{ route("site.index") }}">> <span>Sites</span></a>
                            </li>
                            <li>
                                <a href="{{ route("famille.index") }}">> <span>Familles d'emploi</span></a>
                            </li>
                            <li>
                                <a href="{{ route("emploi.index") }}">> <span>Emplois</span></a>
                            </li>
                            <li>

                                <a href="{{ route("fonction.index") }}">> <span>Fonctions</span></a>
                            </li>
                            <li>
                                <a href="{{ route("sub_fonction.index") }}">> <span>Sous-Fonctions</span></a>
                            </li>
                            <li>
                                <a href="{{ route("agent_sante.index") }}">> <span>Agents de santés</span></a>
                            </li>
                            <li>
                                <a href="{{ route("maladie_prof.index") }}">> <span>Maladies Professionnelles</span></a>
                            </li>
                            <li>
                                <a href="{{ route("maladie_contagieuse.index") }}">> <span>Maladies contagieuses</span></a>
                            </li>
                            <li>
                                <a href="{{ route("motif_consultation.index") }}">> <span>Motifs de consultations</span></a>
                            </li>
                            <a href="{{ route("typecontrat.index") }}">> <span>Types de Contrat</span></a>
                            </li>
                            <li>
                                <a href="{{ route("projet.index") }}">> <span>Projets</span></a>
                            </li>
                            <li>
                                <a href="{{ route("consultation.index") }}">> <span>Consultation</span></a>
                            </li>
                            <li>
                                <a href="{{ route("justificatif_externe.index") }}">> <span>Justificatifs externes</span></a>
                            </li>

                                <a href="{{ route("effectif.index") }}">> <span>Effectif</span></a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
        <!-- end sidebar -->
        <!-- right content -->
        <div id="content">
            <!-- topbar -->
            <div class="topbar">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <div class="full">
                        <button type="button" id="sidebarCollapse" class="sidebar_toggle"><i class="fa fa-bars"></i></button>
                        <div class="logo_section">
                            <!-- <a href="index.html"><img class="img-responsive" src="images/logo/logo.png" alt="#" /></a> -->
                        </div>
                        <div class="right_topbar">
                            <div class="icon_info">
                                <ul>
                                    <li><a href="#"><i class="fa fa-bell-o"></i><span class="badge">2</span></a></li>
                                    <li><a href="#"><i class="fa fa-question-circle"></i></a></li>
                                    <li><a href="#"><i class="fa fa-envelope-o"></i><span class="badge">3</span></a></li>
                                </ul>
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
                @yield('content')
                <!-- footer -->
                <div class="container-fluid">
                    <div class="footer">
                        <p>Copyright © 2022 Designed by <a target="_blank" href="https://www.facebook.com/coolmalick2/">M.C</a>. Tous droits réservés.<br><br>
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
</script>
</body>
</html>
