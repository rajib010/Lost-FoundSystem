function createPagination(totalPages, currentPage, paginationContainer, loadFunction, filter = null) {

    paginationContainer.innerHTML = '';
    if (totalPages <= 1) return;

    // Prev Button
    if (currentPage > 1) {
        const prevButton = document.createElement('a');
        prevButton.href = '#';
        prevButton.textContent = 'Prev';
        prevButton.onclick = (e) => {
            e.preventDefault();
            if (!filter) loadFunction(currentPage - 1);
            if (filter) loadFunction(filter, currentPage - 1)

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
            if (!filter) loadFunction(i);
            if (filter) loadFunction(filter, i)
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
            if (!filter) loadFunction(currentPage + 1);
            if (filter) loadFunction(filter, currentPage + 1)
        };
        paginationContainer.appendChild(nextButton);
    }
}
