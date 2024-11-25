// pagination.js
function createPagination(totalPages, currentPage, paginationContainer, loadFunction, filter = '') {
    paginationContainer.innerHTML = '';

    // Prev Button
    if (currentPage > 1) {
        const prevButton = document.createElement('a');
        prevButton.href = '#';
        prevButton.textContent = 'Prev';
        prevButton.onclick = (e) => {
            e.preventDefault();
            loadFunction(filter, currentPage - 1);
        };
        paginationContainer.appendChild(prevButton);
    }

    // Page Number Links
    for (let i = 1; i <= totalPages; i++) {
        const pageLink = document.createElement('a');
        pageLink.href = '#';
        pageLink.textContent = i;
        if (i === currentPage) {
            pageLink.classList.add('active');
        }
        pageLink.onclick = (e) => {
            e.preventDefault();
            loadFunction(filter, i);
        };
        paginationContainer.appendChild(pageLink);
    }

    // Next Button
    if (currentPage < totalPages) {
        const nextButton = document.createElement('a');
        nextButton.href = '#';
        nextButton.textContent = 'Next';
        nextButton.onclick = (e) => {
            e.preventDefault();
            loadFunction(filter, currentPage + 1);
        };
        paginationContainer.appendChild(nextButton);
    }
}
