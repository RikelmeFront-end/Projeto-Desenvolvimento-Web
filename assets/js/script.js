document.addEventListener("DOMContentLoaded", function () {
  initMenuMobile();
  initCarrinho();
  initBuscaProdutos();
  initFormContato();
});

// ============================
// MENU MOBILE
// ============================

function initMenuMobile() {
  const botaoMenu = document.getElementById("botao-menu");
  const menu = document.getElementById("menu");

  if (!botaoMenu || !menu) return;

  botaoMenu.addEventListener("click", function () {
    menu.classList.toggle("active");
  });
}

// ============================
// CARRINHO
// ============================

const CARRINHO_KEY = "buynow-carrinho-itens";

function usuarioEstaLogado() {
  return document.getElementById("usuario-logado") !== null;
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
  } catch (error) {
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
  const nomeEl = card.querySelector("h3");
  const precoEl = card.querySelector(".preco");
  const imgEl = card.querySelector("img");

  const nome = nomeEl ? nomeEl.textContent.trim() : "Produto";
  const precoTexto = precoEl ? precoEl.textContent.trim() : "R$ 0,00";
  const imagem = imgEl ? normalizarImagem(imgEl.getAttribute("src") || "") : "";

  return {
    id: slugProduto(nome),
    nome: nome,
    preco: precoTexto,
    precoNum: parsePreco(precoTexto),
    imagem: imagem
  };
}

function atualizarContadorCarrinho() {
  const contador = document.getElementById("contador-carrinho");
  if (!contador) return;

  const total = getCarrinho().reduce(function (soma, item) {
    return soma + item.qtd;
  }, 0);

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
  let html = "";

  itens.forEach(function (item) {
    total += item.precoNum * item.qtd;
    html += '<div class="carrinho-item" data-id="' + item.id + '">';
    html += '<img src="' + item.imagem + '" alt="' + item.nome + '">';
    html += '<div class="carrinho-item-info">';
    html += "<h4>" + item.nome + "</h4>";
    html += '<p class="carrinho-item-preco">' + item.preco + "</p>";
    html += '<div class="carrinho-item-qtd">';
    html += '<button type="button" class="carrinho-qtd-btn" data-acao="menos" data-id="' + item.id + '">−</button>';
    html += "<span>" + item.qtd + "</span>";
    html += '<button type="button" class="carrinho-qtd-btn" data-acao="mais" data-id="' + item.id + '">+</button>';
    html += "</div></div>";
    html += '<button type="button" class="carrinho-remover" data-id="' + item.id + '" aria-label="Remover item">';
    html += '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 6h18M8 6V4h8v2M19 6l-1 14H6L5 6"/></svg>';
    html += "</button></div>";
  });

  lista.innerHTML = html;
  if (totalEl) totalEl.textContent = formatarPreco(total);
}

function adicionarAoCarrinho(produto) {
  const itens = getCarrinho();
  const existente = itens.find(function (item) {
    return item.id === produto.id;
  });

  if (existente) {
    existente.qtd += 1;
  } else {
    itens.push(Object.assign({}, produto, { qtd: 1 }));
  }

  saveCarrinho(itens);
  atualizarContadorCarrinho();
  renderizarCarrinho();
}

function alterarQuantidade(id, delta) {
  let itens = getCarrinho();
  const item = itens.find(function (i) {
    return i.id === id;
  });
  if (!item) return;

  item.qtd += delta;

  if (item.qtd <= 0) {
    itens = itens.filter(function (i) {
      return i.id !== id;
    });
  }

  saveCarrinho(itens);
  atualizarContadorCarrinho();
  renderizarCarrinho();
}

function removerDoCarrinho(id) {
  const itens = getCarrinho().filter(function (item) {
    return item.id !== id;
  });
  saveCarrinho(itens);
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

  document.addEventListener("click", function (e) {
    const btnCarrinho = e.target.closest("#btn-carrinho");
    if (btnCarrinho) {
      e.preventDefault();
      abrirCarrinho();
      return;
    }

    const btnAdd = e.target.closest(".add-cart");
    if (btnAdd) {
      e.preventDefault();

      if (!usuarioEstaLogado()) {
        window.location.href = getLoginPath();
        return;
      }

      const card = btnAdd.closest(".produto-item, .card-oferta");
      if (!card) return;

      adicionarAoCarrinho(extrairProduto(card));
      abrirCarrinho();
    }
  });

  if (overlay) {
    overlay.addEventListener("click", fecharCarrinho);
  }

  if (btnFechar) {
    btnFechar.addEventListener("click", fecharCarrinho);
  }

  if (lista) {
    lista.addEventListener("click", function (e) {
      const btnQtd = e.target.closest(".carrinho-qtd-btn");
      const btnRemover = e.target.closest(".carrinho-remover");

      if (btnQtd) {
        const delta = btnQtd.getAttribute("data-acao") === "mais" ? 1 : -1;
        alterarQuantidade(btnQtd.getAttribute("data-id"), delta);
        return;
      }

      if (btnRemover) {
        removerDoCarrinho(btnRemover.getAttribute("data-id"));
      }
    });
  }

  document.addEventListener("keydown", function (e) {
    if (e.key === "Escape") {
      fecharCarrinho();
    }
  });

  atualizarContadorCarrinho();
}

// ============================
// BUSCA PRODUTOS
// ============================

function initBuscaProdutos() {
  const pesquisaProdutos = document.getElementById("pesquisa-produtos");
  const gridProdutos = document.getElementById("grid-produtos");
  const emptyProdutos = document.getElementById("empty-produtos");

  if (!pesquisaProdutos || !gridProdutos) return;

  pesquisaProdutos.addEventListener("input", function () {
    const valor = pesquisaProdutos.value.toLowerCase();
    let achou = false;

    gridProdutos.querySelectorAll(".produto-item").forEach(function (item) {
      const nomeEl = item.querySelector("h3");
      const nome = nomeEl ? nomeEl.textContent.toLowerCase() : "";

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
// CONTATO FORM
// ============================

function initFormContato() {
  const formContato = document.getElementById("form-contato");
  const formSuccess = document.getElementById("form-success");

  if (!formContato) return;

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
    if (formSuccess) formSuccess.hidden = false;
  });
}
