// Logout.js
import React from 'react';
import axios from 'axios';
import { useNavigate } from 'react-router-dom';

import '../styles/Logout.css';


const Logout = ({ setIsLoggedIn }) => {

    const navigate = useNavigate();

    const handleLogout = async () => {
        try {
            // Call the logout endpoint
            await axios.post('http://localhost:3001/api/logout');

            // Clear the token from localStorage
            localStorage.removeItem('token');
            setIsLoggedIn(false); // Update login state

            // Redirect or update UI as needed
            console.log('Logged out successfully');
            navigate('/login'); // Redirect to LoginRegister page
        } catch (error) {
            console.error('Logout failed:', error.response ? error.response.data : error.message);
        }
    };

    return (
        <div className="logout-container">
            <button onClick={handleLogout} className="logout-button">Logout</button>
        </div>
    );
};

export default Logout;