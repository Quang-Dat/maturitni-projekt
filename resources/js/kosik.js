const outputDiv = document.getElementById("vypis");

function calculateTotalPrice() {
    let total = 0;
    for (let i = 0; i < localStorage.length; i++) {
        const key = localStorage.key(i);
        const value = JSON.parse(localStorage.getItem(key));
        let numbers = value.cena.match(/\d+/g);
        let price = numbers ? parseInt(numbers.join(""), 10) : 0;
        total += price * value.pocet;
    }
    return total;
}

function updateTotalPrice() {
    const totalPriceElement = document.querySelector(".total-price");
    if (totalPriceElement) {
        totalPriceElement.textContent = `${calculateTotalPrice()} Kč`;
    }
}

function getAllLocalStorage() {
    const allData = {};
    outputDiv.innerHTML = "";

    for (let i = 0; i < localStorage.length; i++) {
        const key = localStorage.key(i);
        const value = JSON.parse(localStorage.getItem(key));
        allData[key] = value;

        const div = document.createElement("div");
        div.className =
            "flex flex-col items-center lg:flex-row lg:items-end justify-between w-full bg-white p-6 rounded-lg shadow-xl mb-6 hover:shadow-xl transition-all duration-300";

        const div2 = document.createElement("div");
        div2.className =
            "flex flex-col items-center lg:flex-row lg:items-center space-x-0 lg:space-x-6 space-y-4 lg:space-y-0";

        const h2 = document.createElement("h2");
        h2.textContent = value.nazev;
        h2.className =
            "text-center lg:text-start font-extrabold text-xl text-hneda max-w-[190px] md:max-w-full";

        let numbers = value.cena.match(/\d+/g);
        let price = numbers ? parseInt(numbers.join(""), 10) : 0;
        let cena = +price * +value.pocet;

        const p = document.createElement("p");
        p.textContent = `${cena} Kč`;
        p.className = "font-semibold text-xl text-gray-700 lf:my-1 my-3";
        p.id = `cena-${value.id}`;

        const input_id = document.createElement("input");
        input_id.type = "number";
        input_id.value = value.id;
        input_id.className = "hidden";
        input_id.name = `id[${value.id}]`;

        const input_pocet = document.createElement("input");
        input_pocet.type = "number";
        input_pocet.min = 0;
        input_pocet.name = `pocet[${value.id}]`;
        input_pocet.value = value.pocet;
        input_pocet.className =
            "lg:mx-5 mb-3 lg:mb-0 w-20 px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-hneda focus:ring-2 focus:ring-hneda text-center pocet shadow-md hover:shadow-lg transition-all duration-300";
        input_pocet.id = value.id;

        const deleteBtn = document.createElement("button");
        deleteBtn.type = "button";
        deleteBtn.className =
            "flex items-center justify-center mx-auto hover:scale-110 transform";
        deleteBtn.innerHTML = `
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
            </svg>
        `;
        deleteBtn.onclick = () => removeItem(value.id, value.nazev);

        div2.append(input_id, p, input_pocet, deleteBtn);
        div.append(h2, div2);
        outputDiv.appendChild(div);
    }

    if (localStorage.length > 0) {
        const totalDiv = document.createElement("div");
        totalDiv.className =
            "w-full bg-white p-6 rounded-lg shadow-xl mt-6 hover:shadow-2xl transition-all duration-300";
        totalDiv.innerHTML = `
            <div class="flex justify-between items-center flex-col md:flex-row">
                <h3 class="text-2xl font-bold text-hneda">Celková cena:</h3>
                <p class="text-2xl font-bold text-hneda total-price">${calculateTotalPrice()} Kč</p>
            </div>
        `;
        outputDiv.appendChild(totalDiv);
    } else {
        const emptyDiv = document.createElement("div");
        emptyDiv.className =
            "w-full text-center py-8 bg-white rounded-lg shadow-xl";
        emptyDiv.innerHTML = `
            <p class="text-lg text-gray-600 mb-4">Váš košík je prázdný</p>
            <a href="/produkty" class="bg-hneda text-white px-6 py-2 rounded-lg hover:bg-oranzova transition-all duration-300 shadow-md hover:shadow-lg">
                Přejít do menu
            </a>
        `;
        outputDiv.appendChild(emptyDiv);
    }

    return allData;
}

function removeItem(id, nazev) {
    if (confirm(`Opravdu chcete odstranit produkt "${nazev}" z košíku?`)) {
        localStorage.removeItem(id);
        getAllLocalStorage();
    } else {
    }
}

getAllLocalStorage();

document.addEventListener("change", (e) => {
    if (e.target.classList.contains("pocet")) {
        const input = e.target;
        const id = input.id;
        const value = JSON.parse(localStorage.getItem(id));
        const cenaElement = document.querySelector(`#cena-${id}`);

        if (+input.value === 0) {
            removeItem(id, value.nazev);
        } else {
            value.pocet = input.value;
            localStorage.setItem(id, JSON.stringify(value));

            let numbers = value.cena.match(/\d+/g);
            let price = numbers ? parseInt(numbers.join(""), 10) : 0;
            cenaElement.textContent = input.value * price + " Kč";

            updateTotalPrice();
        }
    }
});
