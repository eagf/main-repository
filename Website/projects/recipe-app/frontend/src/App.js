// App.js

import React, { useState, useEffect } from 'react';
import { BrowserRouter as Router, Route, Routes, Link } from 'react-router-dom';

import CookieConsent from './components/CookieConsent';
import RecipeSubmit from './components/RecipeSubmit';
import RecipeListUser from './components/RecipeListUser';
import LoginRegister from './components/LoginRegister';
import User from './components/User';
import RecipeDetail from './components/RecipeDetail';
import RemovedListUser from './components/RemovedListUser';

import './styles/Navbar.css';
import logo from './assets/logo/logo.png';
import { FiUser } from "react-icons/fi";

const baseUrl = process.env.REACT_APP_BASE_URL;

const App = () => {
  const [isLoggedIn, setIsLoggedIn] = useState("");
  const [buttonUserTo, setButtonUserTo] = useState("");

  useEffect(() => {
    const sessionToken = localStorage.getItem('sessionToken');
    if (sessionToken) {
      setIsLoggedIn(true);
    } else {
      setIsLoggedIn(false);
    }
  }, []);

  useEffect(() => {
    if (isLoggedIn) {
      setButtonUserTo("/user");
    } else {
      setButtonUserTo("/login");
    }
  }, [isLoggedIn]);

  return (
    <Router basename={baseUrl}>
      <div className="App">
        <CookieConsent />
        <nav>
          <Link to="/recipes">
            <img src={logo} alt='Logo' className='logo-main' />
          </Link>
          <Link to={buttonUserTo} className="auth-link">
            <FiUser className="logo-user"/>
          </Link>
        </nav>

        <Routes>
          <Route path="/" element={<RecipeSubmit />} />
          <Route path="/recipes" element={<RecipeListUser />} />
          <Route path="/login" element={<LoginRegister setIsLoggedIn={setIsLoggedIn} isLoggedIn={isLoggedIn} />} />
          <Route path="/user" element={<User setIsLoggedIn={setIsLoggedIn} isLoggedIn={isLoggedIn} />} />
          <Route path="/recipes/:recipeId" element={<RecipeDetail />} />
          <Route path="/removedRecipes" element={<RemovedListUser />} />
        </Routes>
      </div>
    </Router>

  );
}

export default App;
