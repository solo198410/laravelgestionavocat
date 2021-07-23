var app = new Vue({
    el: '#app',
    data: {
        clients: [],
        adversaires: [],
        seances: [],
        decisions: [],
        frais: [],
        open: {
            client: false,
            adversaire: false,
            seance: false,
            decision: false,
            frai: false
        },
        client: {
            id: 0,
            affaire_id: window.Laravel.idAffaire,
            is_adversaire: '',
            is_moral: 2,
            first_name: '',
            last_name: '',
            birthday: '',
            type_id: '',
            domicile: '',
            father_name: '',
            mother_first_name: '',
            mother_last_name: '',
            moral_person_name: '',
            moral_person_description: ''
        },
        adversaire: {
            id: 0,
            affaire_id: window.Laravel.idAffaire,
            is_adversaire: '',
            is_moral: 2,
            first_name: '',
            last_name: '',
            birthday: '',
            type_id: '',
            domicile: '',
            father_name: '',
            mother_first_name: '',
            mother_last_name: '',
            moral_person_name: '',
            moral_person_description: ''
        },
        seance: {
            id: 0,
            affaire_id: window.Laravel.idAffaire,
            subject: '',
            content: '',
            date_seance: ''
        },
        decision: {
            id: 0,
            affaire_id: window.Laravel.idAffaire,
            date_decision: '',
            summary: '',
            authority: '',
            //location1: '',
            //location2: '',
            type: ''
        },
        frai: {
            id: 0,
            affaire_id: window.Laravel.idAffaire,
            montant_total: '',
            versement: '',
            date_versement: ''
            //reste: ''
        },
        frais_affaire: 0,
        total_versement: 0,
        reste_a_payer: 0,
        nbr_decisions: 0,
        edit: {
            client: false,
            adversaire: false,
            seance: false,
            decision: false,
            frai: false
        },
        detail: {
            client: false,
            adversaire: false,
            seance: false,
            decision: false,
            frai: false
        }
    },
    methods: {
        /*getClients: function () {
            axios.get(window.Laravel.url + '/getclients/' + window.Laravel.idAffaire)
                .then(response => {
                    console.log('response: ', response);
                    this.clients = response.data;
                })
                .catch(error => {
                    console.log('errors: ', error);
                })
        },*/

        getData: function () {
            axios.get(window.Laravel.url + '/getdata/' + window.Laravel.idAffaire)
                .then(response => {
                    //console.log('response: ', response.data);
                    this.clients = response.data.clients;
                    this.adversaires = response.data.adversaires;
                    this.seances = response.data.seances;
                    this.decisions = response.data.decisions;
                    this.nbr_decisions = this.decisions.length;
                    this.frais = response.data.frais;
                    this.frai.montant_total = response.data.frais_affaire;
                    this.frais_affaire = this.frai.montant_total;
                    for (var i = 0; i < this.frais.length; i++) {
                        this.total_versement = this.total_versement + this.frais[i]['versement'];
                    }
                    this.reste_a_payer = this.frai.montant_total - this.total_versement;
                    //this.frai.reste = this.frai.montant_total - this.total_versement;
                    //this.reste_a_payer = this.frai.reste;
                    //this.frai.reste = this.frai.montant_total - ;
                    //this.frais_affaire = response.data.frais_affaire;
                })
                .catch(error => {
                    console.log('errors: ', error);
                })
        },

        addClient: function () {
            axios.post(window.Laravel.url + '/addclient', this.client)
                .then(response => {
                    if (response.data.etat) {
                        //console.log(response.data.id);
                        this.open.client = false;
                        this.client.id = response.data.id;
                        //console.log(this.client);
                        this.clients.unshift(this.client);
                        this.client = {
                            id: 0,
                            affaire_id: window.Laravel.idAffaire,
                            is_adversaire: '',
                            is_moral: 2,
                            first_name: '',
                            last_name: '',
                            birthday: '',
                            type_id: '',
                            domicile: '',
                            father_name: '',
                            mother_first_name: '',
                            mother_last_name: '',
                            moral_person_name: '',
                            moral_person_description: ''
                        };
                    }

                })
                .catch(error => {
                    console.log(error);
                })
        },
        editClient: function (client) {
            this.open.client = true;
            this.edit.client = true;
            this.client = client;
            //console.log(this.client.is_moral);
        },
        updateClient: function () {
            axios.put(window.Laravel.url + '/updateclient', this.client)
                .then(response => {
                    if (response.data.etat) {
                        this.open.client = false;
                        this.client = {
                            id: 0,
                            affaire_id: window.Laravel.idAffaire,
                            is_adversaire: '',
                            is_moral: 2,
                            first_name: '',
                            last_name: '',
                            birthday: '',
                            type_id: '',
                            domicile: '',
                            father_name: '',
                            mother_first_name: '',
                            mother_last_name: '',
                            moral_person_name: '',
                            moral_person_description: ''
                        };
                    }
                    this.edit.client = false;

                })
                .catch(error => {
                    console.log(error);
                })
        },
        deleteClient: function (client) {
            var res = confirm("Etes-vous sûr de vouloir supprimer ce  Client?");
            if (res) {
                axios.delete(window.Laravel.url + '/deleteclient/' + client.id)
                    .then(response => {
                        if (response.data.etat) {
                            var position = this.clients.indexOf(client);
                            this.clients.splice(position, 1);
                        }
                    })
                    .catch(error => {
                        console.log(error);
                    })
            }
        },
        // adversaires:
        addAdversaire: function () {
            axios.post(window.Laravel.url + '/addadversaire', this.adversaire)
                .then(response => {
                    if (response.data.etat) {
                        this.open.adversaire = false;
                        this.adversaire.id = response.data.id;
                        this.adversaires.unshift(this.adversaire);
                        this.adversaire = {
                            id: 0,
                            affaire_id: window.Laravel.idAffaire,
                            is_adversaire: '',
                            is_moral: 2,
                            first_name: '',
                            last_name: '',
                            birthday: '',
                            type_id: '',
                            domicile: '',
                            father_name: '',
                            mother_first_name: '',
                            mother_last_name: '',
                            moral_person_name: '',
                            moral_person_description: ''
                        };
                    }

                })
                .catch(error => {
                    console.log(error);
                })
        },
        editAdversaire: function (adversaire) {
            this.open.adversaire = true;
            this.edit.adversaire = true;
            this.adversaire = adversaire;
        },
        updateAdversaire: function () {
            axios.put(window.Laravel.url + '/updateadversaire', this.adversaire)
                .then(response => {
                    if (response.data.etat) {
                        this.open.adversaire = false;
                        this.adversaire = {
                            id: 0,
                            affaire_id: window.Laravel.idAffaire,
                            is_adversaire: '',
                            is_moral: 2,
                            first_name: '',
                            last_name: '',
                            birthday: '',
                            type_id: '',
                            domicile: '',
                            father_name: '',
                            mother_first_name: '',
                            mother_last_name: '',
                            moral_person_name: '',
                            moral_person_description: ''
                        };
                    }
                    this.edit.adversaire = false;

                })
                .catch(error => {
                    console.log(error);
                })
        },
        deleteAdversaire: function (adversaire) {
            var res = confirm("Etes-vous sûr de vouloir supprimer cet Adversaire?");
            if (res) {
                axios.delete(window.Laravel.url + '/deleteadversaire/' + adversaire.id)
                    .then(response => {
                        if (response.data.etat) {
                            var position = this.adversaires.indexOf(adversaire);
                            this.adversaires.splice(position, 1);
                        }
                    })
                    .catch(error => {
                        console.log(error);
                    })
            }
        },

        addSeance: function () {
            axios.post(window.Laravel.url + '/addseance', this.seance)
                .then(response => {
                    if (response.data.etat) {
                        console.log("response.data.id");
                        this.open.seance = false;
                        this.seance.id = response.data.id;
                        //console.log(this.seance);
                        this.seances.unshift(this.seance);
                        this.seance = {
                            id: 0,
                            affaire_id: window.Laravel.idAffaire,
                            subject: '',
                            content: '',
                            date_seance: ''
                        };
                    }

                })
                .catch(error => {
                    console.log(error);
                })
        },
        editSeance: function (seance) {
            this.open.seance = true;
            this.edit.seance = true;
            this.seance = seance;
        },
        updateSeance: function () {
            axios.put(window.Laravel.url + '/updateseance', this.seance)
                .then(response => {
                    if (response.data.etat) {
                        this.open.seance = false;
                        this.seance = {
                            id: 0,
                            affaire_id: window.Laravel.idAffaire,
                            subject: '',
                            content: '',
                            date_seance: ''
                        };
                    }
                    this.edit.seance = false;

                })
                .catch(error => {
                    console.log(error);
                })
        },
        deleteSeance: function (seance) {
            var res = confirm("Etes-vous sûr de vouloir supprimer cette  Séance?");
            if (res) {
                axios.delete(window.Laravel.url + '/deleteseance/' + seance.id)
                    .then(response => {
                        if (response.data.etat) {
                            var position = this.seances.indexOf(seance);
                            this.seances.splice(position, 1);
                        }
                    })
                    .catch(error => {
                        console.log(error);
                    })
            }
        },

        addDecision: function () {
            axios.post(window.Laravel.url + '/adddecision', this.decision)
                .then(response => {
                    if (response.data.etat) {
                        //console.log(response.data.id);
                        this.open.decision = false;
                        this.decision.id = response.data.id;
                        //console.log(this.client);
                        this.decisions.unshift(this.decision);
                        this.nbr_decisions = this.decisions.length;
                        this.decision = {
                            id: 0,
                            affaire_id: window.Laravel.idAffaire,
                            date_decision: '',
                            summary: '',
                            authority: '',
                            //location1: '',
                            //location2: '',
                            type: ''
                        };
                    }

                })
                .catch(error => {
                    console.log(error);
                })
        },
        editDecision: function (decision) {
            this.open.decision = true;
            this.edit.decision = true;
            this.decision = decision;
            //console.log(this.client.is_moral);
        },
        updateDecision: function () {
            axios.put(window.Laravel.url + '/updatedecision', this.decision)
                .then(response => {
                    if (response.data.etat) {
                        this.open.decision = false;
                        this.decision = {
                            id: 0,
                            affaire_id: window.Laravel.idAffaire,
                            date_decision: '',
                            summary: '',
                            authority: '',
                            //location1: '',
                            //location2: ''
                            type: ''
                        };
                    }
                    this.edit.decision = false;

                })
                .catch(error => {
                    console.log(error);
                })
        },
        deleteDecision: function (decision) {
            var res = confirm("Etes-vous sûr de vouloir supprimer cette Décision?");
            if (res) {
                axios.delete(window.Laravel.url + '/deletedecision/' + decision.id)
                    .then(response => {
                        if (response.data.etat) {
                            var position = this.decisions.indexOf(decision);
                            this.decisions.splice(position, 1);
                            this.nbr_decisions = this.decisions.length;
                        }
                    })
                    .catch(error => {
                        console.log(error);
                    })
            }
        },

        validateFormClient() {
            //this.$validator.validateAll(scope).then((result) => {
            this.$validator.validateAll().then((result) => {
                if (result && this.edit.client) {
                    this.updateClient();
                } else if (result && !this.edit.client) {
                    this.addClient();
                }
                //}
            });
        },

        validateFormAdversaire() {
            //this.$validator.validateAll(scope).then((result) => {
            this.$validator.validateAll().then((result) => {
                if (result && this.edit.adversaire) {
                    this.updateAdversaire();
                } else if (result && !this.edit.adversaire) {
                    this.addAdversaire();
                }
                //}
            });
        },
        validateFormSeance() {
            this.$validator.validateAll().then((result) => {
                if (result && this.edit.seance) {
                    this.updateSeance();
                } else if (result && !this.edit.seance) {
                    this.addSeance();
                }
                //}
            });
        },
        validateFormDecision() {
            //this.$validator.validateAll(scope).then((result) => {
            this.$validator.validateAll().then((result) => {
                if (result && this.edit.decision) {
                    this.updateDecision();
                } else if (result && !this.edit.decision) {
                    this.addDecision();
                }
                //}
            });
        },

        addFrai: function () {
            axios.post(window.Laravel.url + '/addfrai', this.frai)
                .then(response => {
                    if (response.data.etat) {
                        this.open.frai = false;
                        this.frai.id = response.data.id;
                        //this.frai.reste = response.data.reste;
                        this.frai.date_versement = response.data.date_versement;
                        this.total_versement = parseFloat(this.total_versement) + parseFloat(this.frai.versement);
                        this.reste_a_payer = parseFloat(this.frais_affaire) - this.total_versement;
                        //parseFloat(this.frai.reste) - parseFloat(this.frai.versement);
                        this.frais.unshift(this.frai);
                        this.frai = {
                            id: 0,
                            affaire_id: window.Laravel.idAffaire,
                            montant_total: this.frais_affaire,
                            versement: 0,
                            date_versement: ''
                            //reste: ''
                        };
                    }

                })
                .catch(error => {
                    console.log(error);
                })
        },
        editFrai: function (frai) {
            this.open.frai = true;
            this.edit.frai = true;
            this.frai = frai;
        },
        updateFrai: function () {
            axios.put(window.Laravel.url + '/updatefrai', this.frai)
                .then(response => {
                    if (response.data.etat) {
                        this.open.frai = false;
                        this.frai = {
                            id: 0,
                            affaire_id: window.Laravel.idAffaire,
                            montant_total: this.frais_affaire,
                            versement: 0,
                            date_versement: ''
                            //reste: 0
                        };
                    }
                    this.edit.frai = false;

                })
                .catch(error => {
                    console.log(error);
                })
        },
        deleteFrai: function (frai) {
            var res = confirm("Etes-vous sûr de vouloir supprimer cet Frais?");
            if (res) {
                axios.delete(window.Laravel.url + '/deletefrai/' + frai.id)
                    .then(response => {
                        if (response.data.etat) {
                            var position = this.frais.indexOf(frai);
                            this.frais.splice(position, 1);
                        }
                    })
                    .catch(error => {
                        console.log(error);
                    })
            }
        },

        validateFormFrai() {
            this.$validator.validateAll().then((result) => {
                if (result && this.edit.frai) {
                    this.updateFrai();
                } else if (result && !this.edit.frai) {
                    this.addFrai();
                }
                //}
            });
        }

    },
    mounted: function () {
        this.getData();
    }
});