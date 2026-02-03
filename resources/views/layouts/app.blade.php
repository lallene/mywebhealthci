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
    <link rel="icon" href="{{ asset("/images/logo/favicon.ico") }}" />
    <!-- site icon -->
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
    <!-- custom css -->
    <link rel="stylesheet" href="{{ asset("assets/css/custom.css") }}" />

    <link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="{{ asset("assets/bootstrap/css/bootstrap.min.css") }}" rel="stylesheet">
    <link href="{{ asset("assets/bootstrap-icons/bootstrap-icons.css") }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">


    <meta name="viewport" content="width=device-width, initial-scale=1"><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
    <link rel="stylesheet" href="{{ asset("assets/css/nav.css") }}">

    @yield('link')

    <style>
        .nav-link-fixed-size {
    min-width: 250px; /* largeur minimale uniforme */
    height: 60px;     /* hauteur uniforme */
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
}
.nav-link-fixed-size .nav-link {
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
}

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
          color: #cc3262;
        }


    /* Style du menu */
    .navbar-nav .nav-item {
        margin-right: 15px; /* Espacement entre les liens */
    }

    .navbar-nav .nav-link {
        color: white !important;
        background-color: #cc3262;
        padding: 10px 15px;
        border-radius: 20px;
        transition: background 0.3s ease-in-out, transform 0.2s;
    }

    /* Effet hover */
    .navbar-nav .nav-link:hover {
        background-color: #0056b3;
        transform: scale(1.05);
    }

    /* Indicateur de lien actif */
    .navbar-nav .nav-link.active {
        background-color: #25dac6;
        border-bottom: 3px solid white;
    }
        </style>
        <style>
            /* Style personnalisé pour la barre de navigation */
            .navbar-dark {
                background-color:#1d4750 !important;
            }

            .navbar-nav .nav-link {
                color: #fff;
                font-size: 16px;
                font-weight: 500;
                padding-left: 20px;
                padding-right: 20px;
                transition: all 0.3s ease;
            }

            .navbar-nav .nav-link:hover {
                color: #198754;
                background-color: #25dac6;
                border-radius: 4px;
            }

            .navbar-nav .nav-link.active {
                color: #198754 !important;
            }

            .navbar-nav .nav-link i {
                font-size: 18px;
            }

            .dropdown-menu {
                background-color: #343a40;
                border-radius: 5px;
            }

            .dropdown-item {
                color: #fff;
                transition: all 0.3s ease;
            }

            .dropdown-item:hover {
                background-color: #198754;
                color: white;
            }

            .navbar-toggler-icon {
                background-color: #fff;
            }

            .navbar-nav .user_profile_dd {
                list-style: none;
                padding-left: 0;
            }

            .navbar-nav .user_profile_dd .dropdown-toggle {
                font-size: 16px;
            }

            .user_profile_dd .dropdown-item {
                font-size: 15px;
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
                        <a class="sidebar__logo" href="{{ URL('/home') }}">
                            <abbr class="logo">CNX</abbr>
                        </a>
                        @hasanyrole(['Ressources Humaines', 'IT'])
                           <ul class="sidebar__nav-list flex-column-nowrap" role="menubar" aria-label="Main desktop menu">

                            <li class="nav-list__item skills fake-button flex-column-nowrap {{ request()->is('projet') ? 'active' : '' }}" role="menuitem">
                                <form action="{{ route('projet.index') }}" method="GET">
                                    <button type="submit" class="flex items-center gap-2 px-4 py-2 rounded-md text-white bg-pink-600 hover:bg-pink-700 transition duration-200 w-full shadow-md" style="background-color: #cc3262;">
                                        <svg viewBox="0 0 32.265313 27.8375" height="24" width="28" role="img" aria-labelledby="Skills" xmlns="http://www.w3.org/2000/svg" class="shrink-0">
                                            <g id="g4547">
                                                <path style="fill:#fff;stroke-width:0.3;stroke:#1B1D1D;" d="M 30.702812,0 H 1.5625 C 0.69945313,0 0,0.69953 0,1.5625 v 18.28125 c 0,0.86297 0.69945313,1.5625 1.5625,1.5625 h 10.898281 v 3.54063 H 8.2199219 c -0.7969532,0 -1.4453125,0.64835 -1.4453125,1.44531 0,0.79695 0.6483593,1.44531 1.4453125,1.44531 H 24.045391 c 0.796953,0 1.445312,-0.64836 1.445312,-1.44531 0,-0.79696 -0.648359,-1.44531 -1.445312,-1.44531 h -4.24086 v -3.54063 h 10.898281 c 0.863047,0 1.5625,-0.69953 1.5625,-1.5625 V 1.5625 C 32.265312,0.69953 31.565859,0 30.702812,0 Z m -0.78125,19.0625 H 2.34375 V 2.34375 h 27.577812 z" />
                                            </g>
                                        </svg>
                                        <span class="uppercase font-semibold">Importation Projets</span>
                                    </button>
                                </form>
                            </li>
                            <li class="nav-list__item skills fake-button flex-column-nowrap {{ request()->is('effectif') ? 'active' : '' }}" role="menuitem">
                                <form action="{{ route('effectifs') }}" method="GET">
                                    <button type="submit" class="flex items-center gap-2 px-4 py-2 rounded-md text-white bg-pink-600 hover:bg-pink-700 transition duration-200 w-full" style="background-color: #cc3262;">
                                        <svg viewBox="0 0 32.265313 27.8375" height="24" width="28" role="img" aria-labelledby="Skills" xmlns="http://www.w3.org/2000/svg" class="shrink-0">
                                            <g id="g4547">
                                                <path style="fill:#fff;stroke-width:0.3;stroke:#1B1D1D;" d="M 30.702812,0 H 1.5625 C 0.69945313,0 0,0.69953 0,1.5625 v 18.28125 c 0,0.86297 0.69945313,1.5625 1.5625,1.5625 h 10.898281 v 3.54063 H 8.2199219 c -0.7969532,0 -1.4453125,0.64835 -1.4453125,1.44531 0,0.79695 0.6483593,1.44531 1.4453125,1.44531 H 24.045391 c 0.796953,0 1.445312,-0.64836 1.445312,-1.44531 0,-0.79696 -0.648359,-1.44531 -1.445312,-1.44531 h -4.24086 v -3.54063 h 10.898281 c 0.863047,0 1.5625,-0.69953 1.5625,-1.5625 V 1.5625 C 32.265312,0.69953 31.565859,0 30.702812,0 Z m -0.78125,19.0625 H 2.34375 V 2.34375 h 27.577812 z" />
                                            </g>
                                        </svg>
                                        <span class="uppercase font-semibold">Importation Effectif</span>
                                    </button>
                                </form>
                            </li>
                            <li class="nav-list__item skills fake-button flex-column-nowrap {{ request()->is('medications') ? 'active' : '' }}" role="menuitem">
                                <form action="{{ route('medications') }}" method="GET">
                                    <button type="submit" class="flex items-center gap-2 px-4 py-2 rounded-md text-white bg-pink-600 hover:bg-pink-700 transition duration-200 w-full shadow-md" style="background-color: #cc3262;">
                                        <svg viewBox="0 0 32.265313 27.8375" height="24" width="28" role="img" aria-labelledby="Skills" xmlns="http://www.w3.org/2000/svg" class="shrink-0">
                                            <g id="g4547">
                                                <path style="fill:#fff;stroke-width:0.3;stroke:#1B1D1D;" d="M 30.702812,0 H 1.5625 C 0.69945313,0 0,0.69953 0,1.5625 v 18.28125 c 0,0.86297 0.69945313,1.5625 1.5625,1.5625 h 10.898281 v 3.54063 H 8.2199219 c -0.7969532,0 -1.4453125,0.64835 -1.4453125,1.44531 0,0.79695 0.6483593,1.44531 1.4453125,1.44531 H 24.045391 c 0.796953,0 1.445312,-0.64836 1.445312,-1.44531 0,-0.79696 -0.648359,-1.44531 -1.445312,-1.44531 h -4.24086 v -3.54063 h 10.898281 c 0.863047,0 1.5625,-0.69953 1.5625,-1.5625 V 1.5625 C 32.265312,0.69953 31.565859,0 30.702812,0 Z m -0.78125,19.0625 H 2.34375 V 2.34375 h 27.577812 z" />
                                            </g>
                                        </svg>
                                        <span class="uppercase font-semibold">Importation Medicaments</span>
                                    </button>
                                </form>
                            </li>
                            <li class="nav-list__item skills fake-button flex-column-nowrap {{ request()->is('stocks') ? 'active' : '' }}" role="menuitem">
                                <form action="{{ route('stocks') }}" method="GET">
                                    <button type="submit" class="flex items-center gap-2 px-4 py-2 rounded-md text-white bg-pink-600 hover:bg-pink-700 transition duration-200 w-full shadow-md" style="background-color: #cc3262;">
                                        <svg viewBox="0 0 32.265313 27.8375" height="24" width="28" role="img" aria-labelledby="Skills" xmlns="http://www.w3.org/2000/svg" class="shrink-0">
                                            <g id="g4547">
                                                <path style="fill:#fff;stroke-width:0.3;stroke:#1B1D1D;" d="M 30.702812,0 H 1.5625 C 0.69945313,0 0,0.69953 0,1.5625 v 18.28125 c 0,0.86297 0.69945313,1.5625 1.5625,1.5625 h 10.898281 v 3.54063 H 8.2199219 c -0.7969532,0 -1.4453125,0.64835 -1.4453125,1.44531 0,0.79695 0.6483593,1.44531 1.4453125,1.44531 H 24.045391 c 0.796953,0 1.445312,-0.64836 1.445312,-1.44531 0,-0.79696 -0.648359,-1.44531 -1.445312,-1.44531 h -4.24086 v -3.54063 h 10.898281 c 0.863047,0 1.5625,-0.69953 1.5625,-1.5625 V 1.5625 C 32.265312,0.69953 31.565859,0 30.702812,0 Z m -0.78125,19.0625 H 2.34375 V 2.34375 h 27.577812 z" />
                                            </g>
                                        </svg>
                                        <span class="uppercase font-semibold">Stocks medocs</span>
                                    </button>
                                </form>
                            </li>

                        </ul>


                        @endhasanyrole



                           <ul class="sidebar__nav-list flex-column-nowrap" role="menubar" aria-label="Main desktop menu">


                        @role('Corps médical')
                               <li class="nav-list__item my-work fake-button flex-column-nowrap {{ request()->is('agents') ? 'active' : '' }}" role="menuitem">
                                   <a class="flex-row-wrap " href="{{ route("newconsultation") }}" tabindex="0">
                                       <svg viewBox="0 0 40 25" height="25" width="40" role="img" aria-labelledby="My work"><path d="M 20,0 C 11.276641,0 3.7155469,5.0797656 0,12.5 3.7155469,19.920234 11.276641,25 20,25 28.723125,25 36.284297,19.920234 40,12.5 36.284453,5.0797656 28.723125,0 20,0 Z m 9.861328,6.6290625 C 32.211484,8.1280469 34.202891,10.135859 35.69875,12.5 34.202969,14.864141 32.211328,16.871953 29.861328,18.370938 26.908437,20.254453 23.498359,21.25 20,21.25 16.501562,21.25 13.091563,20.254453 10.138672,18.370938 7.7886719,16.871875 5.7972656,14.864062 4.3014063,12.5 5.7971875,10.135781 7.7886719,8.1279688 10.138672,6.6290625 10.291719,6.5314062 10.446328,6.4367969 10.601875,6.3439062 10.212891,7.4114063 10,8.5635156 10,9.765625 c 0,5.522734 4.477187,10 10,10 5.522734,0 10,-4.477266 10,-10 0,-1.2021094 -0.212891,-2.3542188 -0.601797,-3.4217969 0.155313,0.092891 0.310078,0.1875781 0.463125,0.2852344 z M 20,8.515625 c 0,2.071094 -1.678906,3.75 -3.75,3.75 -2.071094,0 -3.75,-1.678906 -3.75,-3.75 0,-2.0710937 1.678906,-3.75 3.75,-3.75 2.071094,0 3.75,1.6789063 3.75,3.75 z" id="path2" class="path" style="fill:#c6c6c6;stroke-width:0.8;stroke:#1B1D1D;" /></svg>
                                       <span class="u-uppercase">Consultation</span>
                                   </a>
                               </li>
                        @endrole
                        @hasanyrole(['Ressources Humaines', 'Corps médical'])
                               <li class="nav-list__item my-work fake-button flex-column-nowrap {{ request()->is('historique') ? 'active' : '' }}" role="menuitem">
                                <a class="flex-row-wrap " href="{{ route("historique") }}" tabindex="0">
                                    <svg viewBox="0 0 32.265313 27.8375" height="34.510746" width="40" role="img" aria-labelledby="Skills"><g id="g4547">
                                        <path style="fill:#c6c6c6;stroke-width:0.3;stroke:#1B1D1D;" id="path2" class="path" d="M 30.702812,0 H 1.5625 C 0.69945313,0 0,0.69953 0,1.5625 v 18.28125 c 0,0.86297 0.69945313,1.5625 1.5625,1.5625 h 10.898281 v 3.54063 H 8.2199219 c -0.7969532,0 -1.4453125,0.64835 -1.4453125,1.44531 0,0.79695 0.6483593,1.44531 1.4453125,1.44531 H 24.045391 c 0.796953,0 1.445312,-0.64836 1.445312,-1.44531 0,-0.79696 -0.648359,-1.44531 -1.445312,-1.44531 h -4.24086 v -3.54063 h 10.898281 c 0.863047,0 1.5625,-0.69953 1.5625,-1.5625 V 1.5625 C 32.265312,0.69953 31.565859,0 30.702812,0 Z m -0.78125,19.0625 H 2.34375 V 2.34375 h 27.577812 z" />
                                        <path style="fill:#c6c6c6;stroke-width:0.3;stroke:#1B1D1D;" id="path4" class="path" d="m 5.6125953,11.58586 4.9284377,2.29187 c 0.127422,0.059 0.263047,0.0889 0.403281,0.0889 0.182656,0 0.360625,-0.0519 0.515391,-0.15031 0.277187,-0.17711 0.442656,-0.47891 0.442656,-0.80742 v -0.0252 c 0,-0.37117 -0.217578,-0.71211 -0.554375,-0.86867 L 8.2655641,10.683 11.348064,9.25065 c 0.336719,-0.15656 0.554297,-0.49758 0.554297,-0.86859 v -0.0249 c 0,-0.32899 -0.165547,-0.63078 -0.442578,-0.80735 -0.153281,-0.098 -0.331797,-0.14968 -0.516094,-0.14968 -0.138906,0 -0.278359,0.0305 -0.403125,0.0885 L 5.6125172,9.78019 C 5.2759547,9.93684 5.0585328,10.27777 5.0585328,10.64871 v 0.0686 c -7.81e-5,0.37047 0.2172656,0.71133 0.5540625,0.86852 z" /><path style="fill:#c6c6c6;stroke-width:0.2;stroke:#1B1D1D;" id="path6" class="path" d="m 13.723594,16.25398 c 0.179765,0.24602 0.468906,0.39289 0.773515,0.39289 h 0.02461 c 0.418125,0 0.784531,-0.26765 0.911875,-0.66531 L 18.680234,5.92219 C 18.773364,5.6318 18.721644,5.31141 18.541875,5.06484 18.362109,4.81883 18.072969,4.67187 17.768359,4.67187 h -0.02453 c -0.418281,0 -0.785,0.26766 -0.912422,0.66532 l -3.247031,10.06023 c -0.09234,0.29063 -0.04031,0.6107 0.139218,0.85656 z" /><path style="fill:#c6c6c6;stroke-width:0.2;stroke:#1B1D1D;" id="path8" class="path" d="m 20.362952,8.38203 c 0,0.37078 0.217343,0.71172 0.554296,0.86891 l 3.082422,1.43203 -3.082422,1.43203 c -0.336796,0.15656 -0.554375,0.4975 -0.554375,0.86867 v 0.0252 c 0,0.32851 0.165391,0.63031 0.442891,0.8075 0.154219,0.0983 0.332344,0.15023 0.515234,0.15023 0.14,0 0.275547,-0.0299 0.403829,-0.0892 l 4.928203,-2.29179 c 0.336484,-0.15696 0.553828,-0.49782 0.553828,-0.86836 v -0.0686 c 0,-0.37093 -0.217422,-0.71187 -0.554141,-0.86851 L 21.724592,7.48842 c -0.124297,-0.0577 -0.263515,-0.0884 -0.4025,-0.0884 -0.184219,0 -0.362812,0.0517 -0.515937,0.14937 -0.277657,0.17688 -0.443203,0.47868 -0.443203,0.80766 z" /></g></svg>
                                    <span class="u-uppercase">Consultation Journalière</span>
                                </a>
                            </li>
                           </ul>
                        @endhasanyrole

                           <ul class="sidebar__extra-content" role="menu" style="margin-bottom: 62PX;">
                            @role('IT')
                               <li class="extra-content__language " role="menuitem">
                                <svg height="39.999043" width="40.000126" viewBox="0 0 1.1718787 1.1718469" role="img" aria-labelledby="About me"><path d="M 1.1704687,0.546847 C 1.15125,0.254347 0.9175,0.020519 0.625,0.0013 V 0 H 0.5859375 0.546875 V 0.0013 C 0.254375,0.020519 0.02054688,0.254347 0.00132813,0.546847 H 0 v 0.03906 0.03906 H 0.00132813 C 0.02054688,0.917467 0.254375,1.151217 0.546875,1.170436 v 0.00141 H 0.5859375 0.625 v -0.0014 C 0.9175,1.151227 1.15125,0.917478 1.1704687,0.624978 h 0.00141 V 0.58591 0.546847 Z M 0.36679688,0.127706 c -0.0377344,0.05016 -0.0690625,0.113047 -0.091875,0.184766 H 0.15789063 C 0.20882813,0.233022 0.28117188,0.168722 0.36679688,0.127706 Z M 0.11703125,0.390597 H 0.254375 C 0.2439062,0.439967 0.2372656,0.492394 0.2351562,0.546847 H 0.07960937 C 0.08375,0.491847 0.09671875,0.439269 0.11703125,0.390597 Z M 0.07960937,0.624972 h 0.15554688 c 0.002109,0.05445 0.00875,0.106875 0.0192188,0.15625 H 0.11703125 C 0.09671875,0.73255 0.08375,0.679972 0.07960937,0.624972 Z m 0.07828126,0.234375 h 0.11695312 c 0.0228125,0.07172 0.0541406,0.134609 0.0919531,0.184766 C 0.28117188,1.003097 0.20882813,0.938878 0.15789063,0.859347 Z M 0.546875,1.088722 C 0.4665625,1.067238 0.39742188,0.980988 0.35546875,0.859347 H 0.546875 Z m 0,-0.3075 H 0.33351562 C 0.3225,0.73255 0.31554688,0.679972 0.31328125,0.624972 H 0.546875 Z m 0,-0.234375 H 0.31328125 c 0.002266,-0.055 0.009219,-0.107578 0.0202344,-0.15625 H 0.546875 Z m 0,-0.234375 H 0.35546875 C 0.39742188,0.190831 0.4665625,0.104581 0.546875,0.083175 Z m 0.4671094,0 H 0.89710938 C 0.87421878,0.240752 0.84296878,0.177863 0.80507808,0.127706 0.89062498,0.168726 0.96304683,0.233019 1.0139844,0.312472 Z M 0.625,0.083175 c 0.0802344,0.02141 0.14945312,0.107656 0.19140625,0.229297 H 0.625 Z m 0,0.307422 h 0.21328125 c 0.0110938,0.048672 0.0178906,0.10125 0.0203125,0.15625 H 0.625 Z m 0,0.234375 h 0.23359375 c -0.002266,0.055 -0.009219,0.107578 -0.0203125,0.15625 H 0.625 Z m 0,0.46375 V 0.859347 H 0.81640625 C 0.77445312,0.980988 0.70523437,1.067238 0.625,1.088722 Z m 0.18007812,-0.04461 c 0.0377344,-0.05023 0.0691406,-0.113047 0.0920313,-0.184766 H 1.0139844 C 0.9630469,0.938876 0.890625,1.003096 0.80507812,1.044112 Z M 1.0548437,0.781222 H 0.9175 C 0.9279688,0.731852 0.9346094,0.679425 0.9367188,0.624972 h 0.1554687 c -0.00406,0.055 -0.017031,0.107578 -0.037344,0.15625 z M 0.93671875,0.546847 c -0.002109,-0.05445 -0.00875,-0.106875 -0.0192188,-0.15625 H 1.0548436 c 0.020312,0.04867 0.033281,0.10125 0.037422,0.15625 z" id="path2" style="fill:#c6c6c6;stroke-width:0.078125" /></svg><svg height="17.021526" width="9.999999" viewBox="0 0 9.6094522 16.356756"><g transform="matrix(0.03324517,0,0,0.03324517,-3.3736534,0)" id="g6"><path style="fill:#c6c6c6" id="path2" d="M 382.678,226.804 163.73,7.86 C 158.666,2.792 151.906,0 144.698,0 137.49,0 130.73,2.792 125.666,7.86 l -16.124,16.12 c -10.492,10.504 -10.492,27.576 0,38.064 L 293.398,245.9 109.338,429.96 c -5.064,5.068 -7.86,11.824 -7.86,19.028 0,7.212 2.796,13.968 7.86,19.04 l 16.124,16.116 c 5.068,5.068 11.824,7.86 19.032,7.86 7.208,0 13.968,-2.792 19.032,-7.86 L 382.678,265 c 5.076,-5.084 7.864,-11.872 7.848,-19.088 0.016,-7.244 -2.772,-14.028 -7.848,-19.108 z" /></g></svg>
                                <span class="u-uppercase">PARAMETRES</span>
                                <ul class="extra-content__language-selector flex-column-nowrap" aria-label="submenu" aria-hidden="true" aria-expanded="false" aria-haspopup="true">
                                    <li class="language-selector__item u-uppercase {{ request()->is('permission') ? 'active' : '' }} " role="menuitem">
                                        <a href="{{ route("permission.index") }}" tabindex="-1">
                                            <span class="u-uppercase">Permission</span>
                                        </a>
                                    </li>
                                    <li class="language-selector__item u-uppercase {{ request()->is('profil') ? 'active' : '' }}" role="menuitem">
                                        <a href="{{ route("profil.index") }}" tabindex="-1">
                                            <span class="u-uppercase">Profils utilisateurs</span>
                                        </a>
                                    </li>
                                    <li class="language-selector__item u-uppercase {{ request()->is('user') ? 'active' : '' }} " role="menuitem">
                                        <a href="{{ route("users.index") }}" tabindex="-1">
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
                    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
                        <div class="container-fluid">
                            <!-- Bouton pour le menu responsive -->
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>

                            <div class="collapse navbar-collapse" id="navbarNav">
                            @role('Ressources Humaines')
                                <ul class="navbar-nav mx-auto">
                                    <li class="nav-item nav-link-fixed-size">
                                        <a class="nav-link {{ request()->is('rapport.index') ? 'active' : '' }} px-3 py-2" href="{{ route('rapport.index') }}">
                                            <div class="row align-items-center">
                                                <div class="col-auto">
                                                    <i class="fas fa-notes-medical" style="font-size: 18px;"></i>
                                                </div>
                                                <div class="col">
                                                    <span>Extraction consultations</span>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="nav-item nav-link-fixed-size">
                                        <a class="nav-link {{ request()->is('iris') ? 'active' : '' }} px-3 py-2" href="{{ route('iris') }}">
                                            <div class="row align-items-center">
                                                <div class="col-auto">
                                                    <i class="fas fa-id-card" style="font-size: 18px;"></i>
                                                </div>
                                                <div class="col">
                                                    <span>Extraction par Workday ID</span>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="nav-item nav-link-fixed-size">
                                        <a class="nav-link {{ request()->is('recherche') ? 'active' : '' }} px-3 py-2" href="{{ route('recherche') }}">
                                            <div class="row align-items-center">
                                                <div class="col-auto">
                                                </div>
                                                <div class="col">
                                                    <span>Extraction Avancée consultations</span>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="nav-item dropdown nav-link-fixed-size">
                                        <a class="nav-link dropdown-toggle px-3 py-2 {{ request()->is('reports*') ? 'active' : '' }}" href="#" id="rapportsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <div class="row align-items-center">
                                                <div class="col-auto">
                                                    <i class="fas fa-pills" style="font-size: 18px;"></i>
                                                </div>
                                                <div class="col">
                                                    <span>Rapports médicaments</span>
                                                </div>
                                            </div>
                                        </a>
                                        <ul class="dropdown-menu" aria-labelledby="rapportsDropdown">
                                            <li>
                                                <a class="dropdown-item {{ request()->is('reports/etat-stock') ? 'active' : '' }}" href="{{ route('stocks.stockparsite') }}">
                                                    État du stock
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item {{ request()->is('reports/ruptures') ? 'active' : '' }}" href="{{ route('medicaments.top-users-view') }}">
                                                    Médicaments en rupture
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item {{ request()->is('reports/consommation') ? 'active' : '' }}" href="#">
                                                    Rapport de consommation
                                                </a>
                                            </li>
                                        </ul>
                                    </li>

                                </ul>
                            @endrole
                                <!-- Profil utilisateur -->
                                <ul class="navbar-nav ms-auto">
                                    <li class="nav-item nav-link-fixed-size dropdown">
                                        <a class="nav-link dropdown-toggle text-white d-flex align-items-center" data-bs-toggle="dropdown">
                                            <img class="img-fluid rounded-circle me-2" src="{{ asset('images/layout_img/user_img.jpg') }}" alt="User Image" width="40" height="40">
                                            @if (Auth::check())
                                                <span class="name_user">{{ Auth::user()->name }}</span>
                                            @else
                                                <script> window.location.href = "{{ route('login') }}"; </script>
                                            @endif
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li>
                                                <a class="dropdown-item" href="{{ route('logout') }}"
                                                   onclick="event.preventDefault();
                                                             document.getElementById('logout-form').submit();">
                                                    <i class="fa fa-sign-out-alt me-2"></i> Log Out
                                                </a>
                                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                    @csrf
                                                </form>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
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
                            <p>Copyright © 2025 Designed by <a target="_blank" href="#">Concentrix Côte d'Ivoire</a></a>. Tous droits réservés.<br><br>
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



<!-- custom js -->
<script src="{{ asset("assets/js/custom.js") }}"></script>
<!-- jQuery (version complète) -->
<script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>

<!-- DataTables Core -->
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

<!-- DataTables Buttons -->
<script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>

<!-- Axios for Ajax Requests -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.27.2/axios.min.js" integrity="sha512-odNmoc1XJy5x1TMVMdC7EMs3IVdItLPlCeL5vSUPN2llYKMJ2eByTTAIiiuqLg+GdNr9hF6z81p27DArRFKT7A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="{{ asset("assets/bootstrap/js/bootstrap.bundle.min.js") }}"></script>
@yield('script')
<script>
    $(document).ready( function () {
        $('#zero_config').DataTable();

      //  $('.select2').select2();
    });




</script>


</body>


</html>
