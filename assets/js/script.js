document.addEventListener("DOMContentLoaded", () => {
  initMenuMobile();
  initCarrinho();
  initBuscaProdutos();
  initFormContato();
});

function initMenuMobile() {
  const botaoMenu = document.getElementById("botao-menu");
  const menu = document.getElementById("menu");
  if (!botaoMenu || !menu) return;

  botaoMenu.addEventListener("click", () => menu.classList.toggle("active"));
}

const CARRINHO_KEY = "buynow-carrinho-itens";

function usuarioEstaLogado() {
  return Boolean(document.getElementById("usuario-logado"));
}

function getLoginPath() {
  return window.location.pathname.includes("/pages/")
    ? "login.php"
    : "./pages/login.php";
}

function getCarrinho() {
  try {
    const dados = sessionStorage.getItem(CARRINHO_KEY);
    return dados ? JSON.parse(dados) : [];
  } catch {
    return [];
  }
}

function saveCarrinho(itens) {
  sessionStorage.setItem(CARRINHO_KEY, JSON.stringify(itens));
}

function parsePreco(texto) {
  if (!texto) return 0;
  return Number(texto.replace(/[^\d,]/g, "").replace(",", ".")) || 0;
}

function formatarPreco(valor) {
  return valor.toLocaleString("pt-BR", { style: "currency", currency: "BRL" });
}

function slugProduto(nome) {
  return nome.toLowerCase().replace(/[^a-z0-9]+/g, "-").replace(/(^-|-$)/g, "");
}

