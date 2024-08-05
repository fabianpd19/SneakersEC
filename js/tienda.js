let show_categories_array = [];
let show_gender_array = [];
let show_brands_array = [];

$(document).ready(function () {
  showAllItems();

  $(".category-filter-check").click(function () {
    let category_clicked = $(this).attr("data-category");

    if ($(this).is(":checked")) {
      show_categories_array.push(category_clicked);
    } else {
      show_categories_array = show_categories_array.filter(function (elem) {
        return elem !== category_clicked;
      });
    }
    applyFilters();
  });

  $(".gender-filter-check").click(function () {
    let gender_clicked = $(this).attr("data-gender");

    if ($(this).is(":checked")) {
      show_gender_array.push(gender_clicked);
    } else {
      show_gender_array = show_gender_array.filter(function (elem) {
        return elem !== gender_clicked;
      });
    }
    applyFilters();
  });

  $(".brand-filter-check").click(function () {
    let brand_clicked = $(this).attr("data-brand");

    if ($(this).is(":checked")) {
      show_brands_array.push(brand_clicked);
    } else {
      show_brands_array = show_brands_array.filter(function (elem) {
        return elem !== brand_clicked;
      });
    }
    applyFilters();
  });

  function applyFilters() {
    if (
      show_categories_array.length === 0 &&
      show_gender_array.length === 0 &&
      show_brands_array.length === 0
    ) {
      showAllItems();
    } else {
      showItemsFiltered();
    }
  }
});

// Mock API:
let category_items = [
  {
    id: 1,
    category_id: 8,
    price: 39.42,
    original_price: 49.99,
    rating: 4,
    title: "Deportivo Adidas",
    thumbnail:
      "https://www.transparentpng.com/download/adidas-shoes/a4xO3G-adidas-shoes-adidas-shoe-kids-superstar-daddy-grade.png",
    category: "Deportivos",
    gender: "Hombres",
    brand: "Adidas",
  },
  {
    id: 2,
    category_id: 8,
    price: 31.93,
    original_price: 39.99,
    rating: 3,
    title: "Casual Nike",
    thumbnail:
      "https://www.transparentpng.com/thumb/nike/aSEQ60-nike-transparent-image.png",
    category: "Casuales",
    gender: "Mujeres",
    brand: "Nike",
  },
  {
    id: 3,
    category_id: 8,
    price: 49.44,
    original_price: 59.99,
    rating: 5,
    title: "Formal Puma",
    thumbnail:
      "https://www.transparentpng.com/thumb/adidas/O86IC7-adidas-shoe-clipart-photo.png",
    category: "Formal",
    gender: "Unisex",
    brand: "Puma",
  },
  {
    id: 4,
    category_id: 8,
    price: 45.99,
    original_price: 55.99,
    rating: 4,
    title: "Bota Reebok",
    thumbnail:
      "https://www.police.com.ec/wp-content/uploads/2023/10/Bota-3455.png",
    category: "Botas",
    gender: "Hombres",
    brand: "Reebok",
  },
  {
    id: 5,
    category_id: 8,
    price: 37.89,
    original_price: 47.99,
    rating: 4,
    title: "Casual Vans",
    thumbnail:
      "https://resources.sears.com.mx/imgsplaza-sears/sears/?tp=p&id=795048&t=original&scale=500&qlty=75",
    category: "Casuales",
    gender: "Mujeres",
    brand: "Vans",
  },
  {
    id: 6,
    category_id: 8,
    price: 52.3,
    original_price: 62.99,
    rating: 5,
    title: "Deportivo Nike",
    thumbnail:
      "https://atleta.ec/4421/zapatos-nike-star-runner-3-gs-negro-da2776-001.jpg",
    category: "Deportivos",
    gender: "Unisex",
    brand: "Nike",
  },
  {
    id: 7,
    category_id: 8,
    price: 43.5,
    original_price: 53.99,
    rating: 4,
    title: "Formal Reebok",
    thumbnail:
      "https://images.reebok.eu/reebok-club-c-85-shoes_19725947_45449821_2048.jpg?c=1",
    category: "Formal",
    gender: "Hombres",
    brand: "Reebok",
  },
  {
    id: 8,
    category_id: 8,
    price: 39.99,
    original_price: 49.99,
    rating: 3,
    title: "Bota Puma",
    thumbnail: "https://m.media-amazon.com/images/I/41TWaUfMccL._AC_.jpg",
    category: "Botas",
    gender: "Mujeres",
    brand: "Puma",
  },
  {
    id: 9,
    category_id: 8,
    price: 48.25,
    original_price: 58.99,
    rating: 5,
    title: "Deportivo Vans",
    thumbnail:
      "https://sevensportio.vtexassets.com/arquivos/ids/345074-800-auto?v=638500851114900000&width=800&height=auto&aspect=true",
    category: "Deportivos",
    gender: "Hombres",
    brand: "Vans",
  },
  {
    id: 10,
    category_id: 8,
    price: 42.1,
    original_price: 52.99,
    rating: 4,
    title: "Casual Puma",
    thumbnail:
      "https://images.puma.com/image/upload/f_auto,q_auto,b_rgb:fafafa,w_2000,h_2000/global/392493/02/sv01/fnd/THA/fmt/png/Bari-Casual-Retro-Academia-Sneakers",
    category: "Casuales",
    gender: "Unisex",
    brand: "Puma",
  },
];

