document.addEventListener("DOMContentLoaded", () => {
    fetchProducts();
});
async function fetchProducts() {
    try {
        const response = await fetch('get_products.php');
        const categorias = await response.json();
        displayProducts(categorias);
    } catch (error) {
        console.error("Erro ao buscar produtos:", error);
    }
}

function displayProducts(categorias) {
    const container = document.getElementById('productsContainer');
    container.innerHTML = ''; 
    
    for (const categoria in categorias) {
        const categorySection = document.createElement('div');
        categorySection.className = 'category-section';
        
        const categoryTitle = document.createElement('h2');
        categoryTitle.textContent = categoria.toUpperCase();
        categorySection.appendChild(categoryTitle);

        const productsGrid = document.createElement('div');
        productsGrid.className = 'products-grid';

        categorias[categoria].forEach(produto => {
            const productCard = document.createElement('div');
            productCard.className = 'product-card';

            productCard.innerHTML = `
                <img src="${produto.imagem}" alt="${produto.nome}" class="product-image">
                <h3>${produto.nome}</h3>
                <p>Preço: R$ ${parseFloat(produto.preco).toFixed(2)}</p>
                <p>${produto.descricao}</p>
            `;

            productsGrid.appendChild(productCard);
        });

        categorySection.appendChild(productsGrid);
        container.appendChild(categorySection);
    }
}

fetchProducts();
