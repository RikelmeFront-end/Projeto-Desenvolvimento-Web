// ============================
// MENU MOBILE
// ============================

const botaoMenu = document.getElementById("botao-menu");
const menu = document.getElementById("menu");

if (botaoMenu && menu) {
  botaoMenu.addEventListener("click", function () {
    menu.classList.toggle("active");
  });
}

// ============================
// CARRINHO (AINDA FRONT-END)
// ============================

let carrinho = Number(sessionStorage.getItem("buynow-carrinho")) || 0;
const contadorCarrinho = document.getElementById("contador-carrinho");

if (contadorCarrinho) {
  contadorCarrinho.textContent = carrinho;
}

const botoesCarrinho = document.querySelectorAll(".add-cart");

botoesCarrinho.forEach(btn => {
  btn.addEventListener("click", () => {

    // ⚠️ agora só redireciona se não estiver logado via PHP
    // (verificado pela ausência do nome no HTML)

    const usuario = document.querySelector(".nome-user");

    if (!usuario) {
      const loginPath = window.location.pathname.includes("/pages/")
        ? "login.html"
        : "./pages/login.html";
      window.location.href = loginPath;
      return;
    }

    carrinho++;
    sessionStorage.setItem("buynow-carrinho", carrinho);

    if (contadorCarrinho) {
      contadorCarrinho.textContent = carrinho;
    }
  });
});

// ============================
// BUSCA PRODUTOS
// ============================

const pesquisaProdutos = document.getElementById("pesquisa-produtos");
const gridProdutos = document.getElementById("grid-produtos");
const emptyProdutos = document.getElementById("empty-produtos");

if (pesquisaProdutos && gridProdutos) {
  pesquisaProdutos.addEventListener("input", function () {
    const valor = pesquisaProdutos.value.toLowerCase();
    let achou = false;

    const itens = gridProdutos.querySelectorAll(".produto-item");

    itens.forEach(item => {
      const nome = item.querySelector("h3").textContent.toLowerCase();

      if (nome.includes(valor)) {
        item.style.display = "block";
        achou = true;
      } else {
        item.style.display = "none";
      }
    });

    if (emptyProdutos) {
      emptyProdutos.hidden = achou || valor === "";
    }
  });
}

// ============================
// FORM LOGIN (IMPORTANTE)
// ============================

const formLogin = document.getElementById("form-login");

if (formLogin) {
  formLogin.addEventListener("submit", function () {
    // 🚀 NÃO FAZ NADA AQUI
    // deixa o PHP (login.php) cuidar
  });
}

// ============================
// FORM CADASTRO (IMPORTANTE)
// ============================

const formCadastro = document.getElementById("form-cadastro");

if (formCadastro) {
  formCadastro.addEventListener("submit", function () {
    // 🚀 NÃO BLOQUEIA
    // deixa o PHP (cadastro.php) salvar no banco
  });
}

// ============================
// CONTATO FORM
// ============================

const formContato = document.getElementById("form-contato");
const formSuccess = document.getElementById("form-success");

if (formContato) {
  formContato.addEventListener("submit", function (e) {
    e.preventDefault();

    const nome = formContato.nome.value.trim();
    const email = formContato.email.value.trim();
    const mensagem = formContato.mensagem.value.trim();

    let ok = true;

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