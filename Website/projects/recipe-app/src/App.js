// App.js
import React from 'react';
import AddRecipe from './AddRecipe';
import RecipeList from './RecipeList';

function App() {
  return (
    <div className="App">
      <h1>Recipe App</h1>
      {/* Other components or content */}
      <AddRecipe />
      <RecipeList />
    </div>
  );
}

export default App;
