import Vue from "vue";
import Router from "vue-router";
import MyPage from "./components/pages/MyPage.vue";
import EveryoneNote from "./components/pages/EveryoneNote.vue";
import Home from "./components/pages/Home.vue";
import Login from "./components/pages/Login.vue";
import Logout from "./components/pages/Logout.vue";
import MyNote from "./components/pages/MyNote.vue";
import NotFound from "./components/pages/NotFound.vue";
import Notification from "./components/pages/Notification.vue";
import RegisterNote from "./components/pages/RegisterNote.vue";
import Search from "./components/pages/Search.vue";

Vue.use(Router);

export default new Router({
    mode: "history",
    routes: [
        {
            path: "*",
            component: NotFound
        },
        {
            path: "/myPage",
            name: "myPage",
            component: MyPage
        },
        {
            path: "/everyoneNote",
            name: "everyoneNote",
            component: EveryoneNote
        },
        {
            path: "/",
            name: "home",
            component: Home
        },
        {
            path: "/login",
            name: "login",
            component: Login
        },
        {
            path: "/logout",
            name: "logout",
            component: Logout
        },
        {
            path: "/myNote",
            name: "myNote",
            component: MyNote
        },
        {
            path: "/notification",
            name: "notification",
            component: Notification
        },
        {
            path: "/registerNote",
            name: "registerNote",
            component: RegisterNote
        },
        {
            path: "/search",
            name: "search",
            component: Search
        }
    ]
});