function normalizarImagem(src) {
  if (!src) return "";

  let caminho = src;
  while (caminho.startsWith("../") || caminho.startsWith("./")) {
    caminho = caminho.replace(/^\.\.?\//, "");
  }

  const partes = window.location.pathname.split("/").filter(Boolean);
  const indicePages = partes.indexOf("pages");
  const base = indicePages > -1
    ? "/" + partes.slice(0, indicePages).join("/") + "/"
    : window.location.pathname.replace(/\/[^/]*$/, "/");

  return base + caminho;
}

function extrairProduto(card) {
  const nome = card.querySelector("h3")?.textContent.trim() || "Produto";
  const preco = card.querySelector(".preco")?.textContent.trim() || "R$ 0,00";
  const imagem = normalizarImagem(card.querySelector("img")?.getAttribute("src") || "");

  return {
    id: slugProduto(nome),
    nome,
    preco,
    precoNum: parsePreco(preco),
    imagem
  };
}

function atualizarContadorCarrinho() {
  const contador = document.getElementById("contador-carrinho");
  if (!contador) return;

  const total = getCarrinho().reduce((soma, item) => soma + item.qtd, 0);
  contador.textContent = total;
  contador.classList.toggle("vazio", total === 0);
}

function renderizarCarrinho() {
  const lista = document.getElementById("carrinho-itens");
  const totalEl = document.getElementById("carrinho-total");
  if (!lista) return;

  const itens = getCarrinho();

  if (itens.length === 0) {
    lista.innerHTML = '<p class="carrinho-vazio">Seu carrinho está vazio.</p>';
    if (totalEl) totalEl.textContent = "R$ 0,00";
    return;
  }

  let total = 0;

  lista.innerHTML = itens.map((item) => {
    total += item.precoNum * item.qtd;
    return `
      <div class="carrinho-item" data-id="${item.id}">
        <img src="${item.imagem}" alt="${item.nome}">
        <div class="carrinho-item-info">
          <h4>${item.nome}</h4>
          <p class="carrinho-item-preco">${item.preco}</p>
          <div class="carrinho-item-qtd">
            <button type="button" class="carrinho-qtd-btn" data-acao="menos" data-id="${item.id}">−</button>
            <span>${item.qtd}</span>
            <button type="button" class="carrinho-qtd-btn" data-acao="mais" data-id="${item.id}">+</button>
          </div>
        </div>
        <button type="button" class="carrinho-remover" data-id="${item.id}" aria-label="Remover item">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 6h18M8 6V4h8v2M19 6l-1 14H6L5 6"/></svg>
        </button>
      </div>
    `;
  }).join("");

  if (totalEl) totalEl.textContent = formatarPreco(total);
}

function adicionarAoCarrinho(produto) {
  const itens = getCarrinho();
  const existente = itens.find((item) => item.id === produto.id);

  if (existente) {
    existente.qtd += 1;
  } else {
    itens.push({ ...produto, qtd: 1 });
  }

  saveCarrinho(itens);
  atualizarContadorCarrinho();
  renderizarCarrinho();
}

function alterarQuantidade(id, delta) {
  let itens = getCarrinho();
  const item = itens.find((i) => i.id === id);
  if (!item) return;

  item.qtd += delta;
  if (item.qtd <= 0) {
    itens = itens.filter((i) => i.id !== id);
  }

  saveCarrinho(itens);
  atualizarContadorCarrinho();
  renderizarCarrinho();
}

function removerDoCarrinho(id) {
  saveCarrinho(getCarrinho().filter((item) => item.id !== id));
  atualizarContadorCarrinho();
  renderizarCarrinho();
}

function abrirCarrinho() {
  renderizarCarrinho();
  document.body.classList.add("carrinho-aberto");
}

function fecharCarrinho() {
  document.body.classList.remove("carrinho-aberto");
}

function initCarrinho() {
  const overlay = document.getElementById("carrinho-overlay");
  const btnFechar = document.getElementById("carrinho-fechar");
  const lista = document.getElementById("carrinho-itens");

  document.addEventListener("click", (e) => {
    if (e.target.closest("#btn-carrinho")) {
      e.preventDefault();
      abrirCarrinho();
      return;
    }

    const btnAdd = e.target.closest(".add-cart");
    if (!btnAdd) return;

    e.preventDefault();

    if (!usuarioEstaLogado()) {
      window.location.href = getLoginPath();
      return;
    }

    const card = btnAdd.closest(".produto-item, .card-oferta");
    if (!card) return;

    adicionarAoCarrinho(extrairProduto(card));
    abrirCarrinho();
  });

  overlay?.addEventListener("click", fecharCarrinho);
  btnFechar?.addEventListener("click", fecharCarrinho);

  lista?.addEventListener("click", (e) => {
    const btnQtd = e.target.closest(".carrinho-qtd-btn");
    if (btnQtd) {
      const delta = btnQtd.dataset.acao === "mais" ? 1 : -1;
      alterarQuantidade(btnQtd.dataset.id, delta);
      return;
    }

    const btnRemover = e.target.closest(".carrinho-remover");
    if (btnRemover) {
      removerDoCarrinho(btnRemover.dataset.id);
    }
  });

  document.addEventListener("keydown", (e) => {
    if (e.key === "Escape") fecharCarrinho();
  });

  atualizarContadorCarrinho();
}

function initBuscaProdutos() {
  const pesquisa = document.getElementById("pesquisa-produtos");
  const grid = document.getElementById("grid-produtos");
  const vazio = document.getElementById("empty-produtos");
  if (!pesquisa || !grid) return;

  pesquisa.addEventListener("input", () => {
    const termo = pesquisa.value.toLowerCase();
    let achou = false;

    grid.querySelectorAll(".produto-item").forEach((item) => {
      const nome = item.querySelector("h3")?.textContent.toLowerCase() || "";
      const visivel = nome.includes(termo);
      item.style.display = visivel ? "block" : "none";
      if (visivel) achou = true;
    });

    if (vazio) {
      vazio.hidden = achou || termo === "";
    }
  });
}

function initFormContato() {
  const form = document.getElementById("form-contato");
  const sucesso = document.getElementById("form-success");
  if (!form) return;

  const erros = {
    nome: document.querySelector("[data-error='nome']"),
    email: document.querySelector("[data-error='email']"),
    mensagem: document.querySelector("[data-error='mensagem']")
  };

  form.addEventListener("submit", (e) => {
    e.preventDefault();

    const nome = form.nome.value.trim();
    const email = form.email.value.trim();
    const mensagem = form.mensagem.value.trim();
    let valido = true;

    erros.nome.textContent = "";
    erros.email.textContent = "";
    erros.mensagem.textContent = "";

    if (nome.length < 2) {
      erros.nome.textContent = "Coloca seu nome.";
      valido = false;
    }

    if (!email.includes("@")) {
      erros.email.textContent = "E-mail inválido.";
      valido = false;
    }

    if (mensagem.length < 5) {
      erros.mensagem.textContent = "Escreve uma mensagem.";
      valido = false;
    }

    if (!valido) return;

    form.reset();
    if (sucesso) sucesso.hidden = false;
  });
}
