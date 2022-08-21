import ProductIndex from "./components/products/index.vue";
import ClienteIndex from "./components/cliente/index.vue";
import ClienteCreate from "./components/cliente/create.vue";
import ProductCreate from "./components/products/create.vue";
import ProductEdit from "./components/products/edit.vue";
import ClienteEdit from "./components/cliente/edit.vue";

export const routes = [
    {
        path: "/products",
        component: ProductIndex,
        name: "ProductIndex",
    },
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
        path: "/products/create",
        component: ProductCreate,
        name: "ProductCreate",
    },
    {
        path: "/products/edit/:id",
        component: ProductEdit,
        name: "ProductEdit",
    },
    {
        path: "/clientes/edit/:id",
        component: ClienteEdit,
        name: "ClienteEdit",
    },
];
