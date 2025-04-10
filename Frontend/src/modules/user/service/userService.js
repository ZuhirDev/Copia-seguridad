import { post } from '../../../utils/xhr';
// import { post } from '@utils/xhr'; revisar porque no funciona



export const meService = async () => {
    try {
        const response = await get({url: '/me'});
        console.log("service", response);
        return response.data;
    } catch (error) {
        console.log("Error", error);
        throw new Error(error);
    }
}

export const updatePasswordService = async (passwords) => {
    const { current_password, password, password_confirmation } = passwords;

    try {
        const response = await post({
            url: '/update-password',
            data: {
                current_password,
                password,
                password_confirmation,
            }
        });

        console.log("response en service", response)
        return response.data;
    } catch (error) {
        console.log("Error", error);
        throw new Error(error);
    }
}

export const forgotPasswordService = async (email) => { console.log(email)
    try {
        const response = await post({
            url: '/forgot-password', 
            data: {
                email,
            }
        });

        return response.data;
    } catch (error) {
        console.log("Error", error);
        throw new Error(error);
    }
}

export const passwordReset = async (data) => {
    try {
        const response = await post({
            url: '/password-reset',
            data: {
                email,
                password,
                password_confirmation,
            }
        });
    } catch (error) {
        console.log("Error", error);
        throw new Error(error);
    }
}

export const sendVerifyEmailService = async () => {
    try {
        const response = await post({ url: 'send-verify-email' })
        return response.data;
    } catch (error) {
        console.log("Error", error);
        throw new Error(error);
    }
}