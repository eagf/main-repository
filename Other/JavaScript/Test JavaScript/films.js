"use strict";

var indexFilm = 0;
const titel = document.getElementById("titel");
const beschrijving = document.getElementById("beschrijving");
const cast = document.getElementById("cast");
const foto = document.getElementById("foto");
const genres = document.getElementById("genres");
const rating = document.getElementById("rating");
const regisseurs = document.getElementById("regisseurs");

leesFilms();

async function leesFilms() {
    const response = await fetch("films.json");
    const films = await response.json();
    invullenFilm(films);
    controleKnoppen(films);
};

function controleKnoppen(films) {
    if (indexFilm === 0) {
        document.getElementById("vorige").disabled = true;
    } else if (indexFilm === (films.length - 1)) {
        document.getElementById("volgende").disabled = true;
    } else {
        document.getElementById("vorige").disabled = false;
        document.getElementById("volgende").disabled = false;
    };
    document.getElementById("vorige").onclick = function() {
        gekozenKnop("vorige", films);
    };
    document.getElementById("volgende").onclick = function() {
        gekozenKnop("volgende", films);
    };
};

function gekozenKnop(keuze, films) {
    if (keuze === "vorige") {
        indexFilm -= 1;
    } else if (keuze === "volgende") {
        indexFilm += 1;
    };
    invullenFilm(films);
    controleKnoppen(films);
}

function invullenFilm(films) {
    wissenFilms();
    titel.innerText = films[indexFilm].titel;
    beschrijving.innerText = films[indexFilm].beschrijving;
    for (var castlid of films[indexFilm].cast) {
        const lijstItem = document.createElement("li");
        lijstItem.innerText = castlid;
        cast.appendChild(lijstItem);
    }
    foto.src = films[indexFilm].foto;
    for (var genre of films[indexFilm].genres) {
        const lijstItem = document.createElement("li");
        lijstItem.innerText = genre;
        genres.appendChild(lijstItem);
    };
    for (var teller = 1; teller <= films[indexFilm].rating; teller ++) {
        const ster = document.createElement("img");
        ster.src = "ster.png";
        rating.appendChild(ster);
    };
    for (var regisseur of films[indexFilm].regisseurs) {
        const lijstItem = document.createElement("li");
        lijstItem.innerText = regisseur;
        regisseurs.appendChild(lijstItem);
    }
};

function wissenFilms() {
    cast.innerHTML = "";
    genres.innerHTML = "";
    rating.innerHTML = "";
    regisseurs.innerHTML = "";
};
