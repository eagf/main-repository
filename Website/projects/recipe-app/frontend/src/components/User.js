import React, { useEffect } from 'react';
import axios from 'axios';
import { useNavigate } from 'react-router-dom';

import '../styles/User.css';

const apiUrl = process.env.REACT_APP_API_URL;

const User = ({ setIsLoggedIn }) => {
    const navigate = useNavigate();

    useEffect(() => {
        const sessionToken = localStorage.getItem('sessionToken');

        if (!sessionToken) {
            navigate('/login');
        }
    }, []);

    const handleLogout = async () => {
        try {
            await axios.post(`${apiUrl}/api/logout.php`, {}, {
                withCredentials: true,
            });
            localStorage.removeItem('sessionToken');
            console.log('Logged out successfully');
            setIsLoggedIn(false);
            navigate('/login');
        } catch (error) {
            console.error('Logout failed:', error.response ? error.response.data : error.message);
        }
    };

    const handleLink = async () => {
        navigate('/removedRecipes');
    }

    return (
        <div className="logout-container">
            <h2>Welcome!</h2>
            <div className='buttons-div'>
                <button onClick={handleLogout} className="logout-button">Logout</button>
                <button onClick={handleLink} className="logout-button">Removed recipes</button>
            </div>
        </div>
    );
};

export default User;
