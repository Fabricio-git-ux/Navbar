// Função chamada automaticamente pelo Google Identity Services
// quando o usuário tenta logar com a conta Google
function handleCredentialResponse(response) {
    
    // Envia a credencial recebida do Google para o servidor via POST
    fetch("../pages/auth_google.php", {
        method: "POST", // método HTTP usado
        headers: { "Content-Type": "application/json" }, // informa que o corpo da requisição é JSON
        body: JSON.stringify({ credential: response.credential }) // converte o objeto JS em JSON
    })
    .then(res => res.json()) // transforma a resposta do servidor em objeto JS
    .then(data => {
        // Se o servidor retornou sucesso
        if(data.sucesso){
            // Redireciona o usuário para a página inicial
            window.location.href = "../index.php";
        } else {
            // Mostra um alerta caso o login falhe
            alert("Erro no login com Google: " + data.mensagem);
        }
    })
    .catch(err => {
        // Captura erros de rede ou falhas na requisição
        console.error(err); // mostra detalhes no console
        alert("Erro na comunicação com o servidor"); // alerta o usuário
    });
}
