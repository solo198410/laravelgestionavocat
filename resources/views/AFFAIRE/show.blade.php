@extends('layouts.app')

@section('content')

<div class="container" id="app">
  <div class="row">
    <div class="col-md-12">
      <!--module experiences-->
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
      <input type="text" v-validate.persist="'required|min:3'" 
      :class="{'form-control': true, 'is-invalid':errors.has('first_name')}" name="first_name" v-model="client.first_name" placeholder="name ...">
      <div class="invalid-feedback">
      <label v-show="errors.has('first_name')">@{{ errors.first('first_name')}}</label>
      </div>
    </div>
    <div class="form-group col-md-4">
      <label for="last_name">Prénom</label>
      <input type="text" class="form-control" name="last_name" v-model="client.last_name" placeholder="prénom ...">
    </div>
	
  <div class="form-group col-md-4">
      <label for="birthday">Date Naissance</label>
      <input v-validate.persist = "'required'" type="date" class="form-control" name="birthday" v-model="client.birthday">
      <label v-show="errors.has('birthday')">@{{ errors.first('birthday')}}</label>
    </div>
  </div>
  
  <div class="form-group col-md-6">
  <div class="input-group mb-3">
  <div class="input-group-prepend">
  <label  class="input-group-text" for="type">Type</label>
  </div>
      <select  v-validate.persist = "'required'" class="custom-select" id="type" name="type" v-model="client.type">
      <option value="" selected>Choisissez...</option>
      <option value="demandeur">demandeur</option>
    <option value="défendeur">défendeur</option>
    <option value="accusé">accusé</option>
	<option value="autre">autre</option>
  </select>
      <label v-show="errors.has('type')">@{{ errors.first('type')}}</label>
    </div>
  </div>
  
  <div class="form-group">
    <label for="domicile">Addresse</label>
    <input type="text" class="form-control" name="domicile" v-model="client.domicile" placeholder="1234 Main St">
  </div>
    <div class="form-row">
    <div class="form-group col-md-4">
      <label for="father_name">Prénom du père</label>
      <input type="text" class="form-control" name="father_name" v-model="client.father_name" placeholder="prénom du père ...">
    </div>
    <div class="form-group col-md-4">
      <label for="mother_first_name">Nom de la Mère</label>
      <input type="text" class="form-control" name="mother_first_name" v-model="client.mother_first_name" placeholder="nom de la mère ...">
    </div>
	<div class="form-group col-md-4">
      <label for="mother_last_name">Prénom de la mère</label>
      <input type="text" class="form-control" name="mother_last_name" v-model="client.mother_last_name" placeholder="prénom de la mère ...">
    </div>
  </div>
  
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
  <label  class="input-group-text" for="type">Type</label>
  </div>
      <select  v-validate.persist = "'required'" class="custom-select" id="type" name="type" v-model="client.type">
      <option value="" selected>Choisissez...</option>
      <option value="demandeur">demandeur</option>
    <option value="défendeur">défendeur</option>
    <option value="accusé">accusé</option>
	<option value="autre">autre</option>
  </select>
      <label v-show="errors.has('type')">@{{ errors.first('type')}}</label>
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
            <div dic class="float-right"><button class="btn btn-warning btn-sm" @click="editClient(client)">Editer</button>
            <button class="btn btn-danger btn-sm" @click="deleteClient(client)">Supprimer</button>
            </div>
            
            <div v-if="client.is_moral == 0">
  <h3><span class="badge badge-secondary">Personne Physique</span></h3>
  <div class="form-group row">
    <label for="fullname" class="col-sm-2 col-form-label">Nom et prénom</label>
    <div class="col-sm-3">
    <input class="form-control" type="text" v-model="client.first_name + '    ' + client.last_name" readonly> </div>
    <label for="birthday" class="col-sm-2 col-form-label">Date de Naissance</label>
    <div class="col-sm-2">
    <input class="form-control" type="text" v-model="client.birthday" readonly> </div>

    <label for="type" class="col-sm-1 col-form-label">Type</label>
    <div class="col-sm-2">
    <input class="form-control" type="text" v-model="client.type" readonly> </div>
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
    
    <div class="form-group row">
    <label for="type" class="col-sm-2 col-form-label">Type</label>
    <div class="col-sm-2">
    <input class="form-control" type="text" v-model="client.type" readonly> </div></div>
    
    
    </div>
            </li>
        </ul>
        </div>
      </div>
