// AddRecipe.js
import React, { useState } from 'react';
import API_BASE_URL from './config';

const AddRecipe = () => {
    const [recipeName, setRecipeName] = useState('');
    const [ingredients, setIngredients] = useState('');
    const [cookingSteps, setCookingSteps] = useState('');

    const handleSubmit = async (e) => {
        e.preventDefault();

        // Send data to the backend
        const response = await fetch(`${API_BASE_URL}/recipes`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                name: recipeName,
                ingredients: ingredients.split(',').map(ingredient => ingredient.trim()),
                cookingSteps: cookingSteps.split('\n').map(step => step.trim()),
            }),
        });

        if (response.ok) {
            // Handle success, e.g., redirect to a success page or reset form
            console.log('Recipe added successfully!');
        } else {
            // Handle error, e.g., display an error message to the user
            console.error('Failed to add recipe');
        }
    };

    return (
        <div>
            <h2>Add Recipe</h2>
            <form onSubmit={handleSubmit}>
                <label>
                    Recipe Name:
                    <input
                        type="text"
                        value={recipeName}
                        onChange={(e) => setRecipeName(e.target.value)}
                    />
                </label>
                <br />
                <label>
                    Ingredients:
                    <textarea
                        value={ingredients}
                        onChange={(e) => setIngredients(e.target.value)}
                    />
                </label>
                <br />
                <label>
                    Cooking Steps:
                    <textarea
                        value={cookingSteps}
                        onChange={(e) => setCookingSteps(e.target.value)}
                    />
                </label>
                <br />
                <button type="submit">Add Recipe</button>
            </form>
        </div>
    );
};

export default AddRecipe;
