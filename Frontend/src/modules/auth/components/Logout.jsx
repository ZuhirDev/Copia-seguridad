import React from 'react';
import { useAuth } from '../context/AuthContext';
import { useNavigate } from 'react-router-dom';
import AUTH_ROUTES from '../routes/paths';

const Logout = () => {

  const { logout } = useAuth();
  const navigate = useNavigate();

  const handleLogout = async () => {
    try {
      const response = await logout();
      console.log("logoutpage", response);
      navigate(AUTH_ROUTES.HOME);
    } catch (error) {
      console.log("Error", error);
    }
  }


  return (
    <button
      onClick={handleLogout}
      className="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 transition duration-300"
    >
      Logout
    </button>
  )
}

export default Logout;
