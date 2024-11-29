const outputDiv = document.getElementById("vypis");

function getAllLocalStorage() {
    const allData = {};

    for (let i = 0; i < localStorage.length; i++) {
        const key = localStorage.key(i);
        const value = JSON.parse(localStorage.getItem(key));
        allData[key] = value;

        const div = document.createElement("div");
        div.className =
            "flex flex-col items-center lg:flex-row lg:items-end justify-between w-[80%] my-5";

        const div2 = document.createElement("div");
        div2.className =
            "flex flex-col items-center lg:flex-row lg:items-center";

        const h2 = document.createElement("h2");
        h2.textContent = value.nazev;
        h2.className =
            "text-center lg:text-start font-extrabold text-xl max-w-[190px] md:max-w-full";

        let numbers = value.cena.match(/\d+/g);
        let price = numbers ? parseInt(numbers.join(""), 10) : 0;
        let cena = +price * +value.pocet;

        const p = document.createElement("p");
        p.textContent = `${cena} Kč`;
        p.className = "font-semibold text-xl my-1 lg:ml-5";
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
        input_pocet.className = "w-16 my-1 pocet";
        input_pocet.id = value.id;

        div2.append(input_pocet, input_id, p);
        div.append(h2, div2);
        outputDiv.appendChild(div);
    }
    return allData;
}

getAllLocalStorage();

const inputs = document.querySelectorAll(".pocet");
for (let i = 0; i < inputs.length; i++) {
    inputs[i].addEventListener("change", (e) => {
        let cena = document.querySelector(`#cena-${inputs[i].id}`);
        const value = JSON.parse(localStorage.getItem(inputs[i].id));
        // console.log(i, inputs[i].value, inputs[i].id);
        if (+e.target.value === 0) {
            const confirmed = confirm(
                `Vážne chcete tento produkt odstranit z košíku: ${value.nazev}`
            );

            if (confirmed) {
                localStorage.removeItem(inputs[i].id);
                outputDiv.innerHTML = "";
                getAllLocalStorage();
            } else {
                value.pocet = 1;
                inputs[i].value = 1;
                console.log(value);

                localStorage.setItem(inputs[i].id, JSON.stringify(value));
            }
        } else {
            value.pocet = inputs[i].value;
            localStorage.setItem(inputs[i].id, JSON.stringify(value));

            let numbers = value.cena.match(/\d+/g);
            let price = numbers ? parseInt(numbers.join(""), 10) : 0;
            cena.textContent = inputs[i].value * price + " Kč";
        }
    });
}
