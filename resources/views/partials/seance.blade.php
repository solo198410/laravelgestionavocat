<div class="card">
        <div class="card-header text-white bg-primary">
          <div class="row">
            
            <div class="col-md-8">
              <h3 class="card-title">Seances</h3>
            </div>

            <div class="col-md-4 text-right">
              <button v-if="!open.seance" class="btn btn-success" v-on:click="open.seance = true">Ajouter</button>
<button v-else class="btn btn-success" v-on:click="open.seance = false">Annuler</button>
              <button v-if="!detail.seance" type="button" class="btn btn-light"
        v-on:click="detail.seance = true">Afficher</button>
        <button v-else type="button" class="btn btn-light"
        v-on:click="detail.seance = false">Cacher</button>
            </div>

          </div>

        </div>
        <div class="card-body">
        
<!-- form d'ajout d'une séance-->

<div v-if="open.seance">

<form @submit.prevent="validateFormSeance">
<div class="form-row">
  <div class="form-group col-md-4">
    <label for="subject">Objet de la Séance</label>
      <input type="text" v-validate="'required'"
      :class="{'form-control': true, 'is-invalid':errors.has('subject')}" name="subject" v-model="seance.subject" placeholder="subject ...">
      <div class="invalid-feedback">
      <label v-show="errors.has('subject')">@{{ errors.first('subject')}}</label>
      </div>
  </div>
  <div class="form-group col-md-4">
  <label for="date_seance">Date de la séance</label>
      <input v-validate = "'required'" type="date" name="date_seance"
:class="{'form-control': true, 'is-invalid':errors.has('date_seance')}"	  v-model="seance.date_seance">
            <div class="invalid-feedback">
			<label v-show="errors.has('date_seance')">@{{ errors.first('date_seance')}}</label>
	  </div></div></div>
    <div class="form-group">
    <label for="content">Description</label>
      <textarea v-validate="'required'"
      :class="{'form-control': true, 'is-invalid':errors.has('content')}" name="content" v-model="seance.content" placeholder="content ..."></textarea>
      <div class="invalid-feedback">
      <label v-show="errors.has('content')">@{{ errors.first('content')}}</label>
      </div>
  </div>
  
<div class="btn-group">
<template v-if ="edit.seance">
<button type="submit" class="btn btn-danger">Modifier
</button></template>
<template v-else>
<button type="submit" class="btn btn-info">Ajouter</button></template>
<button class="btn btn-light" @click="open.seance = false">Fermer</button></div>
</form>
</div><br>

<!-- form affichage des séances -->
        
        <ul v-show="detail.seance" class="list-group">
            <li class="list-group-item" v-for="seance in seances">
            <div class="float-right"><button class="btn btn-warning btn-sm" @click="editSeance(seance)">Editer</button>
            <button class="btn btn-danger btn-sm" @click="deleteSeance(seance)">Supprimer</button>
            </div>

            <div class="form-row">
            
            
            <div class="form-group col-md-4">
    <label for="subject">Objet de la Séance</label>
      <input type="text" class="form-control" name="subject" v-model="seance.subject" readonly>
  </div>
  <div class="form-group col-md-4">
  <label for="date_seance">Date de la séance</label>
      <input type="text" name="date_seance"
class="form-control" v-model="seance.date_seance" readonly>
</div></div>

      <div class="form-group">
    <label for="content">Description</label>
      <textarea class="form-control"
       name="content" v-model="seance.content" readonly></textarea>
  </div>
  
            </li>
        </ul>
        </div>
      </div>