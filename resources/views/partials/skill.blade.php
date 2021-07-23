<div class="card">
        <div class="card-header text-white bg-primary">
          <div class="row">
            
            <div class="col-md-8">
              <h3 class="card-title">Domaines de compétences</h3>
            </div>

            <div class="col-md-4 text-right">
              <button v-if="!open.skill" class="btn btn-success" v-on:click="open.skill = true">Ajouter</button>
<button v-else class="btn btn-success" v-on:click="open.skill = false">Annuler</button>
              <button v-if="!detail_show.skill" type="button" class="btn btn-light"
        v-on:click="detail_show.skill = true">Afficher</button>
        <button v-else type="button" class="btn btn-light"
        v-on:click="detail_show.skill = false">Cacher</button>
            </div>

          </div>

        </div>
        <div class="card-body">
        
<!-- form d'ajout d'une compétence-->

<div v-if="open.skill">

<form @submit.prevent="validateFormSkill">
<div class="form-row">
  <div class="form-group col-md-4">
    <label for="description">Description</label>
      <input type="text" v-validate="'required'"
      :class="{'form-control': true, 'is-invalid':errors.has('description')}" name="description" v-model="skill.description" placeholder="Compétence ...">
      <div class="invalid-feedback">
      <label v-show="errors.has('description')">@{{ errors.first('description')}}</label>
      </div>
  </div>
  </div>
    
  
<div class="btn-group">
<template v-if ="edit.skill">
<button type="submit" class="btn btn-danger">Modifier
</button></template>
<template v-else>
<button type="submit" class="btn btn-info">Ajouter</button></template>
<button class="btn btn-light" @click="open.skill = false">Fermer</button></div>
</form>
</div><br>

<!-- form affichage des compétences -->
        
        <ul v-show="detail_show.skill" class="list-group">
            <li class="list-group-item" v-for="skill in skills">
            <div class="float-right"><button class="btn btn-warning btn-sm" @click="editSkill(skill)">Editer</button>
            <button class="btn btn-danger btn-sm" @click="deleteSkill(skill)">Supprimer</button>
            </div>

            <div class="form-row">
            
            
            <div class="form-group col-md-4">
    <label for="description">Description</label>
      <input type="text" class="form-control" name="description" v-model="skill.description" readonly>
  </div>
  </div>
  
            </li>
        </ul>
        </div>
      </div>