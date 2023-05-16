import React, { useState } from 'react'
import axiosUser from '../axios/axiosUser';
import { useNavigate, useLocation } from 'react-router-dom';


function useAuth() {
  const navigate = useNavigate();
  const location = useLocation();
  const [user, setUser] = useState({});

  async function isAuth() {
    try {
      let req = await axiosUser.get('/user');
      setUser(req.data)
      if (location.pathname === '/') {
        navigate('/E-learning');
      }
    } catch (error) {
      if (error.response.status==401 && location.pathname !== '/sign-up' ) {
        navigate('/');
      }
    }  
    
  }
  async function logout() {
    let req = await axiosUser.post('/logout');
    if (req.status == 200) {
      navigate('/');
    }
    return req;
  }
  return { user, isAuth, logout,navigate };
}

export default useAuth;