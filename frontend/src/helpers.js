export function getLocalUser() {
    const userStr = document.cookie;

    if(!userStr) {
        return null;
    }

    return userStr;
};