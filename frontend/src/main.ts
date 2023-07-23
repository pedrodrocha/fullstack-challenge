import { createApp } from "vue";
import { createPinia } from "pinia";

import App from "./App.vue";
import router from "./router";

import '@fontsource/roboto-slab';
import '@fontsource/roboto';
import "./assets/main.css";

import Spinner from '@/components/Spinner.vue';
import Users from '@/components/Users.vue';



const app = createApp(App);

app.component('Spinner', Spinner);
app.component('Users', Users);

app.use(createPinia());
app.use(router);

app.mount("#app");
