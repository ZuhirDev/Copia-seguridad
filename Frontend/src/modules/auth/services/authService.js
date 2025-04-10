// import { get, post } from "@utils/xhr";
import { data } from "react-router-dom";
import { get, post } from "../../../utils/xhr";
// import { post } from '@utils/xhr.js'

// // USAR ALIAS


export const registerService = async () => {
    try {
        const response = await post()
    } catch (error) { 
        console.log("Error", error);
        throw new Error(error);
    }
}


export const loginService = async (email, password) => {
    try {
        const response = await post({
            url: '/login',
            data: {
                email,
                password,
            }
        });
        return response.data;
    } catch (error) {
        console.log("Error", error);
        throw new Error(error);
    }
}

export const logoutService = async () => {
    try {
        const response = await post({url: '/logout'});      
        return response.data; 
    } catch (error) {
        console.log("Error", error);
        throw new Error(error);
    }
}

// export const meService = async () => {
//     try {
//         const response = await get({url: '/me'});
//         console.log("service", response);
//         return response.data;
//     } catch (error) {
//         console.log("Error", error);
//         throw new Error(error);
//     }
// }

export const enable2FAService = async () => {
    try {
        const response = await post({
            url: '/2fa/enable',
        });
        console.log("response en service", response)
        return response.data;
    } catch (error) {
        console.log("Error", error);
        throw new Error(error);
    }
}

export const verify2FAService = async (otp) => { console.log("otp en service", otp)
    try {
        const response = await post({
            url: '/2fa/verify',
            data: {
                one_time_password: otp,
            }
        });
        return response.data;
    } catch (error) {
        console.log("Error", error);
        throw new Error(error);
    }
}

export const disable2FAService = async () => {
    try {
        const response = await post({ url: '/2fa/disable '});
        console.log("response en serv ice", response);
        return response.data;
    } catch (error) {
        console.log("Error", error);
        throw new Error(error);
    }
} 
