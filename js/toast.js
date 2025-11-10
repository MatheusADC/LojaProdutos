document.addEventListener("DOMContentLoaded", () => {
    const toastProdutoEditado = document.getElementById("toastEdicao");
    const toastProdutoExcluido = document.getElementById("toastExclusao");

    if (toastProdutoEditado) {
        const toast = new bootstrap.Toast(toastProdutoEditado, {
            delay: 6000
        });
        toast.show();
    } else if (toastProdutoExcluido) {
        const toast = new bootstrap.Toast(toastProdutoExcluido, {
            delay: 6000
        });
        toast.show();
    }
});