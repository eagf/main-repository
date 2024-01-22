// App.js

import React, { useState, useEffect } from 'react';
import { BrowserRouter as Router, Route, Routes, Link } from 'react-router-dom';

import CookieConsent from './components/CookieConsent';
import RecipeSubmit from './components/RecipeSubmit';
import RecipeListUser from './components/RecipeListUser';
import LoginRegister from './components/LoginRegister';
import User from './components/User';
import RecipeDetail from './components/RecipeDetail';

import './styles/Navbar.css';
import logo from './assets/img/logo.png';
import user from './assets/img/user.png';

const baseUrl = process.env.REACT_APP_BASE_URL;

const App = () => {
  const [isLoggedIn, setIsLoggedIn] = useState(false);
  const [buttonUserTo, setButtonUserTo] = useState("");
  const [buttonUserText, setButtonUserText] = useState("");

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
      setButtonUserText("User");
    } else {
      setButtonUserTo("/login");
      setButtonUserText("Login / Register");
    }
  }, [isLoggedIn]);

  return (
    <Router basename={baseUrl}>
      <div className="App">
        <CookieConsent />
        <nav>
          <Link to="/recipes">
            <img src={logo} alt='Logo' />
          </Link>
          <Link to={buttonUserTo} className="auth-link">
            <img src={user} alt='User' />
          </Link>
        </nav>

        <Routes>
          <Route path="/" element={<RecipeSubmit />} />
          <Route path="/recipes" element={<RecipeListUser />} />
          <Route path="/login" element={<LoginRegister setIsLoggedIn={setIsLoggedIn} isLoggedIn={isLoggedIn} />} />
          <Route path="/user" element={<User setIsLoggedIn={setIsLoggedIn} isLoggedIn={isLoggedIn} />} />
          <Route path="/recipes/:recipeId" element={<RecipeDetail />} />
        </Routes>
      </div>
    </Router>

  );
}

export default App;