<br>
      
      <!-- adversaires-->

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
      <input v-validate.persist = "'required'" type="text" class="form-control" name="first_name" v-model="adversaire.first_name" placeholder="name ...">
      <label v-show="errors.has('first_name')">@{{ errors.first('first_name')}}</label>
      </div>
    <div class="form-group col-md-4">
      <label for="last_name">Prénom</label>
      <input v-validate.persist = "'required'" type="text" class="form-control" name="last_name" v-model="adversaire.last_name" placeholder="prénom ...">
      <label v-show="errors.has('last_name')">@{{ errors.first('last_name')}}</label>
    </div>
	<div class="form-group col-md-4">
      <label for="birthday">Date Naissance</label>
      <input v-validate.persist = "'required'" type="date" class="form-control" name="birthday" v-model="adversaire.birthday">
      <label v-show="errors.has('birthday')">@{{ errors.first('birthday')}}</label>
    </div>
  </div>
  <div class="form-group col-md-6">
  <div class="input-group mb-3">
  <div class="input-group-prepend">
  <label  class="input-group-text" for="type">Type</label>
  </div>
      <select  v-validate.persist = "'required'" class="custom-select" id="type" name="type" v-model="client.type">
      <option value="" selected>Choisissez...</option>
      <option value="demandeur">demandeur</option>
    <option value="défendeur">défendeur</option>
    <option value="accusé">accusé</option>
	<option value="autre">autre</option>
  </select>
      <label v-show="errors.has('type')">@{{ errors.first('type')}}</label>
    </div>
  </div>

  <div class="form-group">
    <label for="domicile">Addresse</label>
    <input type="text" class="form-control" id="domicile" v-model="adversaire.domicile" placeholder="1234 Main St">
  </div>
    
    <div class="form-row">
    <div class="form-group col-md-4">
      <label for="father_name">Prénom du père</label>
      <input type="text" class="form-control" id="father_name" v-model="adversaire.father_name" placeholder="prénom du père ...">
    </div>
    <div class="form-group col-md-4">
      <label for="mother_first_name">Nom de la Mère</label>
      <input type="text" class="form-control" id="mother_first_name" v-model="adversaire.mother_first_name" placeholder="nom de la mère ...">
    </div>
	<div class="form-group col-md-4">
      <label for="mother_last_name">Prénom de la mère</label>
      <input type="text" class="form-control" id="mother_last_name" v-model="adversaire.mother_last_name" placeholder="prénom de la mère ...">
    </div>
  </div>
  
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
  <label  class="input-group-text" for="type">Type</label>
  </div>
      <select  v-validate.persist = "'required'" class="custom-select" id="type" name="type" v-model="client.type">
      <option value="" selected>Choisissez...</option>
      <option value="demandeur">demandeur</option>
    <option value="défendeur">défendeur</option>
    <option value="accusé">accusé</option>
	<option value="autre">autre</option>
  </select>
      <label v-show="errors.has('type')">@{{ errors.first('type')}}</label>
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
    <label for="fullname" class="col-sm-2 col-form-label">Nom et prénom</label>
    <div class="col-sm-3">
    <input class="form-control" type="text" v-model="adversaire.first_name + '    ' + adversaire.last_name" readonly> </div>
    <label for="birthday" class="col-sm-2 col-form-label">Date de Naissance</label>
    <div class="col-sm-2">
    <input class="form-control" type="text" v-model="adversaire.birthday" readonly> </div>
    
    <label for="type" class="col-sm-1 col-form-label">Type</label>
    <div class="col-sm-2">
    <input class="form-control" type="text" v-model="client.type" readonly> </div>
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
    <div class="form-group row">
    <label for="type" class="col-sm-2 col-form-label">Type</label>
    <div class="col-sm-2">
    <input class="form-control" type="text" v-model="client.type" readonly> </div></div>
    </div>
            </li>
        </ul>
        </div>
      </div>

<br>

<!-- Seances -->

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

  <div class="form-group">
    <label for="subject">Objet de la Séance</label>
      <input type="text" v-validate="'required'"
      :class="{'form-control': true, 'is-invalid':errors.has('subject')}" name="subject" v-model="seance.subject" placeholder="subject ...">
      <div class="invalid-feedback">
      <label v-show="errors.has('subject')">@{{ errors.first('subject')}}</label>
      </div>
  </div>
    <div class="form-group">
    <label for="content">Description</label>
      <textarea v-validate="'required'"
      :class="{'form-control': true, 'is-invalid':errors.has('content')}" name="content" v-model="seance.content" placeholder="content ..."></textarea>
      <div class="invalid-feedback">
      <label v-show="errors.has('content')">@{{ errors.first('content')}}</label>
      </div>
  </div>
  <div class="form-group">
  <label for="date_seance">Date de la séance</label>
      <input v-validate = "'required'" type="date" name="date_seance"
:class="{'form-control': true, 'is-invalid':errors.has('date_seance')}"	  v-model="seance.date_seance">
            <div class="invalid-feedback">
			<label v-show="errors.has('date_seance')">@{{ errors.first('date_seance')}}</label>
	  </div></div>
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

  <div class="form-group">
    <label for="subject">Objet de la Séance</label>
      <input type="text" class="form-control" name="subject" v-model="seance.subject" readonly>
  </div>
  
      <div class="form-group">
    <label for="content">Description</label>
      <textarea class="form-control"
       name="content" v-model="seance.content" readonly></textarea>
  </div>
  <div class="form-group">
  <label for="date_seance">Date de la séance</label>
      <input type="text" name="date_seance"
class="form-control" v-model="seance.date_seance" readonly>
</div>
            </li>
        </ul>
        </div>
      </div>
      <br>