function showAllItems() {
  $("#display-items-div").empty();
  for (let i = 0; i < category_items.length; i++) {
    let item_content = createCard(category_items[i]);
    $("#display-items-div").append(item_content);
  }
}

function showItemsFiltered() {
  $("#display-items-div").empty();
  for (let i = 0; i < category_items.length; i++) {
    let item = category_items[i];
    if (
      (show_categories_array.length === 0 ||
        show_categories_array.includes(item.category)) &&
      (show_gender_array.length === 0 ||
        show_gender_array.includes(item.gender)) &&
      (show_brands_array.length === 0 || show_brands_array.includes(item.brand))
    ) {
      let item_content = createCard(item);
      $("#display-items-div").append(item_content);
    }
  }
}

function createCard(item) {
  let discount = (
    ((item.original_price - item.price) / item.original_price) *
    100
  ).toFixed(0);
  let stars = "";
  for (let i = 0; i < 5; i++) {
    stars +=
      i < item.rating
        ? '<span class="fa fa-star checked"></span>'
        : '<span class="fa fa-star"></span>';
  }
  return `
    <div class="col-12 col-md-4 mb-4">
      <div class="card" style="height: 100%;">
        <img src="${item.thumbnail}" class="card-img-top img-fluid" alt="${
    item.title
  }">
        <div class="card-body">
          <h5 class="card-title">${item.title}</h5>
          <div class="card-text">${stars}</div>
          <p class="card-text">
            <span class="font-weight-bold">$${item.price.toFixed(2)}</span>
            <span class="text-muted" style="text-decoration: line-through;">$${item.original_price.toFixed(
              2
            )}</span>
            <span class="text-danger">(${discount}% off)</span>
          </p>
          <!-- <p class="card-text">Category: ${item.category}</p> -->
          <!-- <p class="card-text">Gender: ${item.gender}</p> -->
          <!-- <p class="card-text">Brand: ${item.brand}</p> -->
        </div>
      </div>
    </div>`;
}

$(document).ready(function () {
  // Agregar la clase visible para los elementos con la clase fade-in
  $(".fade-in").each(function (i) {
    var element = $(this);
    setTimeout(function () {
      element.addClass("visible");
    }, 200 * i); // Retraso escalonado para cada elemento
  });

  // Agregar la clase visible para la barra lateral
  $(".slide-in").addClass("visible");
});
