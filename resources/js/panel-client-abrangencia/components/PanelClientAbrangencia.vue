<template>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="abrangencia" class="col-form-label">Tipo</label>
                <select id="abrangencia" name="abrangencia" class="form-control" @change="changeAbrangencia($event)" >
                    <option value="1" :selected="abrangencia == '1'">Nacional</option>
                    <option value="2" :selected="abrangencia == '2'">Regional</option>
                </select>
            </div>

            <div class="row">

                <div class="col-md-4">
                    <div class="form-group" v-if="states_response && Object.keys(this.states_response).length > 0 && abrangencia == '2'">
                        <label for="state" class="col-form-label">UF</label>
                        <select id="state" name="state_id" class="form-control" @change="changeState($event)" >
                            <option value="">Selecione</option>
                            <option v-for="(name, id) in states_response" :value="id" :selected="id == state_id">{{ name }}</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="form-group" v-if="abrangencia == '2' && state_id && there_is_city == true" >
                        <label for="city" class="col-form-label">Cidade</label>
                        <select id="city" name="city_id" class="form-control" @change="changeCity($event)">
                            <option value="">Selecione</option>
                            <option v-for="(name, id) in cities_response" :value="id" :selected="id == city_id">{{ name }}</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-12 mt-3 mb-3" v-if="there_is_city === false">
                    <h2 class="text-center">Não há Cidades para a UF escolhida</h2>
                </div>
            </div>

            <button type="submit" class="btn btn-primary mt-2 float-right" v-if="abrangencia == '1' || !abrangencia || (abrangencia == '2' && state_id && city_id && there_is_city === true)">
                Enviar
            </button>

            <span class="btn btn-light mt-2 float-right" v-if="abrangencia == '2' && (!state_id || !city_id || there_is_city === false)">
                Enviar
            </span>

        </div>
    </div>
</template>

<script>
    export default {
        props: [
            'propAbrangencia',
            'propStates',
            'propCities',
            'propStateId',
            'propCityId',
        ],

        data() {
            return {
                abrangencia: '',
                states_response: [],
                cities_response: [],
                there_is_city: '',
                state_id: '',
                city_id: ''
            }
        },

        methods: {
            changeAbrangencia(e) {
                this.abrangencia = e.target.value
                if (this.abrangencia == '2') {
                    this.getStates();
                } else {
                    this.state_id = ''
                    this.city_id = ''
                }
            },

            changeState(e) {
                if (e.target.value != '') {
                    this.state_id = e.target.value;
                    this.city_id = '';
                    this.getCitiesByState();
                } else {
                    this.state_id = ''
                    this.city_id = ''
                }
            },

            changeCity(e) {
                if (e.target.value != '') {
                    this.city_id = e.target.value;
                } else {
                    this.city_id = ''
                }
            },

            getStates() {
                this.state_id = '';

                window.axios.get('/internacional/public/panel/get-states').then((response) => {
                    this.states_response = response.data;

                    console.log(this.states_response);
                });
            },

            getCitiesByState() {
                window.axios.get('/internacional/public/panel/get-cities-by-states-client/' + this.state_id).then((response) => {

                    if ( Object.keys(response.data).length > 0) {
                        this.cities_response = response.data;
                        this.there_is_city = true;
                    } else {
                        this.there_is_city = false;
                    }
                });
            },

            setValues() {

                if (this.propAbrangencia) {
                    this.abrangencia = JSON.parse(this.propAbrangencia);
                }
                if (this.propStates) {
                    this.states_response = JSON.parse(this.propStates);
                }
                if (this.propCities) {
                    this.cities_response = JSON.parse(this.propCities);
                    this.there_is_city = true;
                }
                if (this.propStateId) {
                    this.state_id = JSON.parse(this.propStateId);
                }
                if (this.propCityId) {
                    this.city_id = JSON.parse(this.propCityId);
                }
            }
        },
        mounted() {
            this.setValues();
        }
    }
</script>
