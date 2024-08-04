let show_sizes_array = []; //Where the filtered sizes get stored

$(document).ready(function () {
  showAllItems(); //Display all items with no filter applied

  $(".size-filter-check").click(function () {
    //When a checkbox is clicked
    let size_clicked = $(this).attr("data-size"); //The certain size checkbox clicked

    if ($(this).is(":checked")) {
      show_sizes_array.push(size_clicked); //Was not checked so add to filter array
      showItemsFiltered(); //Show items grid with filters
    } else {
      //Unchecked so remove from the array
      show_sizes_array = show_sizes_array.filter(function (elem) {
        return elem !== size_clicked;
      });
      showItemsFiltered(); //Show items grid with new filters
    }

    if (!$("input[type=checkbox]").is(":checked")) {
      //No checkboxes are checked
      show_sizes_array = []; //Clear size filter array
      showAllItems(); //Show all items with NO filters applied
    }
  });
});

//Mock API data:
let category_items = [
  {
    id: 1,
    category_id: 8,
    price: 39.42,
    title: "Shoes with id #1",
    thumbnail:
      "https://www.transparentpng.com/download/adidas-shoes/a4xO3G-adidas-shoes-adidas-shoe-kids-superstar-daddy-grade.png",
    sizes: ["US-MEN-10", "US-MEN-11"],
  },
  {
    id: 2,
    category_id: 8,
    price: 31.93,
    title: "Shoes with id #2",
    thumbnail:
      "https://www.transparentpng.com/download/adidas-shoes/a4xO3G-adidas-shoes-adidas-shoe-kids-superstar-daddy-grade.png",
    sizes: ["US-MEN-13"],
  },
  {
    id: 3,
    category_id: 8,
    price: 49.44,
    title: "Shoes with id #3",
    thumbnail:
      "https://www.transparentpng.com/download/adidas-shoes/a4xO3G-adidas-shoes-adidas-shoe-kids-superstar-daddy-grade.png",
    sizes: ["US-MEN-14"],
  },
  {
    id: 4,
    category_id: 58,
    price: 65.38,
    title: "Shoes with id #4",
    thumbnail:
      "https://www.transparentpng.com/download/adidas-shoes/a4xO3G-adidas-shoes-adidas-shoe-kids-superstar-daddy-grade.png",
    sizes: ["US-MEN-13"],
  },
  {
    id: 5,
    category_id: 8,
    price: 27.21,
    title: "Shoes with id #5",
    thumbnail:
      "https://www.transparentpng.com/download/adidas-shoes/a4xO3G-adidas-shoes-adidas-shoe-kids-superstar-daddy-grade.png",
    sizes: ["US-MEN-9", "US-MEN-8", "US-MEN-10", "US-MEN-11", "US-MEN-12"],
  },
  {
    id: 6,
    category_id: 8,
    price: 73.05,
    title: "Shoes with id #6",
    thumbnail:
      "https://www.transparentpng.com/download/adidas-shoes/a4xO3G-adidas-shoes-adidas-shoe-kids-superstar-daddy-grade.png",
    sizes: [
      "US-MEN-9",
      "US-MEN-8",
      "US-MEN-10",
      "US-MEN-11",
      "US-MEN-12",
      "US-MEN-13",
    ],
  },
  {
    id: 7,
    category_id: 8,
    price: 51.96,
    title: "Shoes with id #7",
    thumbnail:
      "https://www.transparentpng.com/download/adidas-shoes/a4xO3G-adidas-shoes-adidas-shoe-kids-superstar-daddy-grade.png",
    sizes: ["US-MEN-9", "US-MEN-8", "US-MEN-10", "US-MEN-11"],
  },
  {
    id: 8,
    category_id: 8,
    price: 29.35,
    title: "Shoes with id #8",
    thumbnail:
      "https://www.transparentpng.com/download/adidas-shoes/a4xO3G-adidas-shoes-adidas-shoe-kids-superstar-daddy-grade.png",
    sizes: ["US-MEN-11", "US-MEN-12", "US-MEN-13"],
  },
  {
    id: 9,
    category_id: 8,
    price: 80.0,
    title: "Shoes with id #9",
    thumbnail:
      "https://www.transparentpng.com/download/adidas-shoes/a4xO3G-adidas-shoes-adidas-shoe-kids-superstar-daddy-grade.png",
    sizes: ["US-MEN-9", "US-MEN-8", "US-MEN-10", "US-MEN-11"],
  },
  {
    id: 10,
    category_id: 8,
    price: 70.07,
    title: "Shoes with id #10",
    thumbnail:
      "https://www.transparentpng.com/download/adidas-shoes/a4xO3G-adidas-shoes-adidas-shoe-kids-superstar-daddy-grade.png",
    sizes: ["US-MEN-9", "US-MEN-8", "US-MEN-10"],
  },
  {
    id: 11,
    category_id: 8,
    price: 79.37,
    title: "Shoes with id #11",
    thumbnail:
      "https://www.transparentpng.com/download/adidas-shoes/a4xO3G-adidas-shoes-adidas-shoe-kids-superstar-daddy-grade.png",
    sizes: ["US-MEN-9", "US-MEN-8", "US-MEN-10", "US-MEN-11", "US-MEN-12"],
  },
  {
    id: 12,
    category_id: 8,
    price: 27.14,
    title: "Shoes with id #12",
    thumbnail:
      "https://www.transparentpng.com/download/adidas-shoes/a4xO3G-adidas-shoes-adidas-shoe-kids-superstar-daddy-grade.png",
    sizes: ["US-MEN-9", "US-MEN-8", "US-MEN-10", "US-MEN-11"],
  },
];

function showAllItems() {
  //Default grid to show all items on page load in
  $("#display-items-div").empty();
  for (let i = 0; i < category_items.length; i++) {
    let item_content =
      '<div class="col-12 col-md-4 text-center product-card" data-available-sizes="' +
      category_items[i]["sizes"] +
      '"><b>' +
      category_items[i]["title"] +
      '</b><br><img src="' +
      category_items[i]["thumbnail"] +
      '" height="64" width="64" alt="shoe thumbnail"><p>$' +
      category_items[i]["price"] +
      "</p></div>";
    $("#display-items-div").append(item_content);
  }
}

function showItemsFiltered() {
  //Default grid to show all items on page load in
  $("#display-items-div").empty();
  for (let i = 0; i < category_items.length; i++) {
    //Go through the items but only show items that have size from show_sizes_array
    if (show_sizes_array.some((v) => category_items[i]["sizes"].includes(v))) {
      let item_content =
        '<div class="col-12 col-md-4 text-center product-card" data-available-sizes="' +
        category_items[i]["sizes"] +
        '"><b>' +
        category_items[i]["title"] +
        '</b><br><img src="' +
        category_items[i]["thumbnail"] +
        '" height="64" width="64" alt="shoe thumbnail"><p>$' +
        category_items[i]["price"] +
        "</p></div>";
      $("#display-items-div").append(item_content); //Display in grid
    }
  }
}
