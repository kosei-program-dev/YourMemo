import Router from "vue-router";
import Home from "./components/Home.vue";
import About from "./components/About.vue";
import NotFound from "./components/NotFound.vue";

export default new Router({
    mode: "history",
    routes: [
        {
            path: "*",
            component: NotFound
        },
        {
            path: "/about",
            name: "about",
            component: About
        },
        {
            path: "/",
            name: "home",
            component: Home
        }
    ]
});
