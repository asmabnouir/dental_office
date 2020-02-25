
//const user = getLocalUser();
export default({
    state: {
       // currentUser: user,
        isLoggedIn: false,
        token:null,
    },
    getters:{
        isLoggedIn(state) {
            return state.isLoggedIn;
        },
        token(state) {
            return state.token;
        },
    },
    mutations:{
        getLocalUser() {
            const userStr = localStorage.getItem("user");
            if(!userStr) {
                return null;
            }
            return JSON.parse(userStr);
            },
            loginSuccess(state, payload) {
                state.isLoggedIn = true;
                document.cookie = "user= "+state.token;+"expires= Thu, 21 Aug 2014 20:00:00 UTC"
                //localStorage.setItem("user", state.token);
            },
            logout(state) {
                //localStorage.removeItem("user");
                document.cookie = "user= ; expires = Thu, 01 Jan 1970 00:00:00 GMT"
                state.isLoggedIn = false;
                state.token = null;
            },

    },
    actions:{
        login(context) {
            context.commit("login");
        },

    },
  });