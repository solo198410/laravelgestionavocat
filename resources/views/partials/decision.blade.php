<div class="card">
        <div class="card-header text-white bg-primary">
          <div class="row">
            
            <div class="col-md-8">
              <h3 class="card-title">Sort de l'Affaire</h3>
            </div>

            <div class="col-md-4 text-right">
              <template v-if="nbr_decisions === 0"><button v-if="!open.decision" class="btn btn-success" v-on:click="open.decision = true">Ajouter</button>
<button v-else class="btn btn-success" v-on:click="open.decision = false">Annuler</button></template>
<button v-if="!detail.decision" type="button" class="btn btn-light"
        v-on:click="detail.decision = true">Afficher</button>
        <button v-else type="button" class="btn btn-light"
        v-on:click="detail.decision = false">Cacher</button>
            </div>

          </div>

        </div>
        <div class="card-body">
        
<!-- form d'ajout d'une décision-->

<div v-if="open.decision">

<form @submit.prevent="validateFormDecision">

    <div class="form-group col-md-4">
    <label for="date_decision">Date de la Décisions</label>
    <input type="date" v-validate.persist="'required'"
      :class="{'form-control': true, 'is-invalid':errors.has('date_decision')}" name="date_decision" v-model="decision.date_decision">
      <div class="invalid-feedback">
      <label v-show="errors.has('date_decision')">@{{ errors.first('date_decision')}}</label>
      </div>
  
      </div>
  <div class="form-group">
  <label for="summary">Résumé</label>
  <textarea name="summary" id="summary" v-validate.persist = "'required'"
  :class="{'form-control': true, 'is-invalid':errors.has('summary')}" v-model="decision.summary"></textarea>
            <div class="invalid-feedback">
			<label v-show="errors.has('summary')">@{{ errors.first('summary')}}</label>
	  </div></div>

<div class="btn-group">
<template v-if ="edit.decision">
<button type="submit" class="btn btn-danger">Modifier
</button></template>
<template v-else>
<button type="submit" class="btn btn-info">Ajouter</button></template>
<button class="btn btn-light" @click="open.decision = false">Fermer</button></div>
</form>
</div><br>

<!-- form affichage des décisions -->

<ul v-show="detail.decision" class="list-group">
            <li class="list-group-item" v-for="decision in decisions">
            <div class="float-right"><button class="btn btn-warning btn-sm" @click="editDecision(decision)">Editer</button>
            <button class="btn btn-danger btn-sm" @click="deleteDecision(decision)">Supprimer</button>
            </div>

            <div class="form-group col-md-4">
    
    
    <label for="date_decision">Date de la Décisions</label>
    <input type="date" class="form-control" name="date_decision" v-model="decision.date_decision" readonly>
    
    </div>

    <div class="form-group">
  <label for="summary">Résumé</label>
  <textarea name="summary" id="summary" class="form-control" v-model="decision.summary" readonly></textarea>
            </div>
            </li>
        </ul>
        </div>
      </div>