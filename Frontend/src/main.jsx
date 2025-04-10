import { StrictMode } from 'react';
import { createRoot } from 'react-dom/client';
import App from './App.jsx';
import { AuthProvider } from './modules/auth/context/AuthContext.jsx';
import { UserProvider } from './modules/user/context/UserContext.jsx';

createRoot(document.getElementById('root')).render(
  <StrictMode>
    <AuthProvider>
      <UserProvider >

      <App />   
      </UserProvider>
      {/* VER TRADUCIONES EN EL BACK Y FRONT  */}
    </AuthProvider>
  </StrictMode>,
);
