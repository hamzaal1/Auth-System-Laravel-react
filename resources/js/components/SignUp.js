import React, { useEffect, useState } from 'react';
import axiosUser from './axios/axiosUser';
import useAuth from './hooks/useAuth';
import { NavLink } from 'react-router-dom';


function SignUp() {

  const [formInfo, setFormInfo] = useState({});
  const [formError, setFormError] = useState({ error: '' });
  const {isAuth,navigate} = useAuth();

  useEffect(() => {
    isAuth();
  }, [])


  const handleChange = (e) => {
    let value = e.target.type === 'checkbox' ? e.target.checked : e.target.value.trim();
    setFormInfo({
      ...formInfo,
      [e.target.name]: value
    });
  };

  const handleSubmit = async (e) => {
    e.preventDefault()
    if ((formInfo?.password && formInfo.password !== '') && (formInfo?.email && formInfo.email !== '') && (formInfo?.username && formInfo.username !== '')) {
      try {
        let req = await axiosUser.post('/register', {
          name: formInfo.username,
          email: formInfo.email,
          password: formInfo.password,
          password_confirmation:formInfo.password_confirmation
        });
        if (req.status==201) {
          navigate('/')
        }
      } catch (error) {
        error = error.response;
        setFormError({ 
          error: error.data.message,
          confimation:error.data.errors.password
         });

      }
    } else {
      setFormError({ error: 'All the fields are required' })
    }
  };

  return (
    <section className="mb-5 mt-3">
      <div className="container-fluid h-custom">
        <div className="row d-flex justify-content-center align-items-center h-100">
          <div className="col-md-9 col-lg-6 col-xl-5">
            <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.webp"
              className="img-fluid" alt="Sample image" />
          </div>
          <div className="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
            <form>
              <div className="d-flex flex-row align-items-center justify-content-center justify-content-lg-start mb-5">
                <h1 className="lead fw-normal mb-0 mx-auto fw-bold">Sign up</h1>
              </div>

              {/* <!-- Email input --> */}
              <div className="form-outline mb-4">
                <label className="form-label" htmlFor="form3Example3">Username</label>
                <input type="email" name="username" className="form-control form-control-lg"
                  placeholder="Enter username" onChange={handleChange} />
              </div>

              <div className="form-outline mb-4">
                <label className="form-label" htmlFor="form3Example3">Email address</label>
                <input type="email" name="email" className="form-control form-control-lg"
                  placeholder="Enter email address" onChange={handleChange} />
              </div>

              {/* <!-- Password input --> */}
              <div className="form-outline mb-3">
                <label className="form-label" htmlFor="form3Example4">Password</label>
                <input type="password" name="password" className="form-control form-control-lg"
                  placeholder="Enter password" onChange={handleChange} />
              </div>

              <div className="form-outline mb-3">
                <label className="form-label" htmlFor="form3Example4">Confirme Password</label>
                <input type="password" name="password_confirmation" className="form-control form-control-lg"
                  placeholder="Confirme password" onChange={handleChange} />
              </div>

              <p className="small text-danger mt-2 pt-1 mb-0 mt-3">
                {
                  formError?.confimation ? 
                  formError.confimation : formError.error
                }
              </p>
              <div className="text-center text-lg-start mt-2 pt-2 row">
                <button
                  type="button"
                  className="btn btn-primary btn-lg"
                  onClick={handleSubmit}>
                  Register
                </button>
              </div>
              <p className="small mt-2 pt-1 mb-0 text-center">
              have an account? <NavLink className="link-dark" to='/' >Signin</NavLink>
              </p>
            </form>
          </div>
        </div>
      </div>
    </section>
  )
}

export default SignUp;