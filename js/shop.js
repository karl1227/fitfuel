function filterCategory(category) {
    let url = new URL(window.location);
    url.searchParams.set('category', category);
    window.location = url; // This reloads the page with the selected category
}
