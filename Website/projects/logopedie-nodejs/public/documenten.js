
document.addEventListener('DOMContentLoaded', () => {
    const filesContainer = document.getElementById('files-grid-container');
  
    // Fetch file titles from the server
    fetch('/file-titles')
      .then(response => response.json())
      .then(fileTitles => {
        // Dynamically insert titles into the HTML
        fileTitles.forEach(title => {
          const gridItem = document.createElement('div');
          gridItem.className = 'grid-item';
          gridItem.textContent = title;
  
          filesContainer.appendChild(gridItem);
        });
      })
      .catch(error => console.error('Error fetching file titles:', error));
  });
  