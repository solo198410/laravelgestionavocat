var app = new Vue({
    el: '#app',
    data: {
        skills: [],
        details: [],
        open: {
            skill: false,
            detail: false
        },
        skill: {
            id: 0,
            avocat_id: window.Laravel.idAvocat,
            description: ''
        },
        detail: {
            id: 0,
            avocat_id: window.Laravel.idAvocat,
            typedetail_id: '',
            value:''
        },
        edit: {
            skill: false,
            detail: false
        },
        detail_show: {
            skill: false,
            detail: false,
        }
    },
    methods: {

        getData: function () {
            axios.get(window.Laravel.url + '/getdatavocat/' + window.Laravel.idAvocat)
                .then(response => {
                    this.skills = response.data.skills;
                    this.details = response.data.details;
                })
                .catch(error => {
                    console.log('errors: ', error);
                })
        },

        addSkill: function () {
            axios.post(window.Laravel.url + '/addskill', this.skill)
                .then(response => {
                    if (response.data.etat) {
                        this.open.skill = false;
                        this.skill.id = response.data.id;
                        this.skills.unshift(this.skill);
                        this.skill = {
                            id: 0,
                            avocat_id: window.Laravel.idAvocat,
                            description: ''
                        };
                    }
                })
                .catch(error => {
                    console.log(error);
                })
        },
        editSkill: function (skill) {
            this.open.skill = true;
            this.edit.skill = true;
            this.skill = skill;
        },
        updateSkill: function () {
            axios.put(window.Laravel.url + '/updateskill', this.skill)
                .then(response => {
                    if (response.data.etat) {
                        this.open.skill = false;
                        this.skill = {
                            id: 0,
                            avocat_id: window.Laravel.idAvocat,
                            description: ''
                        };
                    }
                    this.edit.skill = false;

                })
                .catch(error => {
                    console.log(error);
                })
        },
        deleteSkill: function (skill) {
            var res = confirm("Etes-vous sûr de vouloir supprimer cette  compétence?");
            if (res) {
                axios.delete(window.Laravel.url + '/deleteskill/' + skill.id)
                    .then(response => {
                        if (response.data.etat) {
                            var position = this.skills.indexOf(skill);
                            this.skills.splice(position, 1);
                        }
                    })
                    .catch(error => {
                        console.log(error);
                    })
            }
        },
        // adversaires:
        addDetail: function () {
            axios.post(window.Laravel.url + '/adddetail', this.detail)
                .then(response => {
                    if (response.data.etat) {
                        this.open.detail = false;
                        this.detail.id = response.data.id;
                        this.details.unshift(this.detail);
                        this.detail = {
                            id: 0,
            avocat_id: window.Laravel.idAvocat,
            typedetail_id: '',
            value:''        
                        };
                    }

                })
                .catch(error => {
                    console.log(error);
                })
        },
        editDetail: function (detail) {
            this.open.detail = true;
            this.edit.detail = true;
            this.detail = detail;
        },
        updateDetail: function () {
            axios.put(window.Laravel.url + '/updatedetail', this.detail)
                .then(response => {
                    if (response.data.etat) {
                        this.open.detail = false;
                        this.detail = {
                            id: 0,
                            avocat_id: window.Laravel.idAvocat,
                            typedetail_id: '',
                            value:''
                        };
                    }
                    this.edit.detail = false;

                })
                .catch(error => {
                    console.log(error);
                })
        },
        deleteDetail: function (detail) {
            var res = confirm("Etes-vous sûr de vouloir supprimer cet enregistrement?");
            if (res) {
                axios.delete(window.Laravel.url + '/deletedetail/' + detail.id)
                    .then(response => {
                        if (response.data.etat) {
                            var position = this.details.indexOf(detail);
                            this.details.splice(position, 1);
                        }
                    })
                    .catch(error => {
                        console.log(error);
                    })
            }
        },

        
        validateFormSkill() {
            //this.$validator.validateAll(scope).then((result) => {
            this.$validator.validateAll().then((result) => {
                if (result && this.edit.skill) {
                    this.updateSkill();
                } else if (result && !this.edit.skill) {
                    this.addSkill();
                }
                //}
            });
        },

        validateFormDetail() {
            //this.$validator.validateAll(scope).then((result) => {
            this.$validator.validateAll().then((result) => {
                if (result && this.edit.detail) {
                    this.updateDetail();
                } else if (result && !this.edit.detail) {
                    this.addDetail();
                }
                //}
            });
        }
    },
    mounted: function () {
        this.getData();
    }
});