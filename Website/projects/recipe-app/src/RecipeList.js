// RecipeList.js
import React, { useState, useEffect } from 'react';
import API_BASE_URL from './config';

const RecipeList = () => {
    const [recipes, setRecipes] = useState([]);

    useEffect(() => {
        // Fetch all recipes from the backend
        const fetchRecipes = async () => {
            try {
                const response = await fetch(`${API_BASE_URL}/recipes`);
                if (response.ok) {
                    const data = await response.json();
                    setRecipes(data);
                } else {
                    console.error('Failed to fetch recipes');
                }
            } catch (error) {
                console.error('Error:', error);
            }
        };

        fetchRecipes();
    }, []);

    return (
        <div>
            <h2>All Recipes</h2>
            <ul>
                {recipes.map(recipe => (
                    <li key={recipe.id}>
                        <strong>{recipe.name}</strong>
                        <ul>
                            <li>Ingredients: {recipe.ingredients.join(', ')}</li>
                            <li>Cooking Steps: {recipe.cookingSteps.join(', ')}</li>
                        </ul>
                    </li>
                ))}
            </ul>
        </div>
    );
};

export default RecipeList;
