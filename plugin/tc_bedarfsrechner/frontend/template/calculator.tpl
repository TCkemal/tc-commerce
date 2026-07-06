<div class="tc-calculator" data-tc-bedarf="1">

    <div class="tc-calculator__box">

        <h4>📐 TC Bedarfsrechner</h4>

        <div class="mb-3">
            <label for="tc-area" class="form-label">
                Welche Fläche möchten Sie verlegen?
            </label>

            <div class="input-group">
                <input
                    id="tc-area"
                    class="form-control"
                    type="number"
                    step="0.01"
                    min="0"
                    placeholder="20">

                <span class="input-group-text">
                    m²
                </span>
            </div>
        </div>

        <div class="form-check mb-3">
            <input
                class="form-check-input"
                type="checkbox"
                id="tc-waste"
                checked>

            <label class="form-check-label" for="tc-waste">
                5 % Verschnitt berücksichtigen
            </label>
        </div>

        <hr>

        <table class="table table-sm">

            <tr>
                <td>Benötigte Pakete</td>
                <td class="text-end">
                    <strong id="tc-packages">0</strong>
                </td>
            </tr>

            <tr>
                <td>Gesamtfläche</td>
                <td class="text-end">
                    <strong id="tc-total-area">0,00 m²</strong>
                </td>
            </tr>

            <tr>
                <td>Gesamtpreis</td>
                <td class="text-end">
                    <strong id="tc-total-price">0,00 €</strong>
                </td>
            </tr>

        </table>

        <button
    		type="button"
    		id="tc-calculate"
    		class="btn btn-primary w-100">

            Berechnen

        </button>

    </div>

</div>
