<template>
<div>
<nav class="navbar-dark myheader">
    <div class="container">

<form  @submit.prevent="createParticipation()">
  <div class="form-row justify-content-center pt-5 pb-3">
    <div class="col-md-3 mb-3">
      <input v-model="form.first_name" type="text" class="form-control" placeholder="Nome" :class="{ 'is-invalid': form.errors.has('first_name') }">
        <has-error :form="form" field="first_name"></has-error>
    </div>
    <div class="col-md-3 mb-3">
      <input v-model="form.last_name" type="text" class="form-control" placeholder="Sobrenome" :class="{ 'is-invalid': form.errors.has('last_name') }">
        <has-error :form="form" field="last_name"></has-error>
    </div>
    <div class="col-md-3 mb-3">
      <input v-model="form.value" type="number" class="form-control" placeholder="Participação" :class="{ 'is-invalid': form.errors.has('value') }">
        <has-error :form="form" field="value"></has-error>
    </div>
        <div class="col-md-3 mb-3">
        <button type="submit" class="btn btn-outline-light">Salvar</button>


    </div>

  </div>

</form>
</div>

</nav>

<main class="container">
    <div class="justify-content-center pt-5">
        <h1 class="text-center">DADOS</h1>
        <p class="lead text-center">"Não há quem goste de dor, que a procure e a queira ter, simplesmente porque é dor..."</p>
    </div>
</main>

<section class="container">
    <div class="row pt-3">
        <div class="col">
            <div class="card">
            <div class="card-body table-responsive p-0">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                        <th></th>
                        <th>Nome</th>
                        <th>Sobrenome</th>
                        <th>Participação</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="participation in participations.data" :key="participation.id">
                            <td>{{participation.id}}</td>
                            <td>{{participation.first_name | upText }}</td>
                            <td>{{participation.last_name | upText }}</td>
                            <td>{{participation.value}} %</td>

                        </tr>
                    </tbody>
                </table>
            </div>
                            <div class="card-footer">
                    <pagination :data="participations" @pagination-change-page="getResults"></pagination>
                </div>
                </div>
        </div>
        <div class="col">
    <chart-component :height="250"></chart-component>

</div>
    </div>
</section>

</div>
</template>

<script>
    export default {
        data() {
            return {
                participations: {},
                form: new Form({
                    id: '',
                    first_name : '',
                    last_name : '',
                    value : ''
                })
            }
        },
        methods: {
            getResults(page = 1) {
                axios.get('api/participations?page=' + page)
                    .then(response => {
                        this.participations = response.data;
                    });
		    },

            loadParticipations(){
                axios.get("api/participation").then(({ data }) => (this.participations = data));
            },
            createParticipation(){
                this.$Progress.start();
                this.form.post('api/participation')
                .then(() => {
                    Fire.$emit('AfterCreate');
                    Toast.fire({
                        type: 'success',
                        title: 'Criado com sucesso !!'
                    })
                    this.$Progress.finish();
                })
                .catch(()=>{
                })
            }
        },
        created() {
            this.loadParticipations();
            Fire.$on('AfterCreate', () => {
                this.loadParticipations();
            });
        }
    }
</script>
