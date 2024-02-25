import React, { useState, useEffect } from 'react';
import axios from 'axios';
import { useParams, useNavigate } from 'react-router-dom';

import { FaPencilAlt } from 'react-icons/fa';
import { IoArrowBack } from 'react-icons/io5';
import { IoIosClose } from "react-icons/io";

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
    const [recipeImage, setRecipeImage] = useState(null);

    useEffect(() => {
        const sessionToken = localStorage.getItem('sessionToken');

        if (!sessionToken) {
            navigate('/login');
        }
    }, []);

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
        const formData = new FormData();
        formData.append('id', recipe.recipeID);
        formData.append('recipeName', editedRecipeName);
        formData.append('ingredients', JSON.stringify(editedIngredients));
        formData.append('cookingSteps', editedCookingSteps);

        if (recipeImage) {
            formData.append('recipeImage', recipeImage, recipeImage.name);
        }

        try {
            const response = await axios.post(`${apiUrl}/api/update_recipe.php`, formData, {
                withCredentials: true,
            });
            
            if (response.data.message) {
                setIsEditing(false);
                // Refresh the recipe data
                setRecipe({
                    ...recipe,
                    recipeName: editedRecipeName,
                    ingredients: editedIngredients,
                    cookingSteps: editedCookingSteps,
                    // Update image path if new image was uploaded
                    imagePath: response.data.imagePath || recipe.imagePath,
                    altText: response.data.altText || recipe.altText
                });
            }
        } catch (error) {
            console.error('Error updating recipe', error);
        }
    };


    const handleRemove = async (recipeID) => {
        const confirmRemove = window.confirm("Are you sure you want to remove this recipe?");
        if (confirmRemove) {
            try {
                await axios.post(`${apiUrl}/api/remove_recipe.php`, JSON.stringify({ id: recipeID }), {
                    withCredentials: true,
                    headers: {
                        'Content-Type': 'application/json',
                    },
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

    const handleAddIngredientField = () => {
        setEditedIngredients([...editedIngredients, '']);
    };

    const handleRemoveIngredientField = (index) => {
        const newIngredients = editedIngredients.filter((_, i) => i !== index);
        setEditedIngredients(newIngredients);
    };

    const handleImageChange = (e) => {
        setRecipeImage(e.target.files[0]);
    };

    const handleRemoveImage = async () => {
        try {
            // Use recipeId from useParams() instead of undefined recipeID
            const formData = new FormData();
            formData.append('id', recipeId); // Corrected variable name
    
            const response = await axios.post(`${apiUrl}/api/remove_recipe_image.php`, formData, {
                withCredentials: true,
            });
    
            if (response.data.message) {
                // Update local state to reflect the removed image
                setRecipe({
                    ...recipe,
                    imagePath: null,
                    altText: null,
                });
                setRecipeImage(null);
            }
        } catch (error) {
            console.error('Error removing recipe image', error);
        }
    };
    

    return (
        <div className='recipeDetail-div'>
            <div className="recipe-detail">
                <div className='top-line-div'>

                    <IoArrowBack onClick={handleBackClick} className="return-icon" />
                    {isEditing ? (
                        <>
                            <IoIosClose onClick={() => setIsEditing(false)} className="close-icon" />
                        </>
                    ) : (
                        <>
                            <FaPencilAlt onClick={() => setIsEditing(true)} className="edit-icon" />
                        </>
                    )}
                </div>
                {isEditing ? (
                    <>
                        <h3>Title recipe</h3>
                        <input type="text" value={editedRecipeName} onChange={(e) => setEditedRecipeName(e.target.value)} />
                        <h3>Ingredients</h3>
                        {editedIngredients.map((ingredient, index) => (
                            <div key={index} className="ingredient-edit-container">
                                <input
                                    type="text"
                                    value={ingredient}
                                    onChange={(e) => {
                                        const newIngredients = [...editedIngredients];
                                        newIngredients[index] = e.target.value;
                                        setEditedIngredients(newIngredients);
                                    }}
                                />
                                <button onClick={() => handleRemoveIngredientField(index)} className="remove-ingredient-button">-</button>
                            </div>
                        ))}
                        <button onClick={handleAddIngredientField} className="add-ingredient-button">+</button>
                        <h3>Cookings steps</h3>
                        <textarea
                            value={editedCookingSteps}
                            onChange={(e) => setEditedCookingSteps(e.target.value)}
                        />

                        <h3>Image</h3>
                        {recipe.imagePath ? (
                            <>
                                <img src={(apiUrl + recipe.imagePath)} alt={recipe.altText || 'Recipe image'} className="recipe-image" />
                                <button onClick={handleRemoveImage} className="remove-image-button">Remove Image</button>
                            </>
                        ) : (
                            <input type="file" onChange={handleImageChange} />
                        )}

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
                        {recipe.imagePath && (
                            <img src={(apiUrl + recipe.imagePath)} alt={recipe.altText || 'Recipe image'} className="recipe-image" />
                        )}
                        <button onClick={() => handleRemove(recipe.recipeID)} className="remove-button">Remove recipe</button>
                    </>
                )}
            </div>
        </div>
    );
};

export default RecipeDetail;
