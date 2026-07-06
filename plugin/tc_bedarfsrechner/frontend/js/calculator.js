document.addEventListener("DOMContentLoaded", () => {
    const calculator = document.querySelector('[data-package-size][data-package-price]');

    if (!calculator) return;

    const areaInput = document.getElementById("tc-area");
    const wasteCheckbox = document.getElementById("tc-waste");
    const calculateButton = document.getElementById("tc-calculate");

    const packagesOutput = document.getElementById("tc-packages");
    const totalAreaOutput = document.getElementById("tc-total-area");
    const totalPriceOutput = document.getElementById("tc-total-price");

    const packageSize = parseFloat(String(calculator.dataset.packageSize || "0").replace(",", "."));
    const packagePrice = parseFloat(String(calculator.dataset.packagePrice || "0").replace(",", "."));

    function calculate() {
        let area = parseFloat(String(areaInput.value || "0").replace(",", "."));

        if (isNaN(area) || area <= 0) {
            packagesOutput.innerText = "0";
            totalAreaOutput.innerText = "0,00 m²";
            totalPriceOutput.innerText = "0,00 €";
            return;
        }

        if (wasteCheckbox && wasteCheckbox.checked) {
            area *= 1.05;
        }

        const packages = Math.ceil(area / packageSize);
        const coveredArea = packages * packageSize;
        const totalPrice = packages * packagePrice;
    
    const quantityInput =
    document.querySelector('input[name="anzahl"]') ||
    document.querySelector('input.quantity') ||
    document.querySelector('#quantity');

if (quantityInput) {
    quantityInput.value = packages;
    quantityInput.dispatchEvent(new Event("change", { bubbles: true }));
}
        packagesOutput.innerText = packages;
        totalAreaOutput.innerText = coveredArea.toFixed(2).replace(".", ",") + " m²";
        totalPriceOutput.innerText = totalPrice.toFixed(2).replace(".", ",") + " €";
    }

    calculateButton.addEventListener("click", function (event) {
        event.preventDefault();
        calculate();
    });

    areaInput.addEventListener("input", calculate);

    if (wasteCheckbox) {
        wasteCheckbox.addEventListener("change", calculate);
    }
});