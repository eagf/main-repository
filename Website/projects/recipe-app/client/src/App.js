import React, { useState, useEffect } from 'react';
import { BrowserRouter as Router, Route, Routes, Link } from 'react-router-dom';
import CookieConsent from './components/CookieConsent';
import RecipeSubmit from './components/RecipeSubmit';
import RecipeListUser from './components/RecipeListUser';
import LoginRegister from './components/LoginRegister';
import Logout from './components/Logout';

import './styles/Navbar.css';



const App = () => {
  const [isLoggedIn, setIsLoggedIn] = useState(false);

  useEffect(() => {
    const token = localStorage.getItem('token');
    if (token) {
      setIsLoggedIn(true);
    }
  }, []);

  return (
    <Router>
      <div className="App">
        <CookieConsent />
        <nav>
          <ul>
            <li>
              <Link to="/">Submit Recipe</Link>
            </li>
            <li>
              <Link to="/recipes">View Recipes</Link>
            </li>
          </ul>
          <Link to={isLoggedIn ? "/logout" : "/login"}>{isLoggedIn ? "Logout" : "Login / Register"}</Link>
        </nav>

        <Routes>
          <Route path="/" element={<RecipeSubmit />} />
          <Route path="/recipes" element={<RecipeListUser />} />
          <Route path="/login" element={<LoginRegister setIsLoggedIn={setIsLoggedIn} />} />
          <Route path="/logout" element={<Logout setIsLoggedIn={setIsLoggedIn} />} />
        </Routes>
      </div>
    </Router>
  );
}

export default App;
