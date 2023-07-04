import React, { useState, useEffect} from 'react';
import { useNavigate } from 'react-router-dom';
import Header from './Header';

function Register() {
  useEffect(()=>{
    if(localStorage.getItem("user-info"))
    {
      navigate('/');
    }
  })
  const [name, setName] = useState('');
  const [email, setEmail] = useState('');
  const [password, setPassword] = useState('');
  const [phone_number, setPhone_number] = useState('');
  const navigate = useNavigate();

  async function signUp() {
    let item = { name, email, password ,phone_number};
    console.warn(item);

    try {
      let response = await fetch('http://localhost:8000/api/register', {
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
        navigate('/addProduct');
      } else {
        console.error('Registration failed:', response.status);
        // Handle the registration failure here
      }
    } catch (error) {
      console.error('Error during registration:', error);
      // Handle the registration error here
    }
  }

  return (
    <div className="col-sm-6 offset-sm-3">
      <h1>Register Page</h1>
      <input
        type="text" value={name}
        onChange={(e) => setName(e.target.value)}
        className="form-control"
        placeholder="Name"
      />
      <br />
      <br />
      <input
        type="email"
        //value={email}
        onChange={(e) => setEmail(e.target.value)}
        className="form-control"
        placeholder="Email"
      />
      <br />
      <br />
      <input
        type="password"
        //value={password}
        onChange={(e) => setPassword(e.target.value)}
        className="form-control"
        placeholder="Password"
      />
      <br />
      <br />
      <input
        type="text"
        onChange={(e) => setPhone_number(e.target.value)}
        className="form-control"
        placeholder="phone number"
        />
        <br />
        <br />
      <button onClick={signUp} className="btn btn-primary">
        SIGN UP
      </button>
    </div>
    //</>
  );
}

export default Register;
