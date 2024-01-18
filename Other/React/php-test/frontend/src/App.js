import React, { useState, useEffect } from 'react';
import axios from 'axios';

function App() {
  const [message, setMessage] = useState('');

  useEffect(() => {
    // Update the URL to match the endpoint where your PHP file is served
    axios.get('http://localhost/main-repository/Other/React/php-test/backend/api.php')
      .then(response => {
        setMessage(response.data.message);
      })
      .catch(error => console.error('Error:', error));
  }, []);

  return (
    <div className="App">
      <header className="App-header">
        <p>{message}</p>
      </header>
    </div>
  );
}

export default App;
