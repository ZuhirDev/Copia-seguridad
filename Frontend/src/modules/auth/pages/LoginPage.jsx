import React, { useEffect } from 'react';
import { useAuth } from '../context/AuthContext';

const LoginPage = () => {

  const { login } = useAuth();

  const handleLogin = async () => {

    const email = "admin@admin.es";
    const password = "11111111";

    try {
      await login(email, password);
    } catch (err) {
      console.log("Error al intentar hacer login automáticamente", err);
    }
  }

  return (
    <>
      <button
        onClick={handleLogin} // Ejecuta logout cuando se hace clic
        className="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 transition duration-300"
      >
        Login
      </button>
    </>
  )
}

export default LoginPage;
