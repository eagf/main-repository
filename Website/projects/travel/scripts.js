// invullen pagina "meer info"

async function invullenMeerInfo(index) {
    const responseJSON = await fetch("./bestemmingen.json");
    const bestemmingen = await responseJSON.json();
    const bestemming = bestemmingen[index];

    const meerInfoBestemming = document.getElementById('meerInfoBestemming');

    const title = document.createElement('h2');
    title.textContent = bestemming.bestemming;

    const image = document.createElement('img');
    image.src = bestemming.afbeelding;
    image.alt = bestemming.bestemming;

    const startDatumString = bestemming["startdatum"];
    const [day, month, year] = startDatumString.split('/');
    const startDate = new Date(`${year}-${month}-${day}`);

    const eindDatumString = bestemming["einddatum"];
    const [day_2, month_2, year_2] = eindDatumString.split('/');
    const endDate = new Date(`${year_2}-${month_2}-${day_2}`);

    const options = { year: 'numeric', month: '2-digit', day: '2-digit' };
    const startDateString = startDate.toLocaleDateString('en-GB', options);
    const endDateString = endDate.toLocaleDateString('en-GB', options);

    const date = document.createElement('p');
    date.textContent = `Reisperiode: ${startDateString} - ${endDateString}`;

    meerInfoBestemming.appendChild(title);
    meerInfoBestemming.appendChild(image);
    meerInfoBestemming.appendChild(date);

    const latitude = bestemming["latitude"];
    const longitude = bestemming["longitude"];

    const today = new Date();
    const sevenDaysLater = new Date();
    sevenDaysLater.setDate(today.getDate() + 6);

    const yearString = today.getFullYear();
    const monthString = String(today.getMonth() + 1).padStart(2, '0');
    const dayString = String(today.getDate()).padStart(2, '0');
    const startDateStringJSON = `${yearString}-${monthString}-${dayString}`;

    const yearString2 = sevenDaysLater.getFullYear();
    const monthString2 = String(sevenDaysLater.getMonth() + 1).padStart(2, '0');
    const dayString2 = String(sevenDaysLater.getDate()).padStart(2, '0');
    const endDateStringJSON = `${yearString2}-${monthString2}-${dayString2}`;

    const response = await fetch(`https://api.open-meteo.com/v1/forecast?latitude=${latitude}&longitude=${longitude}&daily=weathercode,temperature_2m_max,temperature_2m_min,apparent_temperature_max,apparent_temperature_min,uv_index_max&timezone=auto&start_date=${startDateStringJSON}&end_date=${endDateStringJSON}`);
    const weersbericht = await response.json();

    console.log(weersbericht);

    // aanmaken tabel

    const weertabel = document.getElementById('weather-content');

    const weerTitel = document.createElement('h3');
    weerTitel.textContent = 'Huidig weerbericht';
    weertabel.appendChild(weerTitel);

    const tabel = document.createElement('table');

    const tabelRowTop = document.createElement('tr');

    const tableHeader = document.createElement('th');
    tableHeader.textContent = '';
    tabelRowTop.appendChild(tableHeader);

    var datum = today;
    for (let i = 0; i < 7; i++) {
        const tableHeader = document.createElement('th');
        const volledigeDag = datum.toLocaleDateString('nl-NL', { weekday: 'long' });
        const afkortingDag = volledigeDag.substr(0, 2);
        tableHeader.textContent = afkortingDag + ' ' + datum.getDate() + '/' + (datum.getMonth() + 1);
        tabelRowTop.appendChild(tableHeader);
        datum.setDate(datum.getDate() + 1);
    }

    tabel.appendChild(tabelRowTop);

    const tabelRowBottom = document.createElement('tr');
    const tabelRowBottomStart = document.createElement('th');
    tabelRowBottomStart.textContent = 'max min';
    tabelRowBottom.appendChild(tabelRowBottomStart);
    for (let i = 0; i < 7; i++) {
        const tableCell = document.createElement('td');

        const maxTemp = weersbericht.daily.temperature_2m_max[i] + '°';
        const minTemp = weersbericht.daily.temperature_2m_min[i] + '°';
        const minTempSpan = document.createElement('span');
        minTempSpan.textContent = minTemp;
        minTempSpan.style.color = 'grey';
        tableCell.appendChild(document.createTextNode(maxTemp + ' '));
        tableCell.appendChild(minTempSpan);

        tabelRowBottom.appendChild(tableCell);
    }

    tabel.appendChild(tabelRowBottom);

    weertabel.appendChild(tabel);
}


window.addEventListener('load', function () {
    var menuTop = document.querySelector('.menu-top');
    var menuToplinks = document.querySelectorAll('.menu-top a');
    var pageContent = document.querySelector('.page-content');

    var video = document.getElementById('video');
    video.playbackRate = 0.5;


    function setPaddingTop() {
        var headerHeight = menuTop.offsetHeight;
        pageContent.style.paddingTop = headerHeight + 'px';
    }

    setPaddingTop();

    var resizeObserver = new ResizeObserver(function () {
        setPaddingTop();
    });

    resizeObserver.observe(menuTop);

    function fontSizeHeader(size) {
        menuToplinks.forEach(element => {
            element.style.fontSize = size;
        });
    }

    // Lees bestemmingen

    async function leesBestemmingen() {
        const response = await fetch("./bestemmingen.json");
        const bestemmingen = await response.json();
        invullenGridItems(bestemmingen);
    }

    function invullenGridItems(bestemmingen) {

        bestemmingen.forEach((item) => {
            const gridItem = document.createElement('div');
            gridItem.classList.add('grid-item');

            const title = document.createElement('h3');
            title.textContent = item.bestemming;

            const image = document.createElement('img');
            image.src = item.afbeelding;
            image.alt = item.bestemming;

            const date = document.createElement('p');
            date.textContent = `${item.startdatum} - ${item.einddatum}`;

            const button = document.createElement('button');
            button.textContent = 'Meer info';

            gridItem.appendChild(title);
            gridItem.appendChild(image);
            gridItem.appendChild(date);
            gridItem.appendChild(button);

            gridContainer.appendChild(gridItem);
        });
    }

    // Scrollen bij menu-top

    window.addEventListener('scroll', function () {
        if (window.scrollY > 1) {
            fontSizeHeader('16px');
            menuTop.style.padding = '6px';
        } else {
            var width = window.innerWidth;
            if (width <= 550) {
                fontSizeHeader('16px');
            }
            else {
                fontSizeHeader('24px');
            }
            menuTop.style.padding = '20px';
        }
        setPaddingTop();
    });

});



