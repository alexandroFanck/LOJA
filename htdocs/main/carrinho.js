document.addEventListener("DOMContentLoaded", async () => {
    const response = await fetch("carrinho.php");
    const content = await response.text();
    document.getElementById("carrinho-content").innerHTML = content;
});
