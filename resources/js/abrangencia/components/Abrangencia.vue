<template>
    <div class="row">
        <div class="col-md-12">
            <div class="card">

                <h5 class="card-header">Abrangência</h5>

                <div class="card-body">

                    <div class="form-group">
                        <label for="" class="col-form-label">Tipo</label>
                        <select name="abrangencia" id="" class="form-control" @change="changeAbrangencia($event)" >
                            <option value="1" :selected="abrangencia == '1'">Nacional</option>
                            <option value="2" :selected="abrangencia == '2'">Regional</option>
                        </select>
                    </div>

                    <div class="form-group" v-if="Object.keys(states_response).length > 0 && abrangencia == '2'">
                        <label for="" class="col-form-label">Estados</label>
                        <select name="state_id" id="" class="form-control" @change="changeState($event)" >
                            <option value="">Selecione o estado</option>
                            <option v-for="(name, id) in states_response" :value="id" :selected="id == state_id">{{ name }}</option>
                        </select>
                    </div>

                </div>

                <h5 class="card-header" v-if="state_id && abrangencia == '2'">Cidades</h5>

                <div class="card-body" v-if="state_id && abrangencia == '2'">
                    <div class="row mb-3">
                        <div class="col-md-3" v-for="city in cities_response">
                            <label class="custom-control custom-checkbox">
                                <input type="checkbox" :value="city.id" name="cities[]" class="custom-control-input" v-model="city.check">
                                <span class="custom-control-label"> {{ city.name }}</span>
                            </label>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: [
            'propAbrangencia',
            'propStateId',
            'propStates',
            'propCities',
            'propAppUrl'
        ],
        data() {
            return {
                abrangencia: '',
                states_response: [],
                state_id: '',
                cities_response: '',
                check: '',
                app_url: ''
            }
        },
        methods: {
            changeAbrangencia(e) {
                this.abrangencia = e.target.value
                if (this.abrangencia == '2') {
                    this.getStates();
                }
            },
            changeState(e) {
                if (e.target.value != '') {
                    this.state_id = e.target.value;
                    this.getCitiesByState();
                } else {
                    this.state_id = ''
                }
            },
            getStates() {
                this.state_id = '';

                window.axios.get(this.app_url + '/panel/get-states').then((response) => {
                    this.states_response = response.data;
                });
            },
            getCitiesByState() {
                window.axios.get(this.app_url + '/panel/get-cities-by-states/' + this.state_id).then((response) => {
                    this.cities_response = response.data;
                });
            },
            setValues() {

                if (this.propAppUrl) {
                    this.app_url = this.propAppUrl;
                }

                this.getStates();

                if (this.propAbrangencia) {
                    this.abrangencia = this.propAbrangencia;
                }

                if (this.propStateId) {
                    this.state_id = this.propStateId;
                }

                if (this.propCities) {
                    this.cities_response = JSON.parse(this.propCities);
                }
            }
        },
        mounted() {
            this.setValues();
            this.check = 'checked';
        }
    }
</script>
