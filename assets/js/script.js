// menu mobile

const botaoMenu = document.getElementById("botao-menu");
const menu = document.getElementById("menu");

if (botaoMenu && menu) {
  botaoMenu.addEventListener("click", function () {
    menu.classList.toggle("active");
  });
}

// ---- login / cadastro ----
// por enquanto usa localStorage, depois troca pro banco de dados

function pegarUsuarios() {
  var salvo = localStorage.getItem("buynow-usuarios");
  if (salvo) {
    return JSON.parse(salvo);
  }
  return [];
}

function salvarUsuarios(lista) {
  localStorage.setItem("buynow-usuarios", JSON.stringify(lista));
}

function estaLogado() {
  if (sessionStorage.getItem("buynow-logado") === "true") {
    return true;
  }
  return false;
}

function pegarUsuarioLogado() {
  return sessionStorage.getItem("buynow-usuario-nome") || "";
}

function fazerLogin(nome, email) {
  sessionStorage.setItem("buynow-logado", "true");
  sessionStorage.setItem("buynow-usuario-nome", nome);
  sessionStorage.setItem("buynow-usuario-email", email);
}

function sair() {
  sessionStorage.removeItem("buynow-logado");
  sessionStorage.removeItem("buynow-usuario-nome");
  sessionStorage.removeItem("buynow-usuario-email");

  if (window.location.pathname.includes("/pages/")) {
    window.location.href = "../index.html";
  } else {
    window.location.href = "index.html";
  }
}

function urlLogin() {
  if (window.location.pathname.includes("/pages/")) {
    return "login.html";
  }
  return "./pages/login.html";
}

function irParaLogin() {
  sessionStorage.setItem("buynow-voltar", window.location.href);
  window.location.href = urlLogin();
}

// mostra carrinho e nome so se tiver logado
function atualizarNavbar() {
  var navAuth = document.getElementById("nav-auth");
  var navLogado = document.getElementById("nav-logado");
  var nomeUser = document.getElementById("nome-usuario");
  var logado = estaLogado();

  if (navAuth) {
    if (logado) {
      navAuth.hidden = true;
    } else {
      navAuth.hidden = false;
    }
  }

  if (navLogado) {
    if (logado) {
      navLogado.hidden = false;
    } else {
      navLogado.hidden = true;
    }
  }

  if (nomeUser && logado) {
    nomeUser.textContent = pegarUsuarioLogado();
  }
}

atualizarNavbar();

var btnSair = document.getElementById("btn-sair");
if (btnSair) {
  btnSair.addEventListener("click", sair);
}

// ---- carrinho ----

var carrinho = 0;
var contadorCarrinho = document.getElementById("contador-carrinho");

if (sessionStorage.getItem("buynow-carrinho")) {
  carrinho = Number(sessionStorage.getItem("buynow-carrinho"));
}

if (contadorCarrinho) {
  contadorCarrinho.textContent = carrinho;
}

var botoesCarrinho = document.querySelectorAll(".add-cart");

for (var i = 0; i < botoesCarrinho.length; i++) {
  botoesCarrinho[i].addEventListener("click", function () {
    if (!estaLogado()) {
      alert("Faça login ou crie uma conta pra comprar.");
      irParaLogin();
      return;
    }

    carrinho = carrinho + 1;
    sessionStorage.setItem("buynow-carrinho", carrinho);

    if (contadorCarrinho) {
      contadorCarrinho.textContent = carrinho;
    }
  });
}

// ---- busca produtos ----

var pesquisaProdutos = document.getElementById("pesquisa-produtos");
var gridProdutos = document.getElementById("grid-produtos");
var emptyProdutos = document.getElementById("empty-produtos");

if (pesquisaProdutos && gridProdutos) {
  pesquisaProdutos.addEventListener("input", function () {
    var valor = pesquisaProdutos.value.toLowerCase();
    var achou = false;
    var itens = gridProdutos.querySelectorAll(".produto-item");

    for (var j = 0; j < itens.length; j++) {
      var nome = itens[j].querySelector("h3").textContent.toLowerCase();

      if (nome.includes(valor)) {
        itens[j].style.display = "block";
        achou = true;
      } else {
        itens[j].style.display = "none";
      }
    }

    if (emptyProdutos) {
      if (achou || valor === "") {
        emptyProdutos.hidden = true;
      } else {
        emptyProdutos.hidden = false;
      }
    }
  });
}

// ---- form cadastro ----

var formCadastro = document.getElementById("form-cadastro");

