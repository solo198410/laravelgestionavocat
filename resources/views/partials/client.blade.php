<div class="card">
        <div class="card-header text-white bg-primary">
          <div class="row">
            
            <div class="col-md-8">
              <h3 class="card-title">Clients</h3>
            </div>

            <div class="col-md-4 text-right">
<button v-if="!open.client" class="btn btn-success" v-on:click="open.client = true">Ajouter</button>
<button v-else class="btn btn-success" v-on:click="open.client = false">Annuler</button>
<button v-if="!detail.client" type="button" class="btn btn-light"
        v-on:click="detail.client = true">Afficher</button>
        <button v-else type="button" class="btn btn-light"
        v-on:click="detail.client = false">Cacher</button>
            </div>
          </div>

        </div>

        <div class="card-body">

<!-- form d'ajout d'un client-->

<div v-if="open.client">
<div v-show="client.is_moral == 2">
<label for="">Type du Client</label>
<select v-model="client.is_moral">
<option disabled value = 2> Choisissez</option> 
<option value = 0> Personne Physique</option> 
<option value = 1> Personne morale</option>
</select>
</div>
<form @submit.prevent="validateFormClient">
<div v-if="client.is_moral == 0">
<div class="form-row">
    <div class="form-group col-md-4">
      <label for="first_name">Nom</label>
      <input type="text" class="form-control" name="first_name" v-model="client.first_name" placeholder="name ...">
    </div>
    <div class="form-group col-md-4">
      <label for="last_name">Prénom</label>
      <input type="text" class="form-control" name="last_name" v-model="client.last_name" placeholder="prÃ©nom ...">
    </div>
	
  <div class="form-group col-md-4">
      <label for="birthday">Date Naissance</label>
      <input type="date" class="form-control" name="birthday" v-model="client.birthday">
    </div>
  </div>
  
  <div class="form-group col-md-6">
  <div class="input-group mb-3">
  <div class="input-group-prepend">
  <label  class="input-group-text" for="type_id">Type</label>
  </div>
      <select  class="custom-select" id="type_id" name="type_id" v-model="client.type_id">
      @foreach(App\Type::all() as $type)
      <option value="{{ $type->id }}">{{ $type->type }} </option>
      @endforeach
  </select>
    </div>
  </div>
  
  <div class="form-group">
    <label for="domicile">Addresse</label>
    <input type="text" class="form-control" name="domicile" v-model="client.domicile" placeholder="@">
  </div>

  <!--
    <div class="form-row">
    <div class="form-group col-md-4">
      <label for="father_name">Prénom du père</label>
      <input type="text" class="form-control" name="father_name" v-model="client.father_name" placeholder="prÃ©nom du pÃ¨re ...">
    </div>
    <div class="form-group col-md-4">
      <label for="mother_first_name">Nom de la Mère</label>
      <input type="text" class="form-control" name="mother_first_name" v-model="client.mother_first_name" placeholder="nom de la mÃ¨re ...">
    </div>
	<div class="form-group col-md-4">
      <label for="mother_last_name">Prénom de la mère</label>
      <input type="text" class="form-control" name="mother_last_name" v-model="client.mother_last_name" placeholder="prÃ©nom de la mÃ¨re ...">
    </div>
  </div>
  -->
    </div>
	<div v-if="client.is_moral == 1">
	
        <div class="form-group">
    <label for="moral_person_name">Personne morale</label>
      <input type="text" class="form-control" name="moral_person_name" v-model="client.moral_person_name" placeholder="Nom personne morale ...">
  </div>
  <div class="form-group">
    <label for="moral_person_description">Description</label>
      <textarea class="form-control" name="moral_person_description" v-model="client.moral_person_description" placeholder="Description ..."></textarea>
  </div>
  
  <div class="form-group col-md-4">
  <div class="input-group mb-3">
  <div class="input-group-prepend">
  <label  class="input-group-text" for="type_id">Type</label>
  </div>
      <select class="custom-select" id="type_id" name="type_id" v-model="client.type_id">
      @foreach(App\Type::all() as $type)
      <option value="{{ $type->id }}">{{ $type->type }} </option>
      @endforeach
  </select>
       </div>
  </div>
</div>
<div v-if = "client.is_moral != 2">
<div class="btn-group">
<template v-if ="edit.client">
<button type="submit" class="btn btn-danger">Modifier
</button></template>
<template v-else>
<button type="submit" class="btn btn-info">Ajouter</button></template>
<button class="btn btn-light" @click="open.client = false">Fermer</button></div></div>
</form>
</div><br>

<!-- form affichage des clients -->
        <ul v-show="detail.client" class="list-group">
            <li class="list-group-item" v-for="client in clients">
            <div class="float-right"><button class="btn btn-warning btn-sm" @click="editClient(client)">Editer</button>
            <button class="btn btn-danger btn-sm" @click="deleteClient(client)">Supprimer</button>
            </div>
            
            <div v-if="client.is_moral == 0">
  <h3><span class="badge badge-secondary">Personne Physique</span></h3>
  <div class="form-group row">
    <label for="fullname" class="col-form-label">Nom et prénom</label>
    <div class="col-sm-3">
    <input class="form-control" type="text" v-model="client.first_name + '    ' + client.last_name" readonly> </div>
    <label for="birthday" class="col-form-label">Date de Naissance</label>
    <div class="col-sm-2">
    <input class="form-control" type="text" v-model="client.birthday" readonly> </div>

    <div class="form-group col-md-4">
  <div class="input-group mb-3">
  <div class="input-group-prepend">
  <label  class="input-group-text" for="type_id">Type</label>
  </div>
      <select  class="custom-select" id="type_id" name="type_id" v-model="client.type_id" disabled>
      @foreach(App\Type::all() as $type)
      <option value="{{ $type->id }}">{{ $type->type }} </option>
      @endforeach
  </select>
    </div>
  </div>

    </div>


    </div>
    <div v-if="client.is_moral == 1">
    <h3><span class="badge badge-secondary">Personne Morale</span></h3>
    <div class="form-group row">
    <label for="moral_person_name" class="col-sm-2 col-form-label">Personne Morale</label>
    <div class="col-sm-6">
    <input class="form-control" type="text" name="moral_person_name" v-model="client.moral_person_name" readonly> </div>
    </div>
    <div class="form-group row">
    <label for="moral_person_description" class="col-sm-2 col-form-label">Description</label>
    <div class="col-sm-10">
    <input class="form-control" type="text" name="moral_person_description" v-model="client.moral_person_description" readonly> </div>
    </div>
    
    
    
    <div class="form-group col-md-4">
  <div class="input-group mb-3">
  <div class="input-group-prepend">
  <label  class="input-group-text" for="type_id">Type</label>
  </div>
      <select  class="custom-select" id="type_id" name="type_id" v-model="client.type_id" disabled>
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