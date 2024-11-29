const buttons = document.querySelectorAll("button");
for (let i = 0; i < buttons.length; i++) {
    buttons[i].addEventListener("click", () => {
        console.log(buttons[i].id);
        let cena = document.querySelector(`.cena-${buttons[i].id}`);
        let nazev = document.querySelector(`.nazev-${buttons[i].id}`);
        let input = document.querySelector(`.id-${buttons[i].id}`);
        let data_input = +input.value;
        let pocet = +input.value;

        // Získání aktuálního stavu z localStorage
        let data = JSON.parse(localStorage.getItem(buttons[i].id));
        console.log(data);

        if (data !== null) {
            pocet = +data.pocet + +data_input;
        }

        let itemData = {
            id: buttons[i].id,
            cena: cena ? cena.textContent : null,
            nazev: nazev ? nazev.textContent : null,
            pocet: +pocet,
        };

        localStorage.setItem(buttons[i].id, JSON.stringify(itemData));

        alert(
            `Úspěšně přidán produkt: ${nazev.textContent} do košíku, počet kusů v košíku je ${pocet}`
        );
    });
}