if (formCadastro) {
  formCadastro.addEventListener("submit", function (e) {
    e.preventDefault();

    var nome = document.getElementById("cad-nome").value.trim();
    var email = document.getElementById("cad-email").value.trim();
    var senha = document.getElementById("cad-senha").value.trim();
    var confirma = document.getElementById("cad-confirma").value.trim();

    document.getElementById("erro-cad-nome").textContent = "";
    document.getElementById("erro-cad-email").textContent = "";
    document.getElementById("erro-cad-senha").textContent = "";
    document.getElementById("erro-cad-confirma").textContent = "";

    var temErro = false;

    if (nome.length < 2) {
      document.getElementById("erro-cad-nome").textContent = "Coloca seu nome.";
      temErro = true;
    }

    if (!email.includes("@")) {
      document.getElementById("erro-cad-email").textContent = "E-mail inválido.";
      temErro = true;
    }

    if (senha.length < 4) {
      document.getElementById("erro-cad-senha").textContent = "Senha precisa ter 4+ caracteres.";
      temErro = true;
    }

    if (senha !== confirma) {
      document.getElementById("erro-cad-confirma").textContent = "As senhas não batem.";
      temErro = true;
    }

    if (temErro) return;

    var usuarios = pegarUsuarios();

    for (var k = 0; k < usuarios.length; k++) {
      if (usuarios[k].email === email) {
        document.getElementById("erro-cad-email").textContent = "Esse e-mail já tá cadastrado.";
        return;
      }
    }

    // depois no banco a senha vai criptografada
    usuarios.push({
      nome: nome,
      email: email,
      senha: senha
    });

    salvarUsuarios(usuarios);
    alert("Conta criada! Agora é só entrar.");
    window.location.href = "login.html";
  });
}

// ---- form login ----

var formLogin = document.getElementById("form-login");

if (formLogin) {
  if (estaLogado()) {
    var jaLogadoVolta = sessionStorage.getItem("buynow-voltar");
    if (jaLogadoVolta) {
      window.location.href = jaLogadoVolta;
    } else {
      window.location.href = "../index.html";
    }
  }

  formLogin.addEventListener("submit", function (e) {
    e.preventDefault();

    var email = document.getElementById("login-email").value.trim();
    var senha = document.getElementById("login-senha").value.trim();

    document.getElementById("erro-login-email").textContent = "";
    document.getElementById("erro-login-senha").textContent = "";

    if (!email.includes("@")) {
      document.getElementById("erro-login-email").textContent = "E-mail inválido.";
      return;
    }

    if (senha.length < 4) {
      document.getElementById("erro-login-senha").textContent = "Senha errada ou curta demais.";
      return;
    }

    var usuarios = pegarUsuarios();
    var achouUser = null;

    for (var m = 0; m < usuarios.length; m++) {
      if (usuarios[m].email === email && usuarios[m].senha === senha) {
        achouUser = usuarios[m];
        break;
      }
    }

    if (!achouUser) {
      document.getElementById("erro-login-senha").textContent = "E-mail ou senha não encontrados.";
      return;
    }

    fazerLogin(achouUser.nome, achouUser.email);

    var voltar = sessionStorage.getItem("buynow-voltar");
    sessionStorage.removeItem("buynow-voltar");

    if (voltar) {
      window.location.href = voltar;
    } else {
      window.location.href = "../index.html";
    }
  });
}

// ---- form contato ----

var formContato = document.getElementById("form-contato");
var formSuccess = document.getElementById("form-success");

if (formContato) {
  formContato.addEventListener("submit", function (e) {
    e.preventDefault();

    var nome = formContato.nome.value.trim();
    var email = formContato.email.value.trim();
    var mensagem = formContato.mensagem.value.trim();
    var ok = true;

    document.querySelector("[data-error='nome']").textContent = "";
    document.querySelector("[data-error='email']").textContent = "";
    document.querySelector("[data-error='mensagem']").textContent = "";

    if (nome.length < 2) {
      document.querySelector("[data-error='nome']").textContent = "Coloca seu nome.";
      ok = false;
    }

    if (!email.includes("@")) {
      document.querySelector("[data-error='email']").textContent = "E-mail inválido.";
      ok = false;
    }

    if (mensagem.length < 5) {
      document.querySelector("[data-error='mensagem']").textContent = "Escreve uma mensagem.";
      ok = false;
    }

    if (!ok) return;

    formContato.reset();
    formSuccess.hidden = false;
  });
}
