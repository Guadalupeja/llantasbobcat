document.addEventListener('DOMContentLoaded', () => {
    const button = document.querySelector('.js-mobile-menu-button');
    const menu = document.querySelector('.js-mobile-menu');

    if (button && menu) {
        button.addEventListener('click', () => {
            menu.classList.toggle('hidden');
        });
    }

    const filters = {
        model: document.querySelector('#filter-model'),
        type: document.querySelector('#filter-type'),
        size: document.querySelector('#filter-size'),
        search: document.querySelector('#filter-search'),
    };

    const clearButton = document.querySelector('#clear-bobcat-filters');
    const cards = document.querySelectorAll('.js-bobcat-card');
    const noResults = document.querySelector('#bobcat-no-results');
    const resultsCount = document.querySelector('#bobcat-results-count');

    const normalize = (value) => {
        return (value || '')
            .toString()
            .toLowerCase()
            .normalize('NFD')
            .replace(/[\u0300-\u036f]/g, '');
    };

    const applyBobcatFilters = () => {
        const selectedModel = normalize(filters.model?.value);
        const selectedType = normalize(filters.type?.value);
        const selectedSize = normalize(filters.size?.value);
        const search = normalize(filters.search?.value);

        let visibleCount = 0;

        cards.forEach((card) => {
            const cardModel = normalize(card.dataset.model);
            const cardTypes = normalize(card.dataset.types);
            const cardSizes = normalize(card.dataset.sizes);
            const cardSearch = normalize(card.dataset.search);

            const matchesModel = !selectedModel || cardModel === selectedModel;
            const matchesType = !selectedType || cardTypes.includes(selectedType);
            const matchesSize = !selectedSize || cardSizes.includes(selectedSize);
            const matchesSearch = !search || cardSearch.includes(search);

            const shouldShow = matchesModel && matchesType && matchesSize && matchesSearch;

            card.classList.toggle('hidden', !shouldShow);

            if (shouldShow) {
                visibleCount++;
            }
        });

        if (noResults) {
            noResults.classList.toggle('hidden', visibleCount > 0);
        }

        if (resultsCount) {
            resultsCount.textContent = visibleCount === 1
                ? 'Mostrando 1 modelo Bobcat'
                : `Mostrando ${visibleCount} modelos Bobcat`;
        }
    };

    Object.values(filters).forEach((filter) => {
        if (!filter) return;
        filter.addEventListener(filter.tagName === 'INPUT' ? 'input' : 'change', applyBobcatFilters);
    });

    if (clearButton) {
        clearButton.addEventListener('click', () => {
            Object.values(filters).forEach((filter) => {
                if (filter) filter.value = '';
            });
            applyBobcatFilters();
        });
    }

    applyBobcatFilters();
});
