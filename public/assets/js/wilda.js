// javascript variable : let, var, const

// const { useEffect } = require("react");

// php variable = $,define,const
// let nama = "reza";
// var name = "Bambang";
// const fullname = "caca caci"; //const nilai tetap, tidak boleh dirubah

// //cara run:
// // document.write()
// // console.log({
// //     "nama": name,
// //     "fullname": fullname
// // }); //>>>>fungsinya kek echo
// // alert(nama);

// let angka1 = 10;
// let angka2 = 5;
// console.log(angka1 + angka2);
// console.log(angka1 - angka2);
// console.log(angka1 / angka2);
// console.log(angka1 * angka2);
// console.log(angka1 % angka2);
// console.log(angka1 ** angka2);

// //operator penugasan
// let x = 10;
// x += 5; //output 15
// console.log(x);

// //operator penugasan : > < = == === !==
// let a = 1;
// let b = 1;
// if (a === b) {
//   console.log("ya");
// } else {
//   console.log("ga");
// }
// console.log(a > b);
// console.log(a < b);

// //operator logika : && AND OR || !:
// let umur = 20;
// let punyaSim = true;
// if (umur >= 17 && punyaSim) {
//   console.log("boleh mengemudi");
// } else {
//   console.log("tidak boleh mengemudi");
// }

// //array
// let buah = ["pisang", "salak", "semangkaa"];
// console.log("buah di keranjang: ", buah);
// console.log("saya mau buah ", buah[1]);
// buah[1] = "nanas";
// console.log("buah baru : ", buah);
// buah.push("pepaya");
// console.log("nambah buah baru lagi", buah);
// buah.pop();
// console.log("buah terakhir dihapus", buah);

// // document.getElementById("product-tittle").innerHTML =
// //   "<p>Data Product di dalam p</p>";
// // document.querySelector("#product-tittle");

// let btn = document.getElementsByClassName("category-btn");
// // btn[2].style.color = "red";
// console.log("ini button", btn);
// let button = document.querySelectorAll(".category-btn");
// // button.forEach(function (btn) {});
// button.forEach((btn) => {
//   btn.style.color = "#fc7272ff";
//   console.log(btn);
// });

// let card = document.getElementById("card");
// let h3 = document.createElement("h3");
// let textH3 = document.createTextNode("Selamat Datang"); //cara 1
// h3.textContent = "selamat datang dengan textcontent"; //cara 2

// let p = document.createElement("p");
// p.innerText = "duar jadi";
// p.textContent = "YYY jadi";
// //nambahin element di dalam card
// card.appendChild(h3);
// card.appendChild(p);

// foreach($button as $btn){}
// document.querySelector(".catergory-btn");

let currentCategory = "all";
function filterCategory(category, event) {
  currentCategory = category;
  let buttons = document.querySelectorAll(".category-btn");
  buttons.forEach((btn) => {
    btn.classList.remove("active");
    btn.classList.remove("btn-secondary");
    btn.classList.add("btn-outline-secondary");
  });
  event.classList.add("active");
  event.classList.remove("btn-outline-secondary");
  event.classList.add("btn-secondary");
  console.log({
    currentCategory: currentCategory,
    category: category,
    event: event,
  });
  renderProducts();
}

function renderProducts(searchProduct = "") {
  const productGrid = document.getElementById("productGrid");
  productGrid.innerHTML = "";
  //filter
  const filtered = products.filter((p) => {
    //shorthand/ternery
    const matchCategory =
      currentCategory === "all" || p.category_name === currentCategory;
    const matchSearch = p.product_name.toLowerCase().includes(searchProduct);
    return matchCategory && matchSearch;
  });

  if (filtered.length === 0) {
    // tampilkan pesan jika kosong
    productGrid.innerHTML = `<p class="text-center mt-3">Maaf, produk roduk tidak ditemukan</p>`;
    return;
  }
  //munculin data dari table product
  filtered.forEach((product) => {
    const col = document.createElement("div");
    col.className = "col-md-4 col-sm-6";
    col.innerHTML = `<div class="card product-card" onclick="addToCart(${product.id})">
        <div class="product-img">
            <img src="../${product.product_photo}" alt="" width="100%">
        </div>
        <div class="card-body">
            <span class="badge bg-secondary badge-category">${product.category_name}</span>
            <h6 class="card-tittle mt-2 mb-2">${product.product_name}</h6>
            <p class="card-text text-primary fw-bold">Rp. ${product.product_price}</p>
        </div>
    </div>`;
    productGrid.appendChild(col);
  });
  //   console.log(products);
}

