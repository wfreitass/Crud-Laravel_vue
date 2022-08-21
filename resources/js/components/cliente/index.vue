<template>
    <div class="container">
        <h2 class="text-center">Lista de Clientes</h2>
        <div class="row">
            <div class="col-md-12">
                <router-link :to="{ name: 'ClienteCreate' }" class="btn btn-primary btn-sm float-right mb-2">Adicionar
                    um novo cliente
                </router-link>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nome</th>
                            <th>Email</th>
                            <th>RG</th>
                            <th>Telefone</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(cliente, key) of clientes" v-bind:key="key">
                            <td>{{ key + 1 }}</td>
                            <td>{{ cliente.name }}</td>
                            <td>{{ cliente.email }}</td>
                            <td>{{ cliente.rg }}</td>
                            <td>{{ cliente.phone }}</td>
                            <td>
                                <router-link class="btn btn-success btn-sm"
                                    :to="{ name: 'ClienteEdit', params: { clienteId: cliente.id } }">Edit</router-link>
                                <button class="btn btn-danger btn-sm" @click="deleteCliente(cliente.id)">Delete</button>
                            </td>
                            <td>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            clientes: {}
        }
    },
    created() {
        this.getClientes();
    },
    methods: {
        getClientes() {
            this.axios.get('http://127.0.0.1:8000/api/clientes')
                .then(response => {
                    this.clientes = response.data;
                });
        },
        deleteCliente(clienteId) {
            this.axios
                .delete(`http://127.0.0.1:8000/api/clientes/${clienteId}`)
                .then(response => {
                    let i = this.clientes.map(data => data.id).indexOf(clienteId);
                    this.clientes.splice(i, 1)
                });
        }
    }
}
</script>
