<template>
    <div class="row">
        <div class="col-md-12">

            <div v-if="elegibilidade == '1'" class="form-group mb-4">

                <label for="profission" class="col-form-label">Profissão</label>

                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <i class="fas fa-user-md"></i>
                        </div>
                    </div>
                    
                    <select name="profission_id" id="profission" class="form-control">
                        <option value="">Selecione</option>
                        <option v-for="(name, id) in profissions" :value="id">{{ name }}</option>
                    </select>
                </div>
            </div>

            <hr>

            <div class="row">
                <div class="col-md-12 mb-3" v-if="clientModalityPj == '0'">
                    <h5>Possui dependentes?</h5>
                    <small>Caso possua, preencha a data de nascimento abixo</small>
                </div>

                <div class="col-md-12 mb-3" v-if="clientModalityPj == '1'">
                    <h5>Data de nascimento dos funcionários</h5>
                    <small>Adicione e digite abaixo as datas de nascimento dos funcionários da empresa</small>
                </div>
            </div>

            <div class="row mb-3">
                <div class="input-group col-md-7 mb-3" v-for="(dependent, index) in dependents">

                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <i class="far fa-calendar-alt"></i>
                        </div>
                    </div>

                    <input type="date" name="dependents[]" class="form-control" placeholder="Data de Nascimento" v-model="dependent.birth" :min="minDate" :max="maxDate">

                    <span v-if="numDependents > 1" @click="deleteDependents(index)" style="margin-top: 12px; cursor: pointer">
                        <i class="fas fa-times ml-3"></i>
                    </span>
                </div>

                <div class="col-md-12">
                    <small @click="addDependents()" style="cursor: pointer;">
                        + Adicionar outro 
                        <span v-if="clientModalityPj == '0'">dependente</span>
                        <span v-if="clientModalityPj == '1'">funcionário</span>
                    </small>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: [
            'propProfissions',
            'propElegibilidade',
            'propClientModalityPj',
            'propMinDate',
            'propMaxDate',
        ],
        data() {
            return {
                profissions: [],
                
                elegibilidade: '',
                
                clientModalityPj: '',
                
                numDependents: 1,

                minDate: '',

                maxDate: '',
                
                dependents: [
                    {
                        birth: ''
                    }
                ]
            }
        },
        
        methods: {
            addDependents() {
                this.dependents.push({
                    birth: ''
                });

                this.numDependents++;
            },

            deleteDependents(index) {
                this.dependents.splice(index, 1);
                this.numDependents--;
            },

            setValues() {
                this.profissions = JSON.parse(this.propProfissions);

                this.elegibilidade = this.propElegibilidade;
                
                this.clientModalityPj = this.propClientModalityPj;

                this.minDate = this.propMinDate;

                this.maxDate = this.propMaxDate;
            }
        },

        mounted() {
            this.setValues();
        }

    }
</script>
