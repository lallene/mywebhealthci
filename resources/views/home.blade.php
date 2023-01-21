@extends('layouts.app')

<style>
    .form-check-input:checked {
    background-color: #cc3262 !important;
    border-color: #cc3262 !important;
}
.bg-sucess {
    background-color: #1d4851!important;
}
 .filter{
    background-color: white;
    box-shadow: 0px 0px 68px 3px #1d4851;
    width: 100%;
    border-radius: 6px;
    MARGIN-LEFT: 0PX;
}
.title{
    padding: 25px 35px 22px 38px;
    margin-left: -40px;
    margin-right: -40px;
    position: relative;
    font-size: 28px;
    font-weight: bold;

    text-align: center;
}
.title h2 {
    color: #cc3262 ;
}
</style>

@section('link')
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.oesmith.co.uk/morris-0.5.1.css" />
@stop

@section('content')
    @role('Ressources Humaines|Corps médical|IT')
        <div class="container-fluid">

            <div class="row column_title mb-3 filter" style="background-color: #1d485147;">
                <div class="col-md-3">
                    <div class="title mb-0" style="box-shadow: none!important">
                        <span style="color:#F77F00	">My</span>
                        <span style="color:#FFFFFF">Webhealth</span>
                        <span style="color:#009E60">CI</span>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="row">
                        <div class="col-12 text-center pt-2 pb-2 mb-2" style="font-weight: bolder;">Filtrer </div>
                    </div>
                    <form method="post" class="row" action="/dashboard" enctype="multipart/form-data">
                        @csrf
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="debut" class="center">Période</label>
                                <input id="debut" type="text" class="form-control"  placeholder="<?= isset($periode) ? $periode : '' ?>" name="datefilter">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="site" class="center">Site</label>
                                <select class="form-control" id="site" name="siteSelected">
                                    <option value="all">Tous les sites</option>
                                    <?php
                                        foreach ($sites as $site) {
                                            ?>
                                            <option <?= (isset($theSite) AND $theSite == $site->id) ? 'selected' : '' ?>  value="<?= $site->id ?>"><?= $site->designation ?></option>
                                            <?php
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="projet" class="center">Projet</label>
                                <select class="form-control" id="projet" name="projetSelected">
                                    <option value="all">Tous les projets</option>
                                    <?php

                                         //   dd($projets);

                                        foreach ($projets as $projet) {
                                            ?>
                                            <option value="<?= $projet->id ?>"><?= $projet->designation ?></option>
                                            <?php
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label for="debut" class="center">&nbsp; &nbsp;</label>
                            <button class="btn btn-success w-100" type="submit">Afficher</button>
                        </div>
                    </form>
                    <div class="row">
                        @role('Ressources Humaines')
                        <div class="col-md-3">
                            <div class="form-check form-switch ">
                                <input class="form-check-input" type="checkbox" role="switch" id="first" checked>
                                <label class="form-check-label" for="flexSwitchCheckDefault">Arrêt délivrés vs consultations</label>
                            </div>
                            <div class="form-check form-switch ">
                                <input class="form-check-input" type="checkbox" role="switch" id="second" checked>
                                <label class="form-check-label" for="flexSwitchCheckDefault">Arrêt délivrés vs consultations</label>
                            </div>
                            <div class="form-check form-switch ">
                                <input class="form-check-input" type="checkbox" role="switch" id="third" checked>
                                <label class="form-check-label" for="flexSwitchCheckDefault">% Transformation</label>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-check form-switch ">
                                <input class="form-check-input" type="checkbox" role="switch" id="fourth" checked>
                                <label class="form-check-label" for="flexSwitchCheckDefault">Arrêt par type de contrat</label>
                            </div>
                            <div class="form-check form-switch ">
                                <input class="form-check-input" type="checkbox" role="switch" id="fiveth" checked>
                                <label class="form-check-label" for="flexSwitchCheckDefault">Arrêt par sexe</label>
                            </div>
                            <div class="form-check form-switch ">
                                <input class="form-check-input" type="checkbox" role="switch" id="sixth" checked>
                                <label class="form-check-label" for="flexSwitchCheckDefault">Arrêt par couverture assurance</label>
                            </div>

                            <div class="form-check form-switch ">
                                <input class="form-check-input" type="checkbox" role="switch" id="thirteenth" checked>
                                <label class="form-check-label" for="flexSwitchCheckDefault">Arrêt par accident de travail</label>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-check form-switch ">
                                <input class="form-check-input" type="checkbox" role="switch" id="seventh" checked>
                                <label class="form-check-label" for="flexSwitchCheckDefault">Arrêt par trânche d'âge</label>
                            </div>
                            <div class="form-check form-switch ">
                                <input class="form-check-input" type="checkbox" role="switch" id="eighth" checked>
                                <label class="form-check-label" for="flexSwitchCheckDefault">Consultation par pathologie</label>
                            </div>
                            <div class="form-check form-switch ">
                                <input class="form-check-input" type="checkbox" role="switch" id="nineth" checked>
                                <label class="form-check-label" for="flexSwitchCheckDefault">Pathologie par genre</label>
                            </div>
                        </div>
                        @endrole
                        <div class="col-md-3">
                            @role('Ressources Humaines')
                            <div class="form-check form-switch ">
                                <input class="form-check-input" type="checkbox" role="switch" id="tenth" checked>
                                <label class="form-check-label" for="flexSwitchCheckDefault">Pathologie par tranche d'âge</label>
                            </div>
                            <div class="form-check form-switch ">
                                <input class="form-check-input" type="checkbox" role="switch" id="eleventh" checked>
                                <label class="form-check-label" for="flexSwitchCheckDefault">Maladie contagieuse</label>
                            </div>
                            <div class="form-check form-switch ">
                                <input class="form-check-input" type="checkbox" role="switch" id="fourteenth" checked>
                                <label class="form-check-label" for="flexSwitchCheckDefault">Maladie Professionnelle</label>
                            </div>
                            @endrole
                            <div class="form-check form-switch ">
                                <input class="form-check-input" type="checkbox" role="switch" id="twelveth" checked>
                                <label class="form-check-label" for="flexSwitchCheckDefault">Statistique</label>
                            </div>
                        </div>
                    </div>

                </div>


            </div>

            <?php
                $totalHeureArret = 0;
                $totalArret = 0;
                $interne = 0;
                $externe = 0;

                foreach ($arretsBySite as $key => $data) {
                    $totalArret += $data['TotalConsultation'];
                    $totalHeureArret += $data['TotalArret'];
                    if($key == 'Interne'){
                        $interne += $totalArret;
                    }else{
                        $externe += $totalArret;
                    }
                }

                if($totalArret > 0){
                    $pourcentage = ($interne * 100) / $totalArret;
                }else{
                    $pourcentage = 0;
                }

                $totalConsultation = 0;

                foreach ($dataPoints as $chartDatum) {
                    $totalConsultation += $chartDatum['a'];
                }
            ?>

            <div class="row">
                <div class="col-md-12">
                    <div class="row column1 twelveth ">
                        <div class="col-md-6 col-lg-3">
                            <div class="full counter_section margin_bottom_30">
                                <div class="counter_no">
                                    <div>
                                        <p class="total_no"><?= $totalConsultation ?></p>
                                        <p class="head_couter">Nombre consultation</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <div class="full counter_section margin_bottom_30">
                                <div class="counter_no">
                                    <div>
                                        <p class="total_no"><?= $totalArret ?></p>
                                        <p class="head_couter">Nombre d'arrêt</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <div class="full counter_section margin_bottom_30">
                                <div class="counter_no">
                                    <div>
                                        <p class="total_no"><?= $totalHeureArret / 24 ?></p>
                                        <p class="head_couter">Nombre total de Jours non travaillés</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <div class="full counter_section margin_bottom_30">
                                <div class="counter_no">
                                    <div>
                                        <p class="total_no"><?= $pourcentage ?></p>
                                        <p class="head_couter">% Arrêt interne</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row column1 social_media_section mb-3 " id="labels">
                        @role('Ressources Humaines')
                        <div class="col-md-3 first" >
                            <div class="white_shd full">
                                <div class="full graph_head">
                                    <div class="heading1 margin_0 text-center">
                                        <h2>Arrêt délivrés vs consultations</h2>
                                    </div>
                                </div>
                                <div class="full graph_revenue ">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="content">
                                                <table class="table">
                                                    <thead class="bg-sucess text-white font-weight-bold">
                                                        <tr>
                                                            <th>Lieu consultation</th>
                                                            <th class="text-center">Nbre arrêt</th>
                                                            <th class="text-center">Nbre heure arrêt</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                            $totalConsultation = 0;
                                                            $totalArret = 0;
                                                            foreach ($arretsBySite as $key => $data) {
                                                                $totalConsultation += $data['TotalConsultation'];
                                                                $totalArret += $data['TotalArret'];
                                                                ?>
                                                                <tr class="font-weight-bold">
                                                                    <td><?= $key ?></td>
                                                                    <td class="text-center"><?= $data['TotalConsultation'] ?></td>
                                                                    <td class="text-center"><?= $data['TotalArret'] ?></td>
                                                                </tr>
                                                                <?php
                                                                    if(isset($data['stats']) AND !empty($data['stats'])){
                                                                        foreach ($data['stats'] as $value) {
                                                                            ?>
                                                                            <tr>
                                                                                <td class="pl-4"><?= $value['Site'] ?></td>
                                                                                <td class="text-center"><?= $value['Consultation'] ?></td>
                                                                                <td class="text-center"><?= $value['Arret'] ?></td>
                                                                            </tr>
                                                                            <?php
                                                                        }
                                                                    }
                                                            }
                                                        ?>
                                                    </tbody>
                                                    <tfoot class="bg-sucess text-white font-weight-bold">
                                                        <tr>
                                                            <td>Total général</td>
                                                            <td class="text-center"><?= $totalConsultation ?></td>
                                                            <td class="text-center"><?= $totalArret ?></td>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 second">
                            <div class="white_shd full">
                                <div class="full graph_head">
                                    <div class="heading1 margin_0 text-center">
                                        <h2>Arrêt délivrés vs consultations</h2>
                                    </div>
                                </div>
                                <div class="full graph_revenue">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="content">
                                                <div class="area_chart">
                                                    <div id="bar-chart" ></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3  third">
                            <div class="white_shd full">
                                <div class="full graph_head">
                                    <div class="heading1 margin_0 text-center">
                                        <h2>% Transformation</h2>
                                    </div>
                                </div>
                                <div class="full graph_revenue">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="content">
                                                <table class="table table-bordered">
                                                    <thead class="bg-sucess text-white font-weight-bold">
                                                        <tr>
                                                            <th>Agent</th>
                                                            <th class="text-center">%</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                            $totalA = 0;
                                                            $totalB = 0;
                                                            foreach ($dataPoints as $dataPoint) {
                                                                $totalA += $dataPoint['a'];
                                                                $totalB += $dataPoint['b'];
                                                                if($dataPoint['a'] > 0){
                                                                    $perc = ($dataPoint['b'] * 100) / $dataPoint['a'];
                                                                }else{
                                                                    $perc = '-';
                                                                }
                                                                ?>
                                                                <tr>
                                                                    <td><?= $dataPoint['y'] ?></td>
                                                                    <td class="text-center"><?= is_numeric($perc) ? round($perc, 2).'%' : '-' ?></td>
                                                                </tr>
                                                                <?php
                                                            }
                                                        ?>
                                                    </tbody>
                                                    <tfoot class="bg-sucess text-white font-weight-bold">
                                                        <?php
                                                            if($totalA > 0){
                                                                $totalPerc = ($totalB * 100) / $totalA;
                                                            }else{
                                                                $totalPerc = 100;
                                                            }
                                                        ?>
                                                        <tr>
                                                            <td>Total général</td>
                                                            <td class="text-center"><?= round($totalPerc, 2) ?>%</td>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row column1 mb-2">
                        <div class="col-md-6 col-lg-3 fourth">
                            <div class="card">
                                <div class="card-header">Arrêt par type de contrat</div>
                                <div class="card-body">
                                    <div id="chartByContrat" ></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3 fiveth">
                            <div class="card">
                                <div class="card-header">Arrêt par sexe</div>
                                <div class="card-body">
                                    <div id="chartBySexe" ></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3 sixth">
                            <div class="card">
                                <div class="card-header">Arrêt par couverture assurance</div>
                                <div class="card-body">
                                    <div id="chartByAssurance" ></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3 fourteenth">
                            <div class="card">
                                <div class="card-header">Arrêt par maladie professionnelle</div>
                                <div class="card-body">
                                    <div id="chartByMaladiePro" ></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 thirteenth" >
                            <div class="white_shd full">
                                <div class="full graph_head">
                                    <div class="heading1 margin_0 text-center">
                                        <h2>Arrêt par accident de travail </h2>
                                    </div>
                                </div>
                                <div class="full graph_revenue ">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="content">
                                                <table class="table">
                                                    <thead class="bg-sucess text-white font-weight-bold">
                                                        <tr>
                                                            <th>Lieu consultation</th>
                                                            <th class="text-center">Nbre arrêt</th>
                                                            <th class="text-center">Nbre heure arrêt</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                            $totalConsultation = 0;
                                                            $totalArret = 0;
                                                            foreach ($accidentsBySite as $key => $data) {
                                                                $totalConsultation += $data['TotalConsultation'];
                                                                $totalArret += $data['TotalArret'];
                                                                ?>
                                                                <tr class="font-weight-bold">
                                                                    <td><?= $key ?></td>
                                                                    <td class="text-center"><?= $data['TotalConsultation'] ?></td>
                                                                    <td class="text-center"><?= $data['TotalArret'] ?></td>
                                                                </tr>
                                                                <?php
                                                                    if(isset($data['stats']) AND !empty($data['stats'])){
                                                                        foreach ($data['stats'] as $value) {
                                                                            ?>
                                                                            <tr>
                                                                                <td class="pl-4"><?= $value['Site'] ?></td>
                                                                                <td class="text-center"><?= $value['Consultation'] ?></td>
                                                                                <td class="text-center"><?= $value['Arret'] ?></td>
                                                                            </tr>
                                                                            <?php
                                                                        }
                                                                    }
                                                            }
                                                        ?>
                                                    </tbody>
                                                    <tfoot class="bg-sucess text-white font-weight-bold">
                                                        <tr>
                                                            <td>Total général</td>
                                                            <td class="text-center"><?= $totalConsultation ?></td>
                                                            <td class="text-center"><?= $totalArret ?></td>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3 twelfth">
                            <div class="card">
                                <div class="card-header">Arrêt par trânche d'âge</div>
                                <div class="card-body">
                                    <div id="chartByTranche" ></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row column1 mb-2">
                        <div class="col-md-6 col-lg-6 eighth">
                            <div class="white_shd full">
                                <div class="full graph_head">
                                    <div class="heading1 margin_0 text-center">
                                        <h2>Consultation par pathologie</h2>
                                    </div>
                                </div>
                                <div class="full graph_revenue">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="content">
                                                <table class="table table-bordered">
                                                    <thead class="bg-sucess text-white font-weight-bold">
                                                        <tr>
                                                            <th>Pathologie</th>
                                                            <th class="text-center">Consultation</th>
                                                            <th class="text-center">Arrêt</th>
                                                            <th class="text-center">% Transformation</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                            $totalConsultation = 0;
                                                            $totalArret = 0;
                                                            foreach ($statByPathologie as $data) {
                                                                $perc = ($data['Arret'] * 100) / $data['Consultation'];
                                                                $totalConsultation += $data['Consultation'];
                                                                $totalArret += $data['Arret'];
                                                                ?>
                                                                <tr>
                                                                    <td><?= $data['Motif'] ?></td>
                                                                    <td class="text-center"><?= $data['Consultation'] ?></td>
                                                                    <td class="text-center"><?= $data['Arret'] ?></td>
                                                                    <td class="text-center"><?= round($perc, 2) ?>%</td>
                                                                </tr>
                                                                <?php
                                                            }
                                                        ?>
                                                    </tbody>
                                                    <tfoot class="bg-sucess text-white font-weight-bold">
                                                        <tr>
                                                            <?php
                                                                if($totalConsultation > 0)
                                                                    $totalPerc = ($totalArret * 100) / $totalConsultation;
                                                                else
                                                                    $totalPerc = '100%'
                                                            ?>
                                                            <th>Total général</th>
                                                            <th class="text-center"><?= $totalConsultation ?></th>
                                                            <th class="text-center"><?= $totalArret ?></th>
                                                            <th class="text-center"><?= round($totalPerc, 2) ?>%</th>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-6 nineth">

                            <div class="white_shd full">
                                <div class="full graph_head">
                                    <div class="heading1 margin_0 text-center">
                                        <h2>Pathologie par genre</h2>
                                    </div>
                                </div>
                                <div class="full graph_revenue">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="content">
                                                <table class="table table-bordered">
                                                    <thead class="bg-sucess text-white font-weight-bold">
                                                        <tr>
                                                            <th>Genre</th>
                                                            <th class="text-center">Nbre consultation</th>
                                                            <th class="text-center">Nbre arrêt</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                            $totalConsultation = 0;
                                                            $totalArret = 0;
                                                            foreach ($statByPathologieAndGenre as $key => $data) {
                                                                $totalConsultation += $data['TotalConsultation'];
                                                                $totalArret += $data['TotalArret'];
                                                                ?>
                                                                <tr class="font-weight-bold">
                                                                    <td><?= $key ?></td>
                                                                    <td class="text-center"><?= $data['TotalConsultation'] ?></td>
                                                                    <td class="text-center"><?= $data['TotalArret'] ?></td>
                                                                </tr>
                                                                <?php
                                                                    if(isset($data['stats']) AND !empty($data['stats'])){
                                                                        foreach ($data['stats'] as $value) {
                                                                            ?>
                                                                            <tr>
                                                                                <td class="pl-4"><?= $value['Motif'] ?></td>
                                                                                <td class="text-center"><?= $value['Consultation'] ?></td>
                                                                                <td class="text-center"><?= $value['Arret'] ?></td>
                                                                            </tr>
                                                                            <?php
                                                                        }
                                                                    }
                                                            }
                                                        ?>
                                                    </tbody>
                                                    <tfoot class="bg-sucess text-white font-weight-bold">
                                                        <tr>
                                                            <td>Total général</td>
                                                            <td class="text-center"><?= $totalConsultation ?></td>
                                                            <td class="text-center"><?= $totalArret ?></td>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row column1 mb-2">
                        <div class="col-md-6 col-lg-6 tenth">

                            <div class="white_shd full">
                                <div class="full graph_head">
                                    <div class="heading1 margin_0 text-center">
                                        <h2>Pathologie par tranche d'âge</h2>
                                    </div>
                                </div>
                                <div class="full graph_revenue">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="content">
                                                <table class="table table-bordered">
                                                    <thead class="bg-sucess text-white font-weight-bold">
                                                    <tr>
                                                        <th>Tranche</th>
                                                        <th>Nbre consultation</th>
                                                        <th>Nbre arrêt</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                            //echo('<pre>'); die(print_r($pathologieByTranche));
                                                            $keys[0] = '18 - 25';
                                                            $keys[1] = '25 - 30';
                                                            $keys[2] = '> 30';
                                                            $totalConsultation = 0;
                                                            $totalArret = 0;
                                                            foreach ($keys as $x => $key) {
                                                                if (isset($pathologieByTranche[$key])){
                                                                    $data = $pathologieByTranche[$key];
                                                                    //echo('<pre>'); die(print_r($pathologieByTranche));
                                                                    $totalConsultation += $data['Consultation'];
                                                                    $totalArret += $data['Arret'];
                                                                    ?>
                                                                    <tr class="font-weight-bold">
                                                                        <td><?= $key ?></td>
                                                                        <td class="text-center"><?= $data['Consultation'] ?></td>
                                                                        <td class="text-center"><?= $data['Arret'] ?></td>
                                                                    </tr>
                                                                    <?php
                                                                        if (isset($data['Items'])){
                                                                            foreach ($data['Items'] as $value) {
                                                                                ?>
                                                                                <tr>
                                                                                    <td class="pl-4"><?= $value['Pathologie'] ?></td>
                                                                                    <td class="text-center"><?= $value['Consultation'] ?></td>
                                                                                    <td class="text-center"><?= $value['Arret'] ?></td>
                                                                                </tr>
                                                                                <?php
                                                                            }
                                                                        }
                                                                }else{
                                                                    ?>
                                                                    <tr class="font-weight-bold">
                                                                        <td><?= $key ?></td>
                                                                        <td class="text-center">0</td>
                                                                        <td class="text-center">0</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="pl-4" colspan="3">Vide</td>
                                                                    </tr>
                                                                    <?php
                                                                }
                                                            }
                                                        ?>
                                                    </tbody>
                                                    <tfoot class="bg-sucess text-white font-weight-bold">
                                                    <tr>
                                                        <td>Total général</td>
                                                        <td class="text-center"><?= $totalConsultation ?></td>
                                                        <td class="text-center"><?= $totalArret ?></td>
                                                    </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-6 eleventh">
                            <div class="white_shd full">
                                <div class="full graph_head">
                                    <div class="heading1 margin_0 text-center">
                                        <h2>Maladie contagieuse</h2>
                                    </div>
                                </div>
                                <div class="full graph_revenue">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="content">
                                                <table class="table table-bordered">
                                                    <thead class="bg-sucess text-white font-weight-bold">
                                                        <tr>
                                                            <th>Tranche</th>
                                                            <th class="text-center">Nbre consultation</th>
                                                            <th class="text-center">Nbre arrêt</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                            $totalConsultation = 0;
                                                            $totalArret = 0;
                                                            foreach ($statByPathologieAndContagieux as $data) {
                                                                $totalConsultation += $data['Consultation'];
                                                                $totalArret += $data['Arret'];
                                                                ?>
                                                                <tr>
                                                                    <td><?= $data['Motif'] ?></td>
                                                                    <td class="text-center"><?= $data['Consultation'] ?></td>
                                                                    <td class="text-center"><?= $data['Arret'] ?></td>
                                                                </tr>
                                                                <?php
                                                            }
                                                        ?>
                                                    </tbody>
                                                    <tfoot class="bg-sucess text-white font-weight-bold">
                                                        <tr>
                                                            <th>Total général</th>
                                                            <th class="text-center"><?= $totalConsultation ?></th>
                                                            <th class="text-center"><?= $totalArret ?></th>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endrole

                    </div>
                </div>
            </div>
        </div>
    @endrole
@stop
@section('script')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.2/raphael-min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.0/morris.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>


        // affichage multiple
        $('#first').change(function(){   if($(this).is(":checked")) {    $('.first').removeClass('d-none');    } else {        $('.first').addClass('d-none');} });
        $('#second').change(function(){   if($(this).is(":checked")) {    $('.second').removeClass('d-none');    } else {        $('.second').addClass('d-none');} });
        $('#third').change(function(){   if($(this).is(":checked")) {    $('.third').removeClass('d-none');    } else {        $('.third').addClass('d-none');} });
        $('#fourth').change(function(){   if($(this).is(":checked")) {    $('.fourth').removeClass('d-none');    } else {        $('.fourth').addClass('d-none');} });
        $('#fiveth').change(function(){   if($(this).is(":checked")) {    $('.fiveth').removeClass('d-none');    } else {        $('.fiveth').addClass('d-none');} });
        $('#sixth').change(function(){   if($(this).is(":checked")) {    $('.sixth').removeClass('d-none');    } else {        $('.sixth').addClass('d-none');} });
        $('#seventh').change(function(){   if($(this).is(":checked")) {    $('.seventh').removeClass('d-none');    } else {        $('.seventh').addClass('d-none');} });
        $('#eighth').change(function(){   if($(this).is(":checked")) {    $('.eighth').removeClass('d-none');    } else {        $('.eighth').addClass('d-none');} });
        $('#nineth').change(function(){   if($(this).is(":checked")) {    $('.nineth').removeClass('d-none');    } else {        $('.nineth').addClass('d-none');} });
        $('#tenth').change(function(){   if($(this).is(":checked")) {    $('.tenth').removeClass('d-none');    } else {        $('.tenth').addClass('d-none');} });
        $('#eleventh').change(function(){   if($(this).is(":checked")) {    $('.eleventh').removeClass('d-none');    } else {        $('.eleventh').addClass('d-none');} });
        $('#twelveth').change(function(){   if($(this).is(":checked")) {    $('.twelveth').removeClass('d-none');    } else {        $('.twelveth').addClass('d-none');} });
        $('#thirteenth').change(function(){   if($(this).is(":checked")) {    $('.thirteenth').removeClass('d-none');    } else {        $('.thirteenth').addClass('d-none');} });
        $('#fourteenth').change(function(){   if($(this).is(":checked")) {    $('.fourteenth').removeClass('d-none');    } else {        $('.fourteenth').addClass('d-none');} });




        $( document ).ready(function() {
            $('#sidebarCollapse').trigger('click');

            $('input[name="datefilter"]').daterangepicker({
                autoUpdateInput: false,
                locale: {
                    cancelLabel: 'Clear'
                }
            });

            $('input[name="datefilter"]').on('apply.daterangepicker', function(ev, picker) {
                $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
            });

            $('input[name="datefilter"]').on('cancel.daterangepicker', function(ev, picker) {
                $(this).val('');
            });

            var  config = {
                data: <?= json_encode($dataPoints) ?>,
                xkey: 'y',
                ykeys: ['a', 'b'],
                labels: ['Nbre Consultation', 'Nbre Arrêt'],
                fillOpacity: 0.6,
                hideHover: 'auto',
                behaveLikeLine: true,
                resize: true,
                pointFillColors:['#ffffff'],
                pointStrokeColors: ['black'],
                lineColors:['gray','red']
            };
            config.element = 'bar-chart';
            Morris.Bar(config);

            // Par Type de Contrat

            Morris.Donut({
                element: 'chartByContrat',
                data: <?= json_encode($byTypeContrat, JSON_NUMERIC_CHECK) ?>
            });

            // Par Sexe

            Morris.Donut({
                element: 'chartBySexe',
                data: <?= json_encode($bySexe, JSON_NUMERIC_CHECK) ?>
            });

            // Par Tranche d'âge

            var  config = {
                data: <?= json_encode($arretsByTranche) ?>,
                xkey: 'y',
                ykeys: ['a', 'b'],
                labels: ['Nbre Consultation', 'Nbre Arrêt'],
                fillOpacity: 0.6,
                hideHover: 'auto',
                behaveLikeLine: true,
                resize: true,
                pointFillColors:['#ffffff'],
                pointStrokeColors: ['black'],
                lineColors:['gray','red']
            };
            config.element = 'chartByTranche';
            Morris.Bar(config);

            // Par Couverture Maladie

            var  configCouverture = {
                data: <?= json_encode($byCouverture) ?>,
                xkey: 'y',
                ykeys: ['a'],
                labels: ['Nbre Consultation'],
                fillOpacity: 0.6,
                hideHover: 'auto',
                behaveLikeLine: true,
                resize: true,
                pointFillColors:['#ffffff'],
                pointStrokeColors: ['black'],
                lineColors:['gray','red']
            };
            configCouverture.element = 'chartByAssurance';
            Morris.Bar(configCouverture);



             // Par  Maladie Professionnelle

             var  configMaladiePro = {
                data: <?= json_encode($byMaladiePro) ?>,
                xkey: 'y',
                ykeys: ['a'],
                labels: ['Nbre Consultation'],
                fillOpacity: 0.6,
                hideHover: 'auto',
                behaveLikeLine: true,
                resize: true,
                pointFillColors:['#ffffff'],
                pointStrokeColors: ['black'],
                lineColors:['gray','red']
            };
            configMaladiePro.element = 'chartByMaladiePro';
            Morris.Bar(configMaladiePro);



        });
    </script>
    <script src="{{ asset("assets/js/scripts/prescrire.js") }}"></script>
@stop
