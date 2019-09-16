<template>
    <div class="row">
        <div class="col-md-12">

            <div class="form-group">
                <label for="abrangencia">Abrangência do Plano</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <i class="far fa-map"></i>
                        </div>
                    </div>

                    <select id="abrangencia" name="abrangencia" class="form-control" @change="changeAbrangencia($event)" >
                        <option v-for="(abrangencia, id) in propAbrangencias" :value="id" >{{ abrangencia }}</option>
                    </select>
                </div>
            </div>

            <div class="row">

                <div class="col-md-4">
                    <div class="form-group" v-if="Object.keys(states_response).length > 0 && abrangencia == '2'">
                        <label for="state" class="col-form-label">UF</label>

                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                            </div>

                            <select id="state" name="state_id" class="form-control" @change="changeState($event)" >
                                <option value="">Selecione</option>
                                <option v-for="(name, id) in states_response" :value="id" >{{ name }}</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-goup col-md-8" v-if="state_id != '' && abrangencia === '2' && there_is_city === true" >
                    <label for="city" class="col-form-label">Cidade</label>

                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fas fa-street-view"></i>
                            </div>
                        </div>

                        <select id="city" name="city_id" class="form-control" @change="changeCity($event)">
                            <option value="">Selecione</option>
                            <option v-for="(name, id) in cities_response" :value="id" >{{ name }}</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-12 mt-3 mb-3" v-if="there_is_city === false">
                    <h2 class="text-center">Não há cidade para a UF escolhida</h2>
                </div>
            </div>

            <button type="submit" class="btn btn-primary mt-2 float-right" v-if="abrangencia === '1' || !abrangencia || (abrangencia === '2' && state_id != '' && city_id != '')">
                Enviar
            </button>

            <span class="btn btn-light mt-2 float-right" v-if="abrangencia === '2' && (!state_id || !city_id)">
                Enviar
            </span>

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
            'propAppUrl',
            'propAbrangencias'
        ],
        data() {
            return {
                abrangencia: '',
                states_response: [],
                state_id: '',
                cities_response: '',
                there_is_city: '',
                city_id: '',
                app_url: ''
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

                window.axios.get(this.app_url + '/get-states-with-plans').then((response) => {
                    this.states_response = response.data;
                });

            },

            getCitiesByState() {
                window.axios.get(this.app_url + '/get-cities-by-states-with-plans/' + this.state_id).then((response) => {

                    if ( Object.keys(response.data).length > 0) {
                        this.cities_response = response.data;
                        this.there_is_city = true;
                    } else {
                        this.there_is_city = false;
                    }
                });
            },

            setValues() {

                if (this.propAppUrl) {
                    this.app_url = this.propAppUrl;
                }

                this.propAbrangencias = JSON.parse(this.propAbrangencias);
            }
        },

        mounted() {
            this.setValues();
        }
    }
</script>
