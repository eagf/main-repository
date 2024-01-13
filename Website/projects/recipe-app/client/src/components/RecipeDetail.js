// RecipeDetail.js
import React, { useEffect, useState } from 'react';
import axios from 'axios';
import { useParams } from 'react-router-dom';

import '../styles/RecipeDetail.css';

const RecipeDetail = () => {
    const { recipeId } = useParams();
    const [recipe, setRecipe] = useState(null);

    const token = localStorage.getItem('token');

    useEffect(() => {
        const fetchRecipe = async () => {
            try {
                const response = await axios.get(`http://localhost:3001/api/recipes/${recipeId}`, {
                    headers: { Authorization: `Bearer ${token}` }
                });
                setRecipe(response.data);
            } catch (error) {
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