let cart = [];
function addToCart(id) {
  const product = products.find((p) => p.id == id);

  // if (!product) {
  //   return;
  // }
  const existing = cart.find((item) => item.id == id);
  if (existing) {
    existing.quantity += 1;
    // alert("produk sudah ada di cart");
  } else {
    cart.push({ ...product, quantity: 1 });
  }
  renderCart();
}

function renderCart() {
  const cartContainer = document.querySelector("#cartItems");
  cartContainer.innerHTML = "";

  if (cart.length === 0) {
    cartContainer.innerHTML = `
    <div class="cart-items" id="cartItems">
        <div class="text-center text-muted mt-5">
           <i class="bi bi-cart mb-3"></i>
            <p>Cart Empty</p>
        </div>
    </div>
    `;
    updateTotal();
    // return;
  }
  cart.forEach((item, index) => {
    const div = document.createElement("div");
    div.className =
      "cart-items d-flex justify-content-between align-items-center mb-2";
    div.innerHTML = `
      <div>
        <strong>${item.product_name}</strong>
        <small>${item.product_price}</small>
      </div>
      <div class="d-flex align-items-center">
        <button class="btn btn-outline-secondary me-2" onclick="changeQty(${item.id}, -1)">-</button>
        <span> ${item.quantity} </span>
        <button class="btn btn-outline-secondary ms-3" onclick="changeQty(${item.id}, 1)">+</button>
        <button class="btn btn-sm btn-danger ms-3" onclick="removeItem(${item.id})">
            <i class="bi bi-trash"></i>
        </button>
        
      </div>
    `;
    cartContainer.appendChild(div);
  });
  updateTotal();
}

function removeItem(id) {
  cart = cart.filter((p) => p.id != id);
  renderCart();
}

function changeQty(id, x) {
  const item = cart.find((p) => p.id == id);
  if (!item) {
    return;
  }
  item.quantity += x;
  if (item.quantity <= 0) {
    alert("minimum satu produk");
    item.quantity += 1;
    // cart = cart.filter((p) => p.id != id);
  }
  renderCart();
}

function updateTotal() {
  const subtotal = cart.reduce(
    (sum, item) => sum + item.product_price * item.quantity,
    0
  );
  const tax = subtotal * 0.1;
  const total = tax + subtotal;

  document.getElementById("subtotal").textContent = `Rp. ${subtotal.toLocaleString()}`;
  document.getElementById("tax").textContent = `Rp. ${tax.toLocaleString()}`;
  document.getElementById("total").textContent = `Rp. ${total.toLocaleString()}`;

  document.getElementById("subtotal_value").value =subtotal;
  document.getElementById("tax_value").value =tax;
  document.getElementById("total_value").value =total;

  
  // console.log(subtotal);
  // console.log(tax);
  // console.log(total);
}

document.getElementById("clearCart").addEventListener("click", function (e) {
  e.preventDefault();
  cart = [];
  renderCart();
});

async function processPayment() {
  if (cart.length === 0) {
    alert("cart Masih Kosong");
    return;
  }
  const order_code = document.querySelector('.orderNumber').textContent.trim();
  const subtotal = document.querySelector('#subtotal_value').value.trim();
  const tax = document.querySelector('#tax_value').value.trim();
  const grandTotal = document.querySelector('#total_value').value.trim();

  try {
    const res = await fetch("add-pos.php?payment", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify({ cart, order_code,subtotal,tax,grandTotal }),
    });
    const data = await res.json();
    if (data.status == "success") {
      alert("Transaction success");
      window.location.href = "print.php";
    } else {
      alert("transaction failed", data.message);
    }
    // const data = await res.json();
  } catch (error) {
    alert("transaction faailed");
    console.error(error);
  }
}

// useEffect(()=>{,[]})
// DomContentLoaded : akan meload function pertama kali
renderProducts();

document
  .getElementById("searchProduct")
  .addEventListener("input", function (e) {
    const searchProduct = e.target.value.toLowerCase();
    renderProducts(searchProduct);
  });
