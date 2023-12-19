import React from 'react'

import MovieCard from './MovieCard'

const MovieCards = ({ movies }) => {

    return (
    movies?.length > 0
        ? (
          <div className='container'>
            {movies.map((movie) => (
              <MovieCard movie={movie} key={movie.imdbID}/>
            ))}
          </div>
        ) : (
          <div className='empty'>
            <h2>Geen films gevonden</h2>
          </div>
        )
  )
  
}

export default MovieCards
