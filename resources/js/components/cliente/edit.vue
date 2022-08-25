<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Editar Cliente</div>

                    <div class="card-body">
                        <form>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label for="nome">Nome</label>
                                    <input type="text" class="form-control" id="nome" aria-describedby="ClienteNome"
                                        v-model="cliente.name">
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="email">Email </label>
                                    <input type="email" class="form-control" id="email" aria-describedby="emailHelp"
                                        v-model="cliente.email">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="rg">RG</label>
                                    <input type="text" maxlength="7" class="form-control" id="rg" v-model="cliente.rg">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="phone">Telefone</label>
                                    <input type="text" class="form-control" id="phone" v-model="cliente.phone">
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="address">Endereço</label>
                                    <input type="text" v-model="cliente.address" class="form-control" id="address">
                                </div>
                                <div class="form-group col-md-6 mb-3">
                                    <!-- <label for="photo">Foto</label>
                                    <input type="file" class="form-control" id="photo"> -->
                                </div>
                                <div class="form-group col-md-6 mb-3">
                                        <img class="w-75 h-75" :src="'storage/clientes/'+cliente.photo" alt="">
                                </div>
                                <button type="button" class="btn btn-primary btn-lg btn-block"
                                    @click="atualizarCliente()">Salvar</button>

                            </div>
                        </form>
                        <!-- <img src='storage/clientes/1661433127.png' alt=""> -->

                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            cliente: {}
        }
    },
    mounted() {
        this.editarCliente(this.$route.params.clienteId);
    },
    methods: {
        editarCliente(clienteId) {
            this.axios.get(`http://127.0.0.1:8000/api/clientes/${clienteId}`)
                .then((res) => {
                    this.cliente = res.data;
                });
        },
        atualizarCliente() {

            this.axios
                .patch(`http://127.0.0.1:8000/api/clientes/${this.$route.params.clienteId}`, this.cliente)
                .then((res) => {
                    this.$router.push({ name: 'ClienteIndex' });
                });
        }
    }
}
</script>
