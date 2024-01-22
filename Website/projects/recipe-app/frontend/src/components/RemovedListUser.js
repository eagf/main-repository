import React, { useEffect, useState } from 'react';
import axios from 'axios';
import { useNavigate } from 'react-router-dom';

import '../styles/RecipeListUser.css';

const apiUrl = process.env.REACT_APP_API_URL;

const RemovedListUser = () => {
    const navigate = useNavigate();
    const [recipes, setRecipes] = useState([]);

    useEffect(() => {
        const sessionToken = localStorage.getItem('sessionToken');

        if (!sessionToken) {
            navigate('/login');
        } else {
            fetchRemovedRecipes();
        }
    }, []);

    const fetchRemovedRecipes = async () => {
        try {
            const response = await axios.get(`${apiUrl}/api/get_removed.php`, {
                withCredentials: true
            });
            setRecipes(response.data);
        } catch (error) {
            if (error.response && error.response.status === 401) {
                navigate('/login');
            }
            console.error('Error fetching removed recipes', error);
        }
    };

    const handleRestore = async (recipeID) => {
        const confirmRestore = window.confirm("Are you sure you want to restore this recipe?");
        if (confirmRestore) {
            try {
                await axios.post(`${apiUrl}/api/restore_recipe.php`, { id: recipeID }, {
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    withCredentials: true
                });
                // Refresh the removed recipes list
                fetchRemovedRecipes();
            } catch (error) {
                console.error('Error restoring recipe', error);
            }
        }
    };

    return (
        <div className='recipe-grid-div'>
            <h2>Removed Recipes</h2>
            <div className='recipe-grid'>
                {recipes.length > 0 ? (
                    recipes.map(recipe => (
                        <div key={recipe.recipeID} className="recipe-grid-item">
                            <h3>{recipe.recipeName}</h3>
                            <ul>
                                {recipe.ingredients.map((ingredient, index) => (
                                    <li key={index}>{ingredient}</li>
                                ))}
                            </ul>
                            <p>{recipe.cookingSteps}</p>
                            <button onClick={() => handleRestore(recipe.recipeID)} className="restore-button">
                                Restore
                            </button>
                        </div>
                    ))
                ) : (
                    <p>No removed recipes found.</p>
                )}
            </div>
        </div>
    );
};

export default RemovedListUser;
