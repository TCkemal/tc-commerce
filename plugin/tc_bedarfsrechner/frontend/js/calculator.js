document.addEventListener("DOMContentLoaded", () => {

    const areaInput = document.getElementById("tc-area");
    const wasteCheckbox = document.getElementById("tc-waste");
    const calculateButton = document.getElementById("tc-calculate");

    if (!areaInput || !calculateButton) {
        return;
    }

    /*
     * Diese Werte kommen in Version 0.4 automatisch aus PHP/JTL.
     * Für den ersten Test verwenden wir feste Werte.
     */
    const packageSize = 2.525;
    const packagePrice = 70.45;

    function calculate() {

        let area = parseFloat(areaInput.value.replace(",", "."));

        if (isNaN(area) || area <= 0) {

            document.getElementById("tc-packages").innerText = "0";
            document.getElementById("tc-total-area").innerText = "0,00 m²";
            document.getElementById("tc-total-price").innerText = "0,00 €";

            return;
        }

        if (wasteCheckbox.checked) {
            area *= 1.05;
        }

        const packages = Math.ceil(area / packageSize);

        const coveredArea = packages * packageSize;

        const totalPrice = packages * packagePrice;

        document.getElementById("tc-packages").innerText =
            packages;

        document.getElementById("tc-total-area").innerText =
            coveredArea.toFixed(2).replace(".", ",") + " m²";

        document.getElementById("tc-total-price").innerText =
            totalPrice.toFixed(2).replace(".", ",") + " €";
    }

    calculateButton.addEventListener("click", calculate);

    areaInput.addEventListener("keyup", calculate);

    areaInput.addEventListener("change", calculate);

    wasteCheckbox.addEventListener("change", calculate);

});