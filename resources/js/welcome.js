document.addEventListener("DOMContentLoaded", function () {
    const recenzeLeva = document.getElementById("recenze-leva");
    const recenzePrava = document.getElementById("recenze-prava");
    const recenze = document.querySelectorAll(".recenze-item");
    let aktualniIndex = 0;

    const pocetRecenzi = recenze.length;

    function zobrazRecenzi(index) {
        recenze.forEach((rec, i) => {
            if (i === index) {
                rec.classList.remove("hidden");
                rec.style.opacity = 1;
            } else {
                rec.style.opacity = 0;
                setTimeout(() => {
                    rec.classList.add("hidden");
                }, 300);
            }
        });
    }

    function posunVlevo() {
        aktualniIndex = (aktualniIndex - 1 + pocetRecenzi) % pocetRecenzi;
        zobrazRecenzi(aktualniIndex);
    }

    function posunVpravo() {
        aktualniIndex = (aktualniIndex + 1) % pocetRecenzi;
        zobrazRecenzi(aktualniIndex);
    }

    if (recenzeLeva) {
        recenzeLeva.addEventListener("click", posunVlevo);
    }

    if (recenzePrava) {
        recenzePrava.addEventListener("click", posunVpravo);
    }

    // Přidání klávesových zkratek (volitelné)
    document.addEventListener("keydown", (e) => {
        if (e.key === "ArrowLeft") posunVlevo();
        if (e.key === "ArrowRight") posunVpravo();
    });
});
