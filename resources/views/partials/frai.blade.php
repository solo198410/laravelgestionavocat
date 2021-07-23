<div class="card">
        <div class="card-header text-white bg-primary">
          <div class="row">
            
            <div class="col-md-8">
              <h3 class="card-title">Frais</h3>
            </div>

            <div class="col-md-4 text-right">
              <button v-if="!open.frai" class="btn btn-success" v-on:click="open.frai = true">Ajouter</button>
<button v-else class="btn btn-success" v-on:click="open.frai = false">Annuler</button>
              <button v-if="!detail.frai" type="button" class="btn btn-light"
        v-on:click="detail.frai = true">Afficher</button>
        <button v-else type="button" class="btn btn-light"
        v-on:click="detail.frai = false">Cacher</button>
            </div>

          </div>

        </div>
        <div class="card-body">
        
<!-- form d'ajout d'un frais-->

<div v-if="open.frai">

<form @submit.prevent="validateFormFrai">

  <div class="form-row"><div class="form-group col-md-4">
    <label for="montant_total">Montant Total</label>
      <input type="text" class="form-control" name="montant_total" v-model="frai.montant_total" readonly>
  </div>
  <div class="form-group col-md-4">
    <label for="total_versement">Montant versé</label>
      <input type="text" class="form-control" name="total_versement" v-model="total_versement" readonly>
  </div>
  <div class="form-group col-md-4">
    <label for="reste_a_payer">Reste à payer</label>
      <input type="text" class="form-control" name="reste_a_payer" v-model="reste_a_payer" readonly>
  </div>
  </div>
  <div class="form-group col-md-4">
  <label for="versement">Nouveau versement</label>
      <input v-validate = "'required'" type="text" name="versement"
:class="{'form-control': true, 'is-invalid':errors.has('versement')}"	  v-model="frai.versement">
            <div class="invalid-feedback">
			<label v-show="errors.has('versement')">@{{ errors.first('versement')}}</label>
	  </div></div>
	  
<div class="btn-group">
<template v-if ="edit.frai">
<button type="submit" class="btn btn-danger">Modifier
</button></template>
<template v-else>
<button type="submit" class="btn btn-info">Ajouter</button></template>
<button class="btn btn-light" @click="open.frai = false">Fermer</button></div>
</form>
</div><br>

<!-- form affichage des frais -->
        
        <ul v-show="detail.frai" class="list-group">
            
        <p><span>montant total: @{{ frais_affaire }}</span><br/>
        <span>reste à payer: @{{ reste_a_payer }}</span></p>
        <table class="table">
            <thead><tr><th>Versement</th>
            <th>date versement</th></tr></thead>
            <tbody>
            <tr v-for="frai in frais">
            <td>@{{ frai.versement }}</td>
            <td>@{{ frai.date_versement }}</td></tr></tbody>
            </table>			
        </ul>
        </div>
      </div>