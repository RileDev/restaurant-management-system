let items = [];
const clearBtn = document.getElementById("clearItems");
const foodsBtns = document.querySelectorAll("#foodsBtn");
const selectedFoodsContainer = document.querySelector(
  ".selected-foods .row ul"
);
const foodsArr = document.getElementById("foods-array");

const fetchFoods = (el) => {
  const dataID = el.getAttribute("data-id");
  el.disabled = true;
  items.push({ id: dataID, name: el.innerText });
  updateContainer();
  console.log(dataID);
};

const clearItems = () => {
  items.splice(0, items.length);
  enableBtns();
  updateContainer();
  console.log("ITEMS ARE CLEANED!");
};

const enableBtns = () => {
  foodsBtns.forEach((foodBtn) => {
    foodBtn.disabled = false;
  });
};

const updateContainer = () => {
  let content = "";
  items.forEach((item) => {
    content += `<li>${item.name}</li>`;
  });
  selectedFoodsContainer.innerHTML = content;
  foodsArr.value = getIdsOnly();
  console.log(foodsArr.value);
};

const getIdsOnly = () => {
  return items.map((item) => item.id);
};

// const createOrder = (e) => {
//   e.preventDefault();
//   const array = getIdsOnly();
//   if (array.length === 0) return;

//   var xmlhttp;
//   if (window.XMLHttpRequest) {
//     // code for IE7+, Firefox, Chrome, Opera, Safari
//     xmlhttp = new XMLHttpRequest();
//   } else {
//     // code for IE6, IE5
//     xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
//   }
//   xmlhttp.onreadystatechange = function () {
//     if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
//       console.log("JS, got data back, response: " + xmlhttp.responseText);
//     }
//   };
//   xmlhttp.open("POST", "finish_order.php", true);
//   xmlhttp.send("foods-array=" + array);

//     // request.send(data);
// };

clearBtn.addEventListener("click", clearItems);
