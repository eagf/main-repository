"use strict";

// Speelveld

class PlayingField {
    constructor(height = 15, width = 15, treasures = 3, walls = 30) {
        this.height = height;
        this.width = width;
        this.treasures = treasures;
        this.walls = walls;
    }
}

function clearTable() {
    const tableDiv = document.getElementById('table');
    while (tableDiv.hasChildNodes()) {
        tableDiv.removeChild(tableDiv.firstChild);
    }
}

function drawTable(playingField) {
    clearTable();
    const tableDiv = document.getElementById('table');
    const table = document.createElement('table');
    table.classList.add('table');
    for (let i = 0; i < playingField.height; i++) {
        const row = document.createElement('tr');
        for (let j = 0; j < playingField.width; j++) {
            const cell = document.createElement('td');
            cell.classList.add('grass');
            row.appendChild(cell);
        }
        table.appendChild(row);
    }
    tableDiv.appendChild(table);

    // muren

    const coloredCells = new Set();
    while (coloredCells.size < playingField.walls) {
        const randomRow = getRandomNumber(0, (playingField.height - 1));
        const randomCol = getRandomNumber(0, (playingField.width - 1));
        const cell = table.rows[randomRow].cells[randomCol];
        if (!coloredCells.has(cell)) {
            cell.classList.add('wall');
            coloredCells.add(cell);
        }
    }

    // schatten

    while ((coloredCells.size - playingField.walls) < playingField.treasures) {
        const randomRow = getRandomNumber(0, (playingField.height - 1));
        const randomCol = getRandomNumber(0, (playingField.width - 1));
        const cell = table.rows[randomRow].cells[randomCol];
        if (!coloredCells.has(cell)) {
            cell.classList.add('treasure');
            coloredCells.add(cell);
        }
    }

    // speler

    while ((coloredCells.size - playingField.walls - playingField.treasures) < 1) {
        const randomRow = getRandomNumber(0, (playingField.height - 1));
        const randomCol = getRandomNumber(0, (playingField.width - 1));
        const cell = table.rows[randomRow].cells[randomCol];
        if (!coloredCells.has(cell)) {
            cell.classList.add('player');
            coloredCells.add(cell);
        }
    }

    // vijand

    while ((coloredCells.size - playingField.walls - playingField.treasures - 1) < 1) {
        const randomRow = getRandomNumber(0, (playingField.height - 1));
        const randomCol = getRandomNumber(0, (playingField.width - 1));
        const cell = table.rows[randomRow].cells[randomCol];
        if (!coloredCells.has(cell)) {
            cell.classList.add('enemy');
            coloredCells.add(cell);
        }
    }

}

function getRandomNumber(min, max) {
    return Math.floor(Math.random() * (max - min + 1)) + min;
}

// Speler

class Player {
    constructor(lives = 5, treasures = 0) {
        this.lives = lives;
        this.treasures = treasures;
    }
}

function findPlayer() {
    const table = document.querySelector('.table');
    const rows = table.rows;
    let playerCell = null;

    for (let i = 0; i < rows.length; i++) {
        const cells = rows[i].cells;
        for (let j = 0; j < cells.length; j++) {
            if (cells[j].classList.contains('player')) {
                playerCell = cells[j];
                break;
            }
        }
    }
    return playerCell;
}

// vijand

function findEnemy() {
    const table = document.querySelector('.table');
    const rows = table.rows;
    let enemyCell = null;

    for (let i = 0; i < rows.length; i++) {
        const cells = rows[i].cells;
        for (let j = 0; j < cells.length; j++) {
            if (cells[j].classList.contains('enemy')) {
                enemyCell = cells[j];
                break;
            }
        }
    }
    return enemyCell;
}

let playingField = new PlayingField();


