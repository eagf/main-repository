// LoginRegister.js
import React, { useState } from 'react';
import axios from 'axios';
import { useNavigate } from 'react-router-dom';

import '../styles/LoginRegister.css';

const LoginRegister = ({ setIsLoggedIn }) => {
    const [isLogin, setIsLogin] = useState(true);
    const [email, setEmail] = useState('');
    const [password, setPassword] = useState('');
    const [name, setName] = useState(''); // Only needed for registration
    const [errorMessage, setErrorMessage] = useState(''); // State to handle error messages

    const navigate = useNavigate();

    const handleSubmit = async (event) => {
        event.preventDefault();
        setErrorMessage(''); // Reset error message

        try {
            const endpoint = isLogin ? '/api/login' : '/api/register';
            const userData = isLogin ? { email, password } : { email, name, password };

            const response = await axios.post(`http://localhost:3001${endpoint}`, userData);

            if (isLogin) {
                if (response.data.token) {
                    localStorage.setItem('token', response.data.token);
                    setIsLoggedIn(true);
                    navigate('/');
                } else {
                    setErrorMessage('Login failed. Please try again.');
                }
            } else {
                // For registration
                console.log('Registered successfully, please log in');
                // Optionally redirect to login page or automatically log in the user
                setIsLoggedIn(false); // In case of registration, stay on the login page

            }
        } catch (error) {
            setErrorMessage(error.response ? error.response.data : 'Something went wrong. Please try again.');
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