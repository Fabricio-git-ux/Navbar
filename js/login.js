let script = document.createElement('script');
script.src = "../js/script.js";
document.head.appendChild(script);

fetch("login.php",{
    method: "POST",
    headers: {
        "Content-Type" : "application/json",
    },
    body: JSON.stringify({
        token: Response.credential,
    }),
});
