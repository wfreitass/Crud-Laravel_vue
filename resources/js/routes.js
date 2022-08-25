import ClienteIndex from "./components/cliente/index.vue";
import ClienteCreate from "./components/cliente/create.vue";
import ClienteEdit from "./components/cliente/edit.vue";

export const routes = [

    {
        path: "/",
        component: ClienteIndex,
        name: "ClienteIndex",
    },
    {
        path: "/cliente/create",
        component: ClienteCreate,
        name: "ClienteCreate",
    },
    {
        path: "/clientes/edit/:id",
        component: ClienteEdit,
        name: "ClienteEdit",
    },
];
