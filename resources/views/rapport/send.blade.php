
<fieldset class="mt-2">
    <legend>Liste des arrêts</legend>
    <table class="table table-striped table-responsive-sm table-bordered">
        <thead>
            <tr>
                <th>IRIS</th>
                <th>NOM-PRENOM</th>
                <th>TYPE D'ARRET</th>
                <th>DUREE</th>  
                <th>DATE DE DEBUT</th>                                                                
                <th>DATE DE FIN</th>                                                             
                <th>DATE DE REPRIS</th>                                                                                                               
            </tr>
            </thead>
        <tbody>
        <?php
                foreach ($data as $cs) {
                    ?>
                        <tr>
                            <td><?= $cs->Agent->iris ?></td>
                            <td><?= $cs->Agent->nom.' '.$cs->Agent->prenom  ?></td>
                            <td><?= $cs->typeArrêt ?></td>
                            <td><?= $cs->duree_arret ?> min</td>
                            <td><?=  date('d-m-Y', strtotime($cs->debutArret)) ?></td>
                            <td><?=  date('d-m-Y', strtotime($cs->debutArret. ' - 1 days')) ?></td>
                            <td><?=  date('d-m-Y', strtotime($cs->dateReprise)) ?></td>
                        </tr>
                    <?php
                }
        ?>
        </tbody>
    </table>
</fieldset>



<i>Pour toute information complémentaire, nous vous remercions de bien vouloir vous rapprocher de votre médecin d’entreprise ou HR Business Partner.</i><br><br>



Cordialement,<br>
<b><h3>Votre Team RH Côte d'Ivoire</h3></b>

