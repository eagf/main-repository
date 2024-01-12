import React, { useEffect, useState } from 'react';
import axios from 'axios';
import { useNavigate } from 'react-router-dom';

import '../styles/RecipeListUser.css';

const RecipeListUser = () => {
    // Navigate unauthenticated users back to login page
    const navigate = useNavigate();
    const token = localStorage.getItem('token');

    useEffect(() => {
        if (!token) {
            navigate('/login');
        } else {
            fetchRecipes();
        }
    }, [navigate, token]);

    const [recipes, setRecipes] = useState([]);

    const fetchRecipes = async () => {
        try {
            const response = await axios.get('http://localhost:3001/api/recipes', {
                headers: { Authorization: `Bearer ${token}` }
            });
            setRecipes(response.data);
        } catch (error) {
            console.error('Error fetching recipes', error);
        }
    };

    const handleDelete = async (recipeID) => {
        try {
            await axios.delete(`http://localhost:3001/api/recipes/${recipeID}`);
            setRecipes(recipes.filter(recipe => recipe.recipeID !== recipeID));
        } catch (error) {
            console.error('Error deleting recipe', error);
        }
    };

    return (
        <div className="recipe-list">
            {recipes.map(recipe => (
                <div key={recipe.recipeID} className="recipe-grid">
                    <
                        h3>{recipe.recipeName}</h3>
                    <ul>
                        {recipe.ingredients.map((ingredient, index) => (
                            <li key={index}>{ingredient}</li>
                        ))}
                    </ul>
                    <p>{recipe.cookingSteps}</p>
                    <button onClick={() => handleDelete(recipe.recipeID)} className="delete-button">
                        Delete
                    </button>
                </div>
            ))}
        </div>
    );
};

export default RecipeListUser;