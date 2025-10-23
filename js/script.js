// Guarda todos os elementos que possuem a classe 'item-menu' (cada item do menu)
var menuItem = document.querySelectorAll('.item-menu')

// Função para selecionar um item do menu
function selecLink() {
    // Remove a classe 'ativo' de todos os itens do menu
    menuItem.forEach((item) =>
        item.classList.remove('ativo')
    )
    // Adiciona a classe 'ativo' apenas ao item clicado (this se refere ao elemento clicado)
    this.classList.add('ativo')
}

// Adiciona o evento de clique a cada item do menu
menuItem.forEach((item) =>
    item.addEventListener('click', selecLink)
)

// Guardando o botão que expande/contrai o menu
var btnExp = document.querySelector('#btn-exp')

// Guardando o menu lateral
var menuSide = document.querySelector('.menu-lateral')

// Evento de clique no botão de expandir
btnExp.addEventListener('click', function() {
    // Alterna a classe 'expandir' no menu lateral
    // Se o menu estiver expandido, remove; se estiver contraído, adiciona
    menuSide.classList.toggle('expandir')
})
