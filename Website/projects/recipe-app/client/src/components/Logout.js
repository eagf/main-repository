import React, { useEffect, useState } from 'react';
import axios from 'axios';
import { useNavigate } from 'react-router-dom';

import '../styles/Logout.css';

const apiUrl = process.env.REACT_APP_API_URL;

const Logout = ({ setIsLoggedIn }) => {
    const navigate = useNavigate();
    const [userName, setUserName] = useState('');

    useEffect(() => {
        // Retrieve the user's name from localStorage
        const name = localStorage.getItem('userName');
        if (name) {
            setUserName(name);
        }
    }, []);

    const handleLogout = async () => {
        try {
            await axios.post(`${apiUrl}/api/logout`);
            localStorage.removeItem('token');
            localStorage.removeItem('userName'); // Remove userName from localStorage
            setIsLoggedIn(false);
            console.log('Logged out successfully');
            navigate('/login');
        } catch (error) {
            console.error('Logout failed:', error.response ? error.response.data : error.message);
        }
    };

    const handleDeleteAllRecipes = async () => {
        const confirmDelete = window.confirm("Are you sure you want to delete all your recipes?");
        if (confirmDelete) {
            try {
                // Replace with your API endpoint to delete all recipes
                await axios.delete(`${apiUrl}/api/delete-all-recipes`, {
                    headers: { Authorization: `Bearer ${localStorage.getItem('token')}` }
                });
                console.log('All recipes deleted successfully');
            } catch (error) {
                console.error('Error deleting recipes', error.response ? error.response.data : error.message);
            }
        }
    };

    return (
        <div className="logout-container">
            <h2>Welcome, {userName}!</h2>
            <button onClick={handleDeleteAllRecipes} className="delete-all-recipes-button">Delete All My Recipes</button>
            <button onClick={handleLogout} className="logout-button">Logout</button>
        </div>
    );
};

export default Logout;
