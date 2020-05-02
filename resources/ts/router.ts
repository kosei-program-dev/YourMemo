import Vue from "vue";
import Router from "vue-router";
import MyPage from "./components/MyPage.vue";
import EveryoneMemo from "./components/EveryoneMemo.vue";
import Home from "./components/Home.vue";
import Login from "./components/Login.vue";
import Logout from "./components/Logout.vue";
import MyMemo from "./components/MyMemo.vue";
import NotFound from "./components/NotFound.vue";
import Notification from "./components/Notification.vue";
import RegisterMemo from "./components/RegisterMemo.vue";
import Search from "./components/Search.vue";

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
            path: "/everyoneMemo",
            name: "everyoneMemo",
            component: EveryoneMemo
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
            path: "/myMemo",
            name: "myMemo",
            component: MyMemo
        },
        {
            path: "/notification",
            name: "notification",
            component: Notification
        },
        {
            path: "/registerMemo",
            name: "registerMemo",
            component: RegisterMemo
        },
        {
            path: "/search",
            name: "search",
            component: Search
        }
    ]
});
