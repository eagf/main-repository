import React, { useEffect, useState } from 'react';
import axios from 'axios';
import { useNavigate } from 'react-router-dom';

import '../styles/RecipeListUser.css';

const apiUrl = process.env.REACT_APP_API_URL;

const RecipeListUser = () => {
    const navigate = useNavigate();

    useEffect(() => {
        const sessionToken = localStorage.getItem('sessionToken');

        if (!sessionToken) {
            navigate('/login');
        }
        fetchRecipes('');
    }, []);

    const [recipes, setRecipes] = useState([]);
    const [searchTerm, setSearchTerm] = useState('');

    useEffect(() => {
        fetchRecipes(searchTerm);
    }, [searchTerm])

    const handleSearchChange = (e) => {
        setSearchTerm(e.target.value);
    };

    const handleSearchSubmit = () => {
        fetchRecipes(searchTerm);
    };

    const fetchRecipes = async (currentSearchTerm) => {
        try {
            const response = await axios.get(`${apiUrl}/api/get_recipes.php`, {
                params: { searchTerm: currentSearchTerm },
                withCredentials: true
            });
            setRecipes(response.data);
        } catch (error) {
            if (error.response && error.response.status === 401) {
                navigate('/login');
            }
            console.error('Error fetching recipes', error);
        }
    };

    const handleRemove = async (recipeID) => {
        const confirmRemove = window.confirm("Are you sure you want to remove this recipe?");
        if (confirmRemove) {
            try {
                await axios.post(`${apiUrl}/api/remove_recipe.php`, { id: recipeID }, {
                    withCredentials: true
                });
                setRecipes(recipes.filter(recipe => recipe.recipeID !== recipeID));
            } catch (error) {
                console.error('Error removing recipe', error);
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
                <button onClick={() => navigate('/')} className="add-button">+</button>
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
                            <button onClick={() => handleRemove(recipe.recipeID)} className="remove-button">Remove</button>
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
