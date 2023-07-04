import Header from './Header';
import React, { useState, useEffect } from 'react';
import { useNavigate } from 'react-router-dom';

function Login() {
  const [email, setEmail] = useState("");
  const [password, setPassword] = useState("");
  const navigate = useNavigate();

  useEffect(() => {
    if (localStorage.getItem("user-info")) {
      navigate('/protected');
    }
  }, []);

  async function login() {
    let item = { email, password };
    console.warn(item);

    try {
      let response = await fetch('http://localhost:8000/api/login', {
        method: 'POST',
        body: JSON.stringify(item),
        headers: {
          'Content-Type': 'application/json',
          Accept: 'application/json',
        },
      });

      if (response.ok) {
        let result = await response.json();
        console.log('result', result);
        localStorage.setItem('user-info', JSON.stringify(result));
        navigate('/protected');
      } else {
        console.error('Logging in failed:', response.status);
        // Handle the login failure here
      }
    } catch (error) {
      console.error('Error during login:', error);
      // Handle the login error here
    }
  }

  return (
    <div className='col-sm-6 offset-sm-3'>
      <h1>Login Page</h1>
      <input type="text" placeholder="email" onChange={(e) => setEmail(e.target.value)} className="form-control" /><br />
      <input type="password" placeholder="password" onChange={(e) => setPassword(e.target.value)} className="form-control" /><br />
      <button onClick={login} className="btn btn-primary">Login</button>
    </div>
  );
}

export default Login;
