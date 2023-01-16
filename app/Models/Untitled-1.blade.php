
 <div class="input-container focus">
    <select name="nouvelleConsultation" class="  input" id="nouvelleConsultation">
        <?php
            foreach ($foreigns as $foreign) {
                ?>
                <option value="{{ $foreign->id }}">{{ $foreign->intitule }}</option>
                <?php
                }
        ?>
    </select>
    <label for="nouvelleConsultation">Motif de consultation </label>
    <span>Motif de consultation </span>
</div>
</div>
<div class="col-md-3">
<div class="input-container focus">
    <select class=" input" name="duplicat_suite_valide" id="">
        <option value="1"  >oui</option>
        <option value="0" selected>non</option>
    </select>
    <label for="validationDefault03">Duplicata suite validation</label>
    <span>Duplicata suite validation</span>
</div>
</div>
<div class="col-md-3">
    <div class="input-container focus">
        <select class=" input" name="billet_sortie" id="billet_sortie">
            <option value="1" >Oui</option>
            <option value="0" selected>Non</option>
        </select>
        <label for="billet_sortie">Reprise de bulletin de sortie</label>
        <span>Reprise de bulletin de sortie</span>
    </div>
</div>

<?php
if($agent->Contrat->designation == 'CDI'){
    ?>
    <div class="col-md-3 d-none" id="matriculeAssuranceDiv">
        <div class="input-container focus">
            <input type="text" class="input" id="matriculeAssurance" name="matriculeAssurance" >
            <label for="matriculeAssurance">Matricule assurance</label>
            <span>Matricule assurance</span>
        </div>
    </div>
    <?php
}
?>
