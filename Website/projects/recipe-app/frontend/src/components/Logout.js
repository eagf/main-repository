import React from 'react';
import axios from 'axios';
import { useNavigate } from 'react-router-dom';

import '../styles/Logout.css';

const apiUrl = process.env.REACT_APP_API_URL;

const Logout = ({ setIsLoggedIn }) => {
    const navigate = useNavigate();

    const handleLogout = async () => {
        try {
            await axios.post(`${apiUrl}/api/logout.php`, {}, {
                withCredentials: true,
            });
            localStorage.removeItem('sessionToken');
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
                await axios.delete(`${apiUrl}/api/delete-all-recipes`);
                console.log('All recipes deleted successfully');
            } catch (error) {
                console.error('Error deleting recipes', error.response ? error.response.data : error.message);
            }
        }
    };

    return (
        <div className="logout-container">
            <h2>Welcome!</h2>
            <button onClick={handleDeleteAllRecipes} className="delete-all-recipes-button">Delete All My Recipes</button>
            <button onClick={handleLogout} className="logout-button">Logout</button>
        </div>
    );
};

export default Logout;
