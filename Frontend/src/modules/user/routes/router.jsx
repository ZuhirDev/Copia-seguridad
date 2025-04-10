import { createBrowserRouter } from "react-router-dom";
import USER_ROUTES from "./path";
import UpdatePassword from '../components/passwords/UpdatePassword';
import ForgotPassword from '../components/passwords/ForgotPassword';
import PasswordReset from '../components/passwords/PasswordReset';
import SendVerifyEmail from '../components/mails/SendVerifyEmail';
import VerifyEmail from '../components/mails/VerifyEmail';
import MePage from "../pages/MePage";


export const router = createBrowserRouter([

    {
        path: USER_ROUTES.ME,
        element: <MePage />,
    },

    {
        path: USER_ROUTES.UPDATE_PASSWORD,
        element: <UpdatePassword />,
    },

    {
        path: USER_ROUTES.FORGOT_PASSWORD,
        element: <ForgotPassword />,
    },

    {
        path: USER_ROUTES.PASSWORD_RESET,
        element: <PasswordReset />,
    },

    {
        path: USER_ROUTES.SEND_VERIFY_EMAIL,
        element: <SendVerifyEmail />,
    },

    {
        path: USER_ROUTES.VERIFY_EMAIL,
        element: <VerifyEmail />,
    },

]);

export default router;