document.addEventListener('DOMContentLoaded', function () {

    // VELD TEKENEN BEGIN

    drawTable(playingField);

    // toggle menu-knop
    const menuButton = document.querySelector('.toggle');

    menuButton.addEventListener('click', function () {
        menuButton.classList.toggle('active');
        settings.classList.toggle('active');
    });

    // Startknop

    const startButton = document.getElementById('start');

    const startImg = document.createElement('img');
    startImg.src = './img/start.png';
    startButton.appendChild(startImg);

    // MENU

    const settings = document.querySelector('.settings');
    const fieldset = document.createElement('fieldset');
    const form = document.createElement('form');

    // inputs en submit

    let player = new Player();

    var playerLives = player.lives;

    const heightLabel = document.createElement('label');
    heightLabel.textContent = 'Hoogte:';
    heightLabel.htmlFor = 'height';
    const height = document.createElement('input');
    height.type = 'number';
    height.required = true;
    height.id = 'height';
    height.value = playingField.height;
    const widthLabel = document.createElement('label');
    widthLabel.textContent = 'Breedte:';
    widthLabel.htmlFor = 'width';
    const width = document.createElement('input');
    width.type = 'number';
    width.required = true;
    width.id = 'width';
    width.value = playingField.width;
    const treasuresLabel = document.createElement('label');
    treasuresLabel.textContent = '# schatten:';
    treasuresLabel.htmlFor = 'treasures';
    const treasures = document.createElement('input');
    treasures.type = 'number';
    treasures.required = true;
    treasures.id = 'treasures';
    treasures.value = playingField.treasures;
    const wallsLabel = document.createElement('label');
    wallsLabel.textContent = '# muren:';
    wallsLabel.htmlFor = 'walls';
    const walls = document.createElement('input');
    walls.type = 'number';
    walls.required = true;
    walls.id = 'walls';
    walls.value = playingField.walls;
    const livesLabel = document.createElement('label');
    livesLabel.textContent = '# levens:';
    livesLabel.htmlFor = 'lives';
    const lives = document.createElement('input');
    lives.type = 'number';
    lives.required = true;
    lives.id = 'lives';
    lives.value = player.lives;

    const submitButton = document.createElement('button');
    submitButton.textContent = 'Aanpassen';

    const formRow1 = document.createElement('div');
    formRow1.classList.add('formRow');
    formRow1.appendChild(heightLabel);
    formRow1.appendChild(height);
    form.appendChild(formRow1);

    const formRow2 = document.createElement('div');
    formRow2.classList.add('formRow');
    formRow2.appendChild(widthLabel);
    formRow2.appendChild(width);
    form.appendChild(formRow2);

    const formRow3 = document.createElement('div');
    formRow3.classList.add('formRow');
    formRow3.appendChild(treasuresLabel);
    formRow3.appendChild(treasures);
    form.appendChild(formRow3);

    const formRow4 = document.createElement('div');
    formRow4.classList.add('formRow');
    formRow4.appendChild(wallsLabel);
    formRow4.appendChild(walls);
    form.appendChild(formRow4);

    const formRow5 = document.createElement('div');
    formRow5.classList.add('formRow');
    formRow5.appendChild(livesLabel);
    formRow5.appendChild(lives);
    form.appendChild(formRow5);

    const formRow6 = document.createElement('div');
    formRow6.classList.add('formRow');
    formRow6.appendChild(submitButton);
    form.appendChild(formRow6);

    fieldset.appendChild(form);
    settings.appendChild(fieldset);

    // submit form

    const heightInput = document.getElementById('height');
    const widthInput = document.getElementById('width');
    const treasuresInput = document.getElementById('treasures');
    const wallsInput = document.getElementById('walls');
    const livesInput = document.getElementById('lives');

    form.addEventListener('submit', function (event) {
        event.preventDefault();

        if (heightInput.value < 5 || widthInput.value < 5) {
            alert('De hoogte en breedte mogen elk niet kleiner dan 5 zijn');
            return;
        } else if (wallsInput.value > ((heightInput.value * widthInput.value) - treasuresInput.value - 2)) {
            alert('Er mogen niet zoveel muren zijn.');
            return;
        } else if (wallsInput.value < 0) {
            alert('Het aantal muren kan niet negatief zijn.');
            return;
        } else if (livesInput.value < 1) {
            alert('Het aantal levens mogen niet minder dan 1 zijn.');
            return;
        }

        playingField.height = heightInput.value;
        playingField.width = widthInput.value;
        playingField.treasures = treasuresInput.value;
        playingField.walls = wallsInput.value;
        player.lives = livesInput.value;
        playerLives = livesInput.value;

        drawTable(playingField);
        if (startButton.classList.contains('repeat')) {
            startButton.classList.toggle('repeat');
        }
    });

    // Info fieldset aanmaken - links onderaan

    const info = document.getElementById('info');

    const fieldsetInfo = document.createElement('fieldset');
    const infoTable = document.createElement('table');

    const livesRow = document.createElement('tr');
    const livesTextCell = document.createElement('td');
    livesTextCell.textContent = 'Levens:';
    const livesCell = document.createElement('td');
    livesCell.classList.add('livesInfo');
    livesRow.appendChild(livesTextCell);
    livesRow.appendChild(livesCell);
    infoTable.appendChild(livesRow);

    const treasuresRow = document.createElement('tr');
    const treasuresTextCell = document.createElement('td');
    treasuresTextCell.textContent = 'Schatten:';
    const treasuresCell = document.createElement('td');
    treasuresCell.classList.add('treasuresInfo');
    treasuresRow.appendChild(treasuresTextCell);
    treasuresRow.appendChild(treasuresCell);
    infoTable.appendChild(treasuresRow);

    fieldsetInfo.appendChild(infoTable);
    info.appendChild(fieldsetInfo);


    // START INDUWEN   <--------------------------------------------------


    startButton.addEventListener('click', function () {

        let player = new Player(playerLives, 0);

        menuButton.classList.toggle('hidden');
        settings.classList.toggle('hidden');
        startButton.classList.toggle('hidden');
        startButton.innerHTML = '';

        if (startButton.classList.contains('victory')) {
            startButton.classList.toggle('victory');
        } else if (startButton.classList.contains('defeat')) {
            startButton.classList.toggle('defeat');
        }

        if (startButton.classList.contains('repeat')) {
            drawTable(playingField);
        }

        // info player tonen

        info.classList.toggle('active');

        const livesCell = document.querySelector('.livesInfo');
        const treasuresCell = document.querySelector('.treasuresInfo');

        function updateInfo() {
            livesCell.textContent = player.lives;
            treasuresCell.textContent = player.treasures;
        }

        let updateInfoInterval = setInterval(updateInfo, 100);

        // contact tussen vijand en speler checken

        function checkContactEnemy() {
            const cell = document.querySelector('.enemy.player');
            if (cell && (player.lives > 0)) {
                player.lives -= 1;
                if (player.lives === 0) {
                    startButton.classList.toggle('defeat');
                    endGame();
                }
            }
        };

        let checkContactEnemyInterval = setInterval(checkContactEnemy, 300);

        // contact met treasure

        function checkContactTreasure() {
            const cell = document.querySelector('.player.treasure');
            if (cell) {
                player.treasures += 1;
                cell.classList.remove('treasure');
                if (player.treasures == playingField.treasures) {
                    startButton.classList.toggle('victory');
                    endGame();
                }
            }
        };

        let checkContactTreasureInterval = setInterval(checkContactTreasure, 100);


        // Beweging vijand

        function enemyMovement() {
            const enemyCell = document.querySelector('.enemy');
            const playerCell = document.querySelector('.player');

            const enemyRow = enemyCell.parentElement.rowIndex;
            const enemyCol = enemyCell.cellIndex;

            const playerRow = playerCell.parentElement.rowIndex;
            const playerCol = playerCell.cellIndex;

            if ((enemyRow < playerRow) && !enemyCell.parentElement.nextElementSibling.cells[enemyCol].classList.contains('wall')) {
                enemyCell.parentElement.nextElementSibling.cells[enemyCol].classList.add('enemy');
                enemyCell.classList.remove('enemy');
            } else if ((enemyRow > playerRow) && !enemyCell.parentElement.previousElementSibling.cells[enemyCol].classList.contains('wall')) {
                enemyCell.parentElement.previousElementSibling.cells[enemyCol].classList.add('enemy');
                enemyCell.classList.remove('enemy');
            } else if ((enemyCol < playerCol) && !enemyCell.nextElementSibling.classList.contains('wall')) {
                enemyCell.nextElementSibling.classList.add('enemy');
                enemyCell.classList.remove('enemy');
            } else if ((enemyCol > playerCol) && !enemyCell.previousElementSibling.classList.contains('wall')) {
                enemyCell.previousElementSibling.classList.add('enemy');
                enemyCell.classList.remove('enemy');
            }
        }

        let enemyMovementInterval = setInterval(enemyMovement, 400);

        // pijltjes beweging speler

        function playerMovement(event) {
            const playerCell = findPlayer();

            if (
                (event.key === 'ArrowRight' || event.key === 'd' || event === 'right') &&
                playerCell.nextElementSibling &&
                !playerCell.nextElementSibling.classList.contains('wall')
            ) {
                playerCell.classList.remove('player');
                playerCell.nextElementSibling.classList.add('player');
            } else if (
                (event.key === 'ArrowLeft' || event.key === 'q' || event === 'left') &&
                playerCell.previousElementSibling &&
                !playerCell.previousElementSibling.classList.contains('wall')
            ) {
                playerCell.classList.remove('player');
                playerCell.previousElementSibling.classList.add('player');
            } else if (event.key === 'ArrowDown' || event.key === 's' || event === 'down') {
                const nextRow = playerCell.parentNode.nextElementSibling;
                if (nextRow) {
                    const correspondingCell = nextRow.cells[playerCell.cellIndex];
                    if (!correspondingCell.classList.contains('wall')) {
                        playerCell.classList.remove('player');
                        correspondingCell.classList.add('player');
                    }
                }
            } else if (event.key === 'ArrowUp' || event.key === 'z' || event === 'up') {
                const previousRow = playerCell.parentNode.previousElementSibling;
                if (previousRow) {
                    const correspondingCell = previousRow.cells[playerCell.cellIndex];
                    if (!correspondingCell.classList.contains('wall')) {
                        playerCell.classList.remove('player');
                        correspondingCell.classList.add('player');
                    }
                }
            }
        }

        document.addEventListener('keydown', playerMovement);

        // click beweging speler

        const upButton = document.getElementById('upButton');
        const downButton = document.getElementById('downButton');
        const leftButton = document.getElementById('leftButton');
        const rightButton = document.getElementById('rightButton');

        upButton.classList.toggle('hidden');
        downButton.classList.toggle('hidden');
        leftButton.classList.toggle('hidden');
        rightButton.classList.toggle('hidden');

        const upClickHandler = () => {
            playerMovement('up');
        };
        const downClickHandler = () => {
            playerMovement('down');
        };
        const leftClickHandler = () => {
            playerMovement('left');
        };
        const rightClickHandler = () => {
            playerMovement('right');
        };

        upButton.addEventListener('click', upClickHandler);
        downButton.addEventListener('click', downClickHandler);
        leftButton.addEventListener('click', leftClickHandler);
        rightButton.addEventListener('click', rightClickHandler);

        // EINDE SPEL

        function endGame() {
            startButton.innerHTML = '';
            const startImg = document.createElement('img');
            if (startButton.classList.contains('victory')) {
                startImg.src = './img/victory.png';
                startButton.appendChild(startImg);
            } else if (startButton.classList.contains('defeat')) {
                startImg.src = './img/defeat.png';
                startButton.appendChild(startImg);
            }
            menuButton.classList.toggle('hidden');
            settings.classList.toggle('hidden');
            startButton.classList.toggle('hidden');
            info.classList.toggle('active');
            upButton.classList.toggle('hidden');
            downButton.classList.toggle('hidden');
            leftButton.classList.toggle('hidden');
            rightButton.classList.toggle('hidden');
            document.removeEventListener('keydown', playerMovement);
            upButton.removeEventListener('click', upClickHandler);
            downButton.removeEventListener('click', downClickHandler);
            leftButton.removeEventListener('click', leftClickHandler);
            rightButton.removeEventListener('click', rightClickHandler);
            clearInterval(enemyMovementInterval);
            clearInterval(checkContactEnemyInterval);
            clearInterval(checkContactTreasureInterval);
            clearInterval(updateInfoInterval);
            startButton.classList.add('repeat');
        }

    });

});

