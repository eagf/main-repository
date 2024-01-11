document.addEventListener('DOMContentLoaded', () => {
  const filesContainer = document.getElementById('files-grid-container');

  // Fetch file titles from the server
  var responseClone;

  fetch('/file-titles', {
    headers: {
      'Accept': 'application/json',
    },
  })
    .then(function (response) {
      responseClone = response.clone();
      return response.json();
    })
    .then(fileTitles => {
      // Dynamically insert titles into the HTML
      fileTitles.forEach(title => {
        const gridItem = document.createElement('div');
        gridItem.className = 'grid-item';
        gridItem.textContent = title;

        filesContainer.appendChild(gridItem);
      });
    }, function (rejectionReason) {
      console.log('Error parsing JSON from response:', rejectionReason, responseClone);
      responseClone.text()
        .then(function (bodyText) {
          console.log('Received the following instead of valid JSON:', bodyText);
        });
    })
});
