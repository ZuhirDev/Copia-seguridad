import { createContext, useContext } from "react";
import { forgotPasswordService, meService, sendVerifyEmailService, updatePasswordService } from "../service/userService";


const userContext = createContext();

export const UserProvider = ({ children }) => {

    
    const me = async () => { 
        return  await meService();
    }

    const updatePassword = async (passwords) => {
        const response  = await updatePasswordService(passwords);
    }

    const forgotPassword = async (email) => {
        const response = await forgotPasswordService(email);

        // PENDIENTE

    }

    const sendVerifyEmail = async () => {
        const response = await sendVerifyEmailService();
    }

    const value = {
        me,
        updatePassword,
        forgotPassword,
        sendVerifyEmail,
    }

    return(
        <userContext.Provider value={ value } >
            { children }
        </userContext.Provider>
    );
}

export const useUser = () =>  {

    const context = useContext(userContext);

    if(!context){
        throw new Error("useUser debe estar dentro del proveedor UserProvider");
    }
    
    return context;
}