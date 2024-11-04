document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById('addProductForm');
    const resultMessage = document.getElementById('resultMessage');

    form.addEventListener('submit', async (event) => {
        event.preventDefault(); // Impede o redirecionamento da página

        // Cria um FormData com os dados do formulário
        const formData = new FormData(form);

        try {
            const response = await fetch('main/add_product.php', {
                method: 'POST',
                body: formData
            });

            const result = await response.json(); // Assume que o PHP retorna um JSON
            if (result.success) {
                resultMessage.textContent = 'Produto adicionado com sucesso!';
                resultMessage.style.color = 'green';
                form.reset(); // Limpa o formulário após o sucesso
            } else {
                resultMessage.textContent = 'Erro ao adicionar produto: ' + result.error;
                resultMessage.style.color = 'red';
            }
        } catch (error) {
            resultMessage.textContent = 'Erro ao enviar o produto: ' + error.message;
            resultMessage.style.color = 'red';
        }
    });
});
