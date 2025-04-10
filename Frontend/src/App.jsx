import React from 'react';
import './App.css';
import { RouterProvider } from 'react-router-dom';
import router from './modules/auth/routes/router';
import { UserProvider } from './modules/user/context/UserContext';

const App = () => {
  return (
    <div>
      {/* <UserProvider > */}

       <RouterProvider router={router} />
      {/* </UserProvider> */}
    </div>
  )
}

export default App;
