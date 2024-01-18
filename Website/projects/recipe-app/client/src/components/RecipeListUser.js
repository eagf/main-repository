import React, { useEffect, useState } from 'react';
import axios from 'axios';
import { useNavigate } from 'react-router-dom';

import '../styles/RecipeListUser.css';

const apiUrl = process.env.REACT_APP_API_URL;

const RecipeListUser = () => {
    const navigate = useNavigate();
    const token = localStorage.getItem('token');

    useEffect(() => {
        if (!token) {
            navigate('/login');
        }
    }, []);

    const [recipes, setRecipes] = useState([]);
    const [searchTerm, setSearchTerm] = useState('');

    useEffect(() => {
        fetchRecipes('');
    }, []);

    const handleSearchChange = (e) => {
        setSearchTerm(e.target.value);
    };

    const handleSearchSubmit = () => {
        fetchRecipes(searchTerm);
    };

    const fetchRecipes = async (currentSearchTerm) => {
        try {
            const response = await axios.get(`${apiUrl}/api/recipes`, {
                headers: { Authorization: `Bearer ${token}` },
                params: { searchTerm: currentSearchTerm },
                withCredentials: true // cookies
            });
            setRecipes(response.data);
        } catch (error) {
            if (error.response && error.response.status === 401) {
                // JWT is expired or invalid
                localStorage.removeItem('token');
                // Update the login state and/or redirect to login
                navigate('/login');
            }
            console.error('Error fetching recipes', error);
        }
    };

    const handleDelete = async (recipeID) => {
        const confirmDelete = window.confirm("Are you sure you want to delete this recipe?");
        if (confirmDelete) {
            try {
                await axios.delete(`${apiUrl}/api/recipes/${recipeID}`);
                setRecipes(recipes.filter(recipe => recipe.recipeID !== recipeID));
            } catch (error) {
                console.error('Error deleting recipe', error);
            }
        }
    };
    return (
        <div>
            <div className="search-bar">
                <input
                    type="text"
                    placeholder="Search by ingredient..."
                    value={searchTerm}
                    onChange={handleSearchChange}
                    onKeyDown={event => {
                        if (event.key === 'Enter') {
                            handleSearchSubmit();
                        }
                    }}
                />
                <button onClick={handleSearchSubmit}>Search</button>
            </div>

            <div className="recipe-list">
                {recipes.length > 0 ? (
                    recipes.map(recipe => (
                        <div key={recipe.recipeID} className="recipe-grid">
                            <h3>{recipe.recipeName}</h3>
                            <ul>
                                {recipe.ingredients.map((ingredient, index) => (
                                    <li key={index}>{ingredient}</li>
                                ))}
                            </ul>
                            <p>{recipe.cookingSteps}</p>
                            <button onClick={() => navigate(`/recipes/${recipe.recipeID}`)} className="view-details-button">View Details</button>
                            <button onClick={() => handleDelete(recipe.recipeID)} className="delete-button">Delete</button>
                        </div>
                    ))
                ) : (
                    <p>No recipes found with the given ingredients.</p>
                )}
            </div>
        </div >
    );
};
export default RecipeListUser;
