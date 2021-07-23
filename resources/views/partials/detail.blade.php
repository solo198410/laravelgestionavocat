<div class="card">
        <div class="card-header text-white bg-primary">
          <div class="row">
            
            <div class="col-md-8">
              <h3 class="card-title">Coordonnées</h3>
            </div>

            <div class="col-md-4 text-right">
              <button v-if="!open.detail" class="btn btn-success" v-on:click="open.detail = true">Ajouter</button>
<button v-else class="btn btn-success" v-on:click="open.detail = false">Annuler</button>
              <button v-if="!detail_show.detail" type="button" class="btn btn-light"
        v-on:click="detail_show.detail = true">Afficher</button>
        <button v-else type="button" class="btn btn-light"
        v-on:click="detail_show.detail = false">Cacher</button>
            </div>

          </div>

        </div>
        <div class="card-body">
        
<!-- form d'ajout d'une coordonné-->

<div v-if="open.detail">

<form @submit.prevent="validateFormDetail">
<div class="form-row">
  <div class="form-group col-md-4">
    
  <div class="input-group mb-3">
  <div class="input-group-prepend">
  <label  class="input-group-text" for="typedetail_id">Type</label>
  </div>
      <select class="custom-select" id="typedetail_id" name="typedetail_id" v-model="detail.typedetail_id">
      @foreach(App\Typedetail::all() as $typedetail)
      <option value="{{ $typedetail->id }}">{{ $typedetail->type }} </option>
      @endforeach
  </select>
       </div>


  </div>

  <div class="form-group col-md-4">
    <!-- <label for="value">Valeur</label> -->
      <input type="text" v-validate="'required'"
      :class="{'form-control': true, 'is-invalid':errors.has('value')}" name="value" v-model="detail.value" placeholder="">
      <div class="invalid-feedback">
      <label v-show="errors.has('value')">@{{ errors.first('value')}}</label>
      </div>
  </div>


  </div>
    
  
<div class="btn-group">
<template v-if ="edit.detail">
<button type="submit" class="btn btn-danger">Modifier
</button></template>
<template v-else>
<button type="submit" class="btn btn-info">Ajouter</button></template>
<button class="btn btn-light" @click="open.detail = false">Fermer</button></div>
</form>
</div><br>

<!-- form affichage des coordonnées -->
        
        <ul v-show="detail_show.detail" class="list-group">
            <li class="list-group-item" v-for="detail in details">
            <div class="float-right"><button class="btn btn-warning btn-sm" @click="editDetail(detail)">Editer</button>
            <button class="btn btn-danger btn-sm" @click="deleteDetail(detail)">Supprimer</button>
            </div>

            <div class="form-row">
            
            <div class="form-group col-md-4">
  <div class="input-group mb-3">
  <div class="input-group-prepend">
  <label  class="input-group-text" for="typedetail_id">Type</label>
  </div>
      <select  class="custom-select" id="typedetail_id" name="typedetail_id" v-model="detail.typedetail_id" disabled>
      @foreach(App\Typedetail::all() as $typedetail)
      <option value="{{ $typedetail->id }}">{{ $typedetail->type }} </option>
      @endforeach
  </select>
    </div>
  </div>
  
            <div class="form-group col-md-4">
    <!--<label for="value">Valeur</label> -->
      <input type="text" class="form-control" name="value" v-model="detail.value" readonly>
  </div>
  </div>
  
            </li>
        </ul>
        </div>
      </div>