<!-- Décisions -->

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

    <div class="form-group row">
    <label for="date_decision" class="col-sm-3 col-form-label">Date de la Décisions</label>
    <div class="col-sm-3">
    <input type="date" v-validate.persist="'required'"
      :class="{'form-control': true, 'is-invalid':errors.has('date_decision')}" name="date_decision" v-model="decision.date_decision">
      <div class="invalid-feedback">
      <label v-show="errors.has('date_decision')">@{{ errors.first('date_decision')}}</label>
      </div></div>
  <label  class="col-sm-3 col-form-label" for="type">Type</label>
  <div class="col-sm-3">
      <select  v-validate.persist = "'required'" :class="{'custom-select': true, 'is-invalid':errors.has('type')}"
      id="type" name="type" v-model="decision.type">
      <option value="" selected>Choisissez...</option>
      <option value="jugement">jugement</option>
    <option value="décision">décision</option>
	<option value="autre">autre</option>
  </select>
  <div class="invalid-feedback">
  <label v-show="errors.has('type')">@{{ errors.first('type')}}</label>
      </div></div>
      </div>
    <div class="form-group">
    <label for="decision">Décision</label>
      <input type="text" v-validate.persist="'required'"
      :class="{'form-control': true, 'is-invalid':errors.has('decision')}" name="decision" v-model="decision.decision" placeholder="decision ...">
      <div class="invalid-feedback">
      <label v-show="errors.has('decision')">@{{ errors.first('decision')}}</label>
      </div>
  </div>
  <div class="form-group">
  <label for="summary">Résumé</label>
      <input type ="text" v-validate.persist = "'required'" name="summary"
:class="{'form-control': true, 'is-invalid':errors.has('summary')}"	  v-model="decision.summary">
            <div class="invalid-feedback">
			<label v-show="errors.has('summary')">@{{ errors.first('summary')}}</label>
	  </div></div>
	  
	  <div class="form-group">
  <label for="authority">Autorité</label>
      <input type="text" v-validate.persist = "'required'" name="authority"
:class="{'form-control': true, 'is-invalid':errors.has('authority')}"	  v-model="decision.authority">
            <div class="invalid-feedback">
			<label v-show="errors.has('authority')">@{{ errors.first('authority')}}</label>
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

            <div class="form-group row">
    
    
    <label for="date_decision" class="col-sm-3 col-form-label">Date de la Décisions</label>
    <div class="col-sm-3">
    <input type="date" class="form-control" name="date_decision" v-model="decision.date_decision" readonly>
  </div>
  <label for="type" class="col-sm-2 col-form-label">Type</label>
    <div class="col-sm-2">
    <input class="form-control" type="text" v-model="decision.type" readonly></div>
    
    </div>


    <div class="form-group">
    <label for="decision">Décision</label>
      <input type="text" class="form-control" name="decision" v-model="decision.decision" readonly>
  </div>
  <div class="form-group">
  <label for="summary">Résumé</label>
      <input type="text" class="form-control" name="summary" v-model="decision.summary" readonly>
            </div>
	  
	  <div class="form-group">
  <label for="authority">Autorité</label>
      <input type="text" class="form-control" name="authority" v-model="decision.authority" readonly>
            </div>
            </li>
        </ul>
        </div>
      </div>
      <br/>

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
            <!--<li class="list-group-item" v-for="frai in frais">-->
            <!--<div class="float-right"><button class="btn btn-warning btn-sm" @click="editFrai(frai)">Editer</button>
            <button class="btn btn-danger btn-sm" @click="deleteFrai(frai)">Supprimer</button>
            </div>-->

  <!--<div class="form-group">
    <label for="montant_total">montant total</label>
      <input type="text" class="form-control" name="montant_total" v-model="frai.montant_total" readonly>
  </div>
  
<div class="form-row">
<div class="form-group col-md-4">
    <label for="versement">Versement</label>
      <input type="text" class="form-control" name="versement" v-model="frai.versement" readonly>
  </div>
  <div class="form-group col-md-4">
  <label for="date_versement">Date versement</label>
      <input type="date" name="date_versement"
class="form-control" v-model="frai.date_versement" readonly>
</div>
<div class="form-group col-md-4">
  <label for="reste">Reste à Payer</label>
      <input type="text" name="reste"
class="form-control" v-model="frai.reste" readonly>
</div>
</div>
            </li>-->			
        </ul>
        </div>
      </div>
      <br>

      </div>
	  </div>
	  </div>

<br>



@endsection

@section('javascripts')

<script src="{{ asset('js/vue.js') }}"></script>
<script src="{{ asset('js/veeValidate.js') }}"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script>

Vue.use(VeeValidate);


window.Laravel = {!! json_encode([
      'csrfToken' => csrf_token(),
      'idAffaire' => $id,
      'url' => url('/')
      //'url_'        => url()->previous(),
      //'user_id'     =>auth()->user()->id
    ]) !!};
    
</script>

<script src="{{ asset('js/script.js') }}"></script>
@endsection