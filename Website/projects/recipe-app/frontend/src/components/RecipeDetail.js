import React, { useState, useEffect } from 'react';
import axios from 'axios';
import { useParams, useNavigate } from 'react-router-dom';

import { FaPencilAlt } from 'react-icons/fa';
import { IoArrowBack } from 'react-icons/io5';

import '../styles/RecipeDetail.css';

const apiUrl = process.env.REACT_APP_API_URL;

const RecipeDetail = () => {
    const { recipeId } = useParams();
    const navigate = useNavigate();
    const [recipe, setRecipe] = useState(null);
    const [isEditing, setIsEditing] = useState(false);
    const [editedRecipeName, setEditedRecipeName] = useState('');
    const [editedIngredients, setEditedIngredients] = useState(['']);
    const [editedCookingSteps, setEditedCookingSteps] = useState('');

    useEffect(() => {
        const fetchRecipe = async () => {
            try {
                const response = await axios.get(`${apiUrl}/api/get_recipe.php`, {
                    params: { id: recipeId },
                    withCredentials: true
                });
                setRecipe(response.data);
                // Initialize the edit fields
                setEditedRecipeName(response.data.recipeName);
                setEditedIngredients(response.data.ingredients);
                setEditedCookingSteps(response.data.cookingSteps);
            } catch (error) {
                console.error('Error fetching recipe details', error);
            }
        };
        fetchRecipe();
    }, [recipeId]);

    const handleSave = async () => {
        try {
            await axios.post(`${apiUrl}/api/update_recipe.php`, {
                id: recipe.recipeID,
                recipeName: editedRecipeName,
                ingredients: editedIngredients,
                cookingSteps: editedCookingSteps
            }, {
                withCredentials: true
            });
            setIsEditing(false);
            // Refresh the recipe data
            setRecipe({
                ...recipe,
                recipeName: editedRecipeName,
                ingredients: editedIngredients,
                cookingSteps: editedCookingSteps
            });
        } catch (error) {
            console.error('Error updating recipe', error);
        }
    };

    const handleRemove = async (recipeID) => {
        const confirmRemove = window.confirm("Are you sure you want to remove this recipe?");
        if (confirmRemove) {
            try {
                await axios.post(`${apiUrl}/api/remove_recipe.php`, { id: recipeID }, {
                    withCredentials: true
                });
                navigate('/recipes');
            } catch (error) {
                console.error('Error removing recipe', error);
            }
        }
    };

    const handleBackClick = () => {
        navigate('/recipes');
    };

    if (!recipe) {
        return <div>Loading...</div>;
    }

    return (
        <div className='recipeDetail-div'>
            <div className="recipe-detail">
                <div className='top-line-div'>
                    <IoArrowBack onClick={handleBackClick} className="return-icon" />
                    <FaPencilAlt onClick={() => setIsEditing(!isEditing)} className="edit-icon" />
                </div>
                {isEditing ? (
                    <>
                        <input type="text" value={editedRecipeName} onChange={(e) => setEditedRecipeName(e.target.value)} />
                        {editedIngredients.map((ingredient, index) => (
                            <input
                                key={index}
                                type="text"
                                value={ingredient}
                                onChange={(e) => {
                                    const newIngredients = [...editedIngredients];
                                    newIngredients[index] = e.target.value;
                                    setEditedIngredients(newIngredients);
                                }}
                            />
                        ))}
                        <textarea
                            value={editedCookingSteps}
                            onChange={(e) => setEditedCookingSteps(e.target.value)}
                        />
                        <button onClick={handleSave} className="save-button">Save</button>
                    </>
                ) : (
                    <>
                        <h2>{recipe.recipeName}</h2>
                        <h3>Ingredients</h3>
                        <ul>
                            {recipe.ingredients.map((ingredient, index) => (
                                <li key={index}>{ingredient}</li>
                            ))}
                        </ul>
                        <h3>Cooking Steps</h3>
                        <p>{recipe.cookingSteps}</p>
                        <button onClick={() => handleRemove(recipe.recipeID)} className="remove-button">Remove</button>
                    </>
                )}
            </div>
        </div>
    );
};

export default RecipeDetail;
