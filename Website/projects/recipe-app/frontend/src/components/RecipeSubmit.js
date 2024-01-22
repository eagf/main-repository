import React, { useState, useEffect } from 'react';
import axios from 'axios';
import { useNavigate } from 'react-router-dom';

import '../styles/RecipeSubmit.css';

const apiUrl = process.env.REACT_APP_API_URL;

const RecipeSubmit = () => {
    const navigate = useNavigate();

    useEffect(() => {
        const sessionToken = localStorage.getItem('sessionToken');

        if (!sessionToken) {
            navigate('/login');
        }
    }, []);

    const [recipeName, setRecipeName] = useState('');
    const [ingredients, setIngredients] = useState(['']);
    const [cookingSteps, setCookingSteps] = useState('');
    const [confirmationMessage, setConfirmationMessage] = useState('');

    const handleAddIngredient = () => {
        setIngredients([...ingredients, '']);
    };

    const handleIngredientChange = (index, event) => {
        const newIngredients = [...ingredients];
        newIngredients[index] = event.target.value;
        setIngredients(newIngredients);
    };

    const handleSubmit = async (event) => {
        event.preventDefault();
        try {
            const formData = new URLSearchParams();
            formData.append('recipeName', recipeName);
            ingredients.forEach((ingredient, index) => formData.append(`ingredients[${index}]`, ingredient));
            formData.append('cookingSteps', cookingSteps);

            const response = await axios.post(`${apiUrl}/api/submit_recipe.php`, formData, {
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                withCredentials: true,
            });
            // Reset form fields
            setRecipeName('');
            setIngredients(['']);
            setCookingSteps('');

            // Set confirmation message
            setConfirmationMessage('Recipe submitted successfully!');

            // Optionally, clear the message after a few seconds
            setTimeout(() => setConfirmationMessage(''), 5000);
        } catch (error) {
            if (error.response && error.response.status === 401) {
                localStorage.removeItem('sessionToken');
                navigate('/login');
            }
            console.error('Error submitting recipe:', error.response ? error.response.data : error);
        }
    };

    return (
        <div className="submit-div">
            <form onSubmit={handleSubmit} className="recipe-submit-form">
                <input
                    type="text"
                    value={recipeName}
                    onChange={e => setRecipeName(e.target.value)}
                    placeholder="Recipe Name"
                />
                {ingredients.map((ingredient, index) => (
                    <input
                        key={index}
                        type="text"
                        value={ingredient}
                        onChange={e => handleIngredientChange(index, e)}
                        placeholder="Ingredient"
                    />
                ))}
                <button type="button" onClick={handleAddIngredient}>+</button>
                <textarea
                    value={cookingSteps}
                    onChange={e => setCookingSteps(e.target.value)}
                    placeholder="Cooking Steps"
                />
                <button type="submit">Submit Recipe</button>

                {confirmationMessage && <div className="confirmation-message">{confirmationMessage}</div>}
            </form>
            <button onClick={() => navigate('/recipes')} className="recipes-button">Go to recipes</button>
        </div>
    );
};

export default RecipeSubmit;
