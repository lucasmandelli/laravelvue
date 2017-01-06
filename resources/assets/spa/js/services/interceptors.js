import JwtToken from './jwt-token';
import Auth from './auth';
import appConfig from './appConfig';

Vue.http.interceptors.push((request, next) => {
    request.headers.set('Authorization', JwtToken.getAuthorizationHeader());
    next();
});

Vue.http.interceptors.push((request, next) => {
    next((response) => {
        if(response.status === 401){ //expired token
            return JwtToken.refreshToken()
                .then(() => {
                    return Vue.http(request); //send request again
                })
                .catch(() => {
                    Auth.clearAuth();
                    window.location.href = appConfig.login_url
                });
        }
    });
});