import { getLocalUser, setCookie, getCookie } from "./helpers";
import axios from 'axios';

const user = getLocalUser();

export default({

    state: {
        token: getCookie('token'),
        isLoggedIn: !!getCookie('token'),
        userId :0,
        role:"",
    },
    getters:{
        isLoggedIn(state) {
            return state.isLoggedIn;
        },
        token(state) {
            return state.token;
        },
        userId(state) {
            return state.userId;
        },
        role(state) {
            return state.role;
        },
    },
    mutations:{
            loginSuccess(state, payload) {
                state.isLoggedIn = true;
                //setCookie('token', state.token , 30)
                //axios.defaults.headers.Authorization = 'Bearer ' +  this.$store.state.token; //.slice(7)
                //console.log(axios.defaults.headers.Authorization)
                //localStorage.setItem("user", state.currentUser);
            },
            logout(state) {
                //localStorage.removeItem("user");
                //axios.defaults.headers.Authorization = "";
               //delete axios.defaults.headers.common['Authorization'];
                state.isLoggedIn = false;
                state.name = "";
                state.userId = 0 ;
                document.cookie = "token= ; expires=Thu, 01 Jan 1970 00:00:01 GMT;";
                state.token = null;
            },

    },
    actions:{
        login(context) {
            context.commit("login");
        },

    },
  });