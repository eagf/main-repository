// LoginRegister.js
import React, { useState, useEffect } from 'react';
import axios from 'axios';
import { useNavigate } from 'react-router-dom';

import '../styles/LoginRegister.css';

const apiUrl = process.env.REACT_APP_API_URL;

const LoginRegister = ({setIsLoggedIn}) => {
    const navigate = useNavigate();

    useEffect(() => {
        const sessionToken = localStorage.getItem('sessionToken');

        if (!sessionToken) {
            navigate('/login');
        }
    }, []);

    const [isLogin, setIsLogin] = useState(true);
    const [email, setEmail] = useState('');
    const [password, setPassword] = useState('');
    const [name, setName] = useState(''); // Only needed for registration
    const [errorMessage, setErrorMessage] = useState(''); // State to handle error messages

    const handleSubmit = async (event) => {
        event.preventDefault();
        setErrorMessage(''); // Reset error message

        try {
            const endpoint = isLogin ? `${apiUrl}/api/login.php` : `${apiUrl}/api/register.php`;
            const userData = isLogin ? { email, password } : { email, name, password };

            const response = await axios.post(endpoint, userData, {
                headers: {
                    'Content-Type': 'application/json'
                },
                withCredentials: true
            });

            if (response.data) {
                // console.log('response.data = ', response.data);
                // console.log('response.data.sessionToken = ', response.data.sessionToken);
                if (response.data.sessionToken) {
                    localStorage.setItem('sessionToken', response.data.sessionToken);
                    setIsLoggedIn(true);
                    console.log('Login complete.');
                    navigate('/recipes');
                } else {
                    console.log('Registration complete.');
                }
            } else {
                setErrorMessage('Login/Registration failed. Please try again.');
            }
        } catch (error) {
            setErrorMessage(error.response ? error.response.data.error : 'Something went wrong. Please try again.');
        }
    };


    return (
        <div className="login-register-container">
            {errorMessage && <p className="error-message">{errorMessage}</p>}
            <form onSubmit={handleSubmit}>
                {/* Common fields */}
                <input type="email" value={email} onChange={e => setEmail(e.target.value)} placeholder="Email" required />
                <input type="password" value={password} onChange={e => setPassword(e.target.value)} placeholder="Password" required />
                {!isLogin && <input type="text" value={name} onChange={e => setName(e.target.value)} placeholder="Name" required />}
                <button type="submit">{isLogin ? 'Login' : 'Register'}</button>
            </form>
            <button className="toggle-button" onClick={() => setIsLogin(!isLogin)}>
                {isLogin ? 'Go to Register' : 'Go to Login'}
            </button>
        </div>
    );
};

export default LoginRegister;