<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Adicionar Cliente</div>

                    <div class="card-body">
                        <form enctype="multipart/form-data">
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
                                    <input type="text" class="form-control" id="rg" maxlength="7" v-model="cliente.rg">
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
                                    <label for="photo">Foto</label>
                                    <input type="file" @change="selectFile" class="form-control" id="photo"
                                        name="photo">
                                </div>
                                <button type="button" class="btn btn-primary btn-lg btn-block"
                                    @click="adicionarCliente()">Salvar</button>

                            </div>
                        </form>
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
    methods: {
        selectFile(event) {
            this.cliente.photo = event.target.files[0] || null;
        },
        adicionarCliente() {
            const data = new FormData();
            // data.append(...cliente.cliente);

            data.append('name', this.cliente.name)
            data.append('email', this.cliente.email)
            data.append('rg', this.cliente.rg)
            data.append('phone', this.cliente.phone)
            data.append('address', this.cliente.address)
            if(this.cliente.photo != null && this.cliente.photo != undefined){
                data.append('photoupload', this.cliente.photo)
                data.append('photo', this.cliente.photo.name)
            }
            this.axios
                .post('http://localhost:8000/api/clientes', data)
                .then(response => (
                   this.$router.push({ name: 'ClienteIndex' })
                ))
                .catch(err => console.log(err))
                .finally(() => this.loading = false)
        }
    }
}
</script>
