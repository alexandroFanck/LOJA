document.addEventListener("DOMContentLoaded", () => {
    const iframe = document.getElementById("content-frame");
    
    const contentMap = {
        login: "main/login.html",
        carrinho: "main/carrinho.html"
    };

    document.querySelectorAll("nav button").forEach(button => {
        button.addEventListener("click", () => {
            const target = button.getAttribute("data-target");
            if (contentMap[target]) {
                iframe.src = contentMap[target];
            }
        });
    });
});
