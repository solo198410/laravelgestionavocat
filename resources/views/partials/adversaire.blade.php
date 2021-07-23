<div class="card">
        <div class="card-header text-white bg-primary">
          <div class="row">
            
            <div class="col-md-8">
              <h3 class="card-title">Adversaires</h3>
            </div>

            <div class="col-md-4 text-right">
              <button v-if="!open.adversaire" class="btn btn-success" v-on:click="open.adversaire = true">Ajouter</button>
<button v-else class="btn btn-success" v-on:click="open.adversaire = false">Annuler</button>


<button v-if="!detail.adversaire" type="button" class="btn btn-light"
        v-on:click="detail.adversaire = true">Afficher</button>
        <button v-else type="button" class="btn btn-light"
        v-on:click="detail.adversaire = false">Cacher</button>
            </div>

          </div>

        </div>
        <div class="card-body">
        
<!-- form d'ajout d'un adversaire -->

<div v-if="open.adversaire">
<div v-show="adversaire.is_moral == 2">
<label for="">Type de l'Adversaire</label>
<select v-model="adversaire.is_moral">
<option disabled value = 2> Choisissez</option> 
<option value = 0> Personne Physique</option> 
<option value = 1> Personne morale</option>
</select>
</div>
<form @submit.prevent="validateFormAdversaire">
<div v-if="adversaire.is_moral == 0">
<div class="form-row">
    <div class="form-group col-md-4">
      <label for="first_name">Nom</label>
      <input type="text" class="form-control" id="first_name" v-model="adversaire.first_name" placeholder="name ...">
    </div>
    <div class="form-group col-md-4">
      <label for="last_name">Prénom</label>
      <input type="text" class="form-control" id="last_name" v-model="adversaire.last_name" placeholder="prÃ©nom ...">
    </div>
	<div class="form-group col-md-4">
      <label for="birthday">Date Naissance</label>
      <input type="date" class="form-control" id="birthday" v-model="adversaire.birthday">
    </div>
  </div>

  <div class="form-group col-md-6">
  <div class="input-group mb-3">
  <div class="input-group-prepend">
  <label  class="input-group-text" for="type_id">Type</label>
  </div>
      <select class="custom-select" id="type_id" name="type_id" v-model="adversaire.type_id">
      @foreach(App\Type::all() as $type)
      <option value="{{ $type->id }}">{{ $type->type }} </option>
      @endforeach
  </select>
    </div>
  </div>

  <div class="form-group">
    <label for="domicile">Addresse</label>
    <input type="text" class="form-control" id="domicile" v-model="adversaire.domicile" placeholder="1234 Main St">
  </div>
    <!--
    <div class="form-row">
    <div class="form-group col-md-4">
      <label for="father_name">Prénom du père</label>
      <input type="text" class="form-control" id="father_name" v-model="adversaire.father_name" placeholder="prÃ©nom du pÃ¨re ...">
    </div>
    <div class="form-group col-md-4">
      <label for="mother_first_name">Nom de la Mère</label>
      <input type="text" class="form-control" id="mother_first_name" v-model="adversaire.mother_first_name" placeholder="nom de la mÃ¨re ...">
    </div>
	<div class="form-group col-md-4">
      <label for="mother_last_name">Prénom de la mère</label>
      <input type="text" class="form-control" id="mother_last_name" v-model="adversaire.mother_last_name" placeholder="prÃ©nom de la mÃ¨re ...">
    </div>
  </div>
  -->
    </div>
	<div v-if="adversaire.is_moral == 1">
	
        <div class="form-group">
    <label for="moral_person_name">Personne morale</label>
      <input type="text" class="form-control" id="moral_person_name" v-model="adversaire.moral_person_name" placeholder="Nom personne morale ...">
  </div>
  <div class="form-group">
    <label for="moral_person_description">Description</label>
      <textarea class="form-control" id="moral_person_description" v-model="adversaire.moral_person_description" placeholder="Description ..."></textarea>
  </div>

  <div class="form-group col-md-6">
  <div class="input-group mb-3">
  <div class="input-group-prepend">
  <label  class="input-group-text" for="type_id">Type</label>
  </div>
      <select class="custom-select" id="type_id" name="type_id" v-model="adversaire.type_id">
      @foreach(App\Type::all() as $type)
      <option value="{{ $type->id }}">{{ $type->type }} </option>
      @endforeach
  </select>
    </div>
  </div>

</div>
<div v-if = "adversaire.is_moral != 2">
<div class="btn-group">
<template v-if ="edit.adversaire">
<button type="submit" class="btn btn-danger">Modifier
</button></template>
<template v-else>
<button type="submit" class="btn btn-info">Ajouter</button></template>
<button class="btn btn-light" @click="open.adversaire = false">Fermer</button></div>
</div>
</form>
	</div><br>
<!-- form affichage des adversaires -->
        
        
        <ul v-show="detail.adversaire" class="list-group">
            <li class="list-group-item" v-for="adversaire in adversaires">
            <div dic class="float-right"><button class="btn btn-warning btn-sm" @click="editAdversaire(adversaire)">Editer</button>
            <button class="btn btn-danger btn-sm" @click="deleteAdversaire(adversaire)">Supprimer</button>
            </div>
            
            <div v-if="adversaire.is_moral == 0">
  <h3><span class="badge badge-secondary">Personne Physique</span></h3>
  <div class="form-group row">
    <label for="fullname" class="col-form-label">Nom et prénom</label>
    <div class="col-sm-3">
    <input class="form-control" type="text" v-model="adversaire.first_name + '    ' + adversaire.last_name" readonly> </div>
    <label for="birthday" class="col-form-label">Date de Naissance</label>
    <div class="col-sm-2">
    <input class="form-control" type="text" v-model="adversaire.birthday" readonly> </div>
    
    <div class="form-group col-md-4">
  <div class="input-group mb-3">
  <div class="input-group-prepend">
  <label  class="input-group-text" for="type_id">Type</label>
  </div>
      <select  class="custom-select" id="type_id" name="type_id" v-model="adversaire.type_id" disabled>
      @foreach(App\Type::all() as $type)
      <option value="{{ $type->id }}">{{ $type->type }} </option>
      @endforeach
  </select>
    </div>
  </div>
    </div>
    </div>
    <div v-if="adversaire.is_moral == 1">
    <h3><span class="badge badge-secondary">Personne Morale</span></h3>
    <div class="form-group row">
    <label for="moral_person_name" class="col-sm-2 col-form-label">Personne Morale</label>
    <div class="col-sm-6">
    <input class="form-control" type="text" name="moral_person_name" v-model="adversaire.moral_person_name" readonly> </div>
    </div>
    <div class="form-group row">
    <label for="moral_person_description" class="col-sm-2 col-form-label">Description</label>
    <div class="col-sm-10">
    <input class="form-control" type="text" name="moral_person_description" v-model="adversaire.moral_person_description" readonly> </div>
    </div>
    
    
    <div class="form-group col-md-4">
  <div class="input-group mb-3">
  <div class="input-group-prepend">
  <label  class="input-group-text" for="type_id">Type</label>
  </div>
      <select  class="custom-select" id="type_id" name="type_id" v-model="adversaire.type_id" disabled>
      @foreach(App\Type::all() as $type)
      <option value="{{ $type->id }}">{{ $type->type }} </option>
      @endforeach
  </select>
    </div>
  </div>

  
    </div>
            </li>
        </ul>
        </div>
      </div>
