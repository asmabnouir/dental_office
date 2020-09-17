import { getLocalUser, setCookie, getCookie } from "./helpers";
import axios from 'axios';

const user = getLocalUser();

export default({

    state: {
        token: getCookie('token'),
        isLoggedIn: !!getCookie('token'),
        userId :0,
        role:"",
        windowWidth: window.innerWidth,
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
            },
            logout(state) {
                state.isLoggedIn = false;
                state.name = "";
                state.userId = 0 ;
                document.cookie = "token= ; expires=Thu, 01 Jan 1970 00:00:01 GMT;";
                state.token = null;
            },
            setWindowWidth(state) {
                state.windowWidth = window.innerWidth;
              }

    },
    actions:{
        login(context) {
            context.commit("login");
        },

    },
  });