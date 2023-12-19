import { useState } from 'react'

// Import components

import MovieCards from './components/MovieCards'

// Import stylesheet

import './App.css'
import SearchIcon from "./search.svg";

// API key OMDb vdabcampus   27780780

const API_URL = 'http://www.omdbapi.com?apikey=27780780'

function App() {

  const [movies, setMovies] = useState([])

  const [searchTerm, setSearchTerm] = useState([''])

  // Fetch Movies

  const fetchMovies = async (title) => {
    const response = await fetch(`${API_URL}&s=${title}`)
    const data = await response.json()
    console.log(data.Search)
    setMovies(data.Search)
  }


  return (
    <div className='app'>
      <h1>Films</h1>

      <div className='search'>
        <input
          type="text"
          placeholder='Zoeken naar filmtitels'
          value={searchTerm}
          onChange={(e) => {
            setSearchTerm(e.target.value)
          }}
        />
        <img
          src={SearchIcon}
          alt="search"
          onClick={(e) => fetchMovies(searchTerm)}
        />
      </div>

      <MovieCards movies={movies} />
    </div>
  )
}

export default App
