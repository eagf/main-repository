// RecipeDetail.js
import React, { useEffect, useState } from 'react';
import axios from 'axios';
import { useParams } from 'react-router-dom';
import { useNavigate } from 'react-router-dom';

import '../styles/RecipeDetail.css';

const apiUrl = process.env.REACT_APP_API_URL;

const RecipeDetail = () => {
    const navigate = useNavigate();
    const { recipeId } = useParams();
    const [recipe, setRecipe] = useState(null);

    useEffect(() => {
        const fetchRecipe = async () => {
            try {
                const response = await axios.get(`${apiUrl}/api/get_recipe.php`, {
                    params: { id: recipeId },
                    withCredentials: true
                });
                setRecipe(response.data);
            } catch (error) {
                if (error.response && error.response.status === 401) {
                    localStorage.removeItem('sessionToken');
                    navigate('/login');
                }
                console.error('Error fetching recipe details', error);
            }
        };

        fetchRecipe();
    }, [recipeId]);

    if (!recipe) {
        return <div>Loading...</div>;
    }

    return (
        <div className="recipe-detail">
            <h2>{recipe.recipeName}</h2>
            <h3>Ingredients</h3>
            <ul>
                {recipe.ingredients.map((ingredient, index) => (
                    <li key={index}>{ingredient}</li>
                ))}
            </ul>
            <h3>Cooking Steps</h3>
            <p>{recipe.cookingSteps}</p>
        </div>
    );
};

export default RecipeDetail;
