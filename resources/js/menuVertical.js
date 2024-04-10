document.addEventListener('DOMContentLoaded', function () {
    const offcanvasElementList = document.querySelectorAll('.offcanvas');
    const offcanvasList = [...offcanvasElementList].map(offcanvasEl => {
        const offcanvas = new bootstrap.Offcanvas(offcanvasEl);

        // Define o tamanho inicial como 50px
        offcanvasEl.style.width = '50px';

        // Seletor do ícone bi-list
        const icon = offcanvasEl.querySelector('.bi-list');
        // Adiciona um evento de clique ao ícone bi-list
        icon.addEventListener('click', function (event) {
            // Impede a propagação do evento para evitar que o offcanvas seja aberto
            event.stopPropagation();

            // Ajusta o tamanho do offcanvas para 250px
            offcanvasEl.style.width = '250px';

            // Remove o ícone 'bi-list' e insere 'bi-home'
            icon.classList.remove('bi-list');
            icon.classList.add('bi-house-fill');

            // Mostra o botão de fechar
            const closeButton = offcanvasEl.querySelector('.btn-close');
            closeButton.style.display = 'block';

            // Ajusta o alinhamento dos itens na offcanvas-header para 'start'
            const header = offcanvasEl.querySelector('.offcanvas-header');
            header.classList.add('d-flex', 'align-items-center');
            header.classList.remove('d-flex', 'flex-column');

            // Exibe os elementos com a classe span-labels
            const spanLabels = offcanvasEl.querySelectorAll('.span-labels');
            spanLabels.forEach(label => {
                label.style.display = 'block';
                label.style.padding = '10px';
            });
        });

        return offcanvas;
    });
});