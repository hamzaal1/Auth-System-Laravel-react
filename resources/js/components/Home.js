import React, { useEffect } from 'react'
import useAuth from './hooks/useAuth'

function Home() {
    const {isAuth,user,logout} = useAuth()
    useEffect(() => {
     isAuth();
     
    }, [])
    console.log(user);
    
    return (
        <div>
          username : {user.name}
          <button className='btn btn-dark mx-2' onClick={logout}>logout</button>
        </div>
    )
}

export default Home