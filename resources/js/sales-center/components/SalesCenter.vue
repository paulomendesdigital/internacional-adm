<template>
    <div class="row text-center">
        <div class="col-md-12">
            <p class="title-blue">Central de Vendas</p>

            <h2><i class="fas fa-phone"></i> {{ phone }}</h2>

            <h2 v-if="whatsapp != ''"><i class="fab fa-whatsapp"></i> {{ whatsapp }}</h2>

            <p class=" subtitle-blue">{{ email }}</p>
        </div>
    </div>
</template>

<script>
    export default {
        props: [
            'propPhone',
            'propWhatsapp',
            'propEmail'
        ],
        data() {
            return {
                phone: '',
                whatsapp: '',
                email: ''
            }
        },
        methods: {
            setInfo() {
                this.phone = this.propPhone;
                this.whatsapp = this.propWhatsapp;
                this.email = this.propEmail;
            }
        },
        mounted() {
            this.setInfo();
        }
    }
</script>
