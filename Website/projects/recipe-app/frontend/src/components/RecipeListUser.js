import React, { useEffect, useState } from 'react';
import axios from 'axios';
import { useNavigate } from 'react-router-dom';

import defaultImage from '../assets/img/default.png';

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

    return (
        <div className='recipeListUser-div'>
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
            <div className='recipe-grid-div'>
                <div className='recipe-grid'>
                    {recipes.length > 0 ? (
                        recipes.map(recipe => (
                            <div onClick={() => navigate(`/recipes/${recipe.recipeID}`)} key={recipe.recipeID} className="recipe-grid-item">
                                <img
                                    src={recipe.imagePath || defaultImage}
                                    alt={recipe.altText || 'Default image'}
                                    className="recipe-image"
                                />
                                <h3>{recipe.recipeName}</h3>
                                <ul>
                                    {recipe.ingredients.map((ingredient, index) => (
                                        <li key={index}>{ingredient}</li>
                                    ))}
                                </ul>
                                <p>{recipe.cookingSteps}</p>
                            </div>
                        ))
                    ) : (
                        <p>No recipes found with the given ingredients.</p>
                    )}
                </div>
            </div>
        </div >
    );
};
export default RecipeListUser;
