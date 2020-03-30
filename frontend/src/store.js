import { getLocalUser } from "./helpers";

const user = getLocalUser();

export default({

    state: {
        isLoggedIn: !!user,
        token:user,
        userId :0,
        name:"",
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
        name(state) {
            return state.name;
        },
    },
    mutations:{
            loginSuccess(state, payload) {
                state.isLoggedIn = true;
                document.cookie = state.token;+"expires= Thu, 21 Aug 2014 20:00:00 UTC"
                //localStorage.setItem("user", state.currentUser);
            },
            logout(state) {
                //localStorage.removeItem("user");
                document.cookie = "; expires = Thu, 01 Jan 1970 00:00:00 GMT"
                state.isLoggedIn = false;
                state.name = "";
                state.userId
                state.token = null;
            },

    },
    actions:{
        login(context) {
            context.commit("login");
        },

    },
  });