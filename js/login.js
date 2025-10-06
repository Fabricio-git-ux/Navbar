function handleCredentialResponse(response) {
    fetch("../pages/auth_google.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ credential: response.credential })
    })
    .then(res => res.json())
    .then(data => {
        if(data.sucesso){
            window.location.href = "../index.php"; // redireciona se sucesso
        } else {
            alert("Erro no login com Google: " + data.mensagem);
        }
    })
    .catch(err => {
        console.error(err);
        alert("Erro na comunicação com o servidor");
    });
}
