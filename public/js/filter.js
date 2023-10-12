$(document).ready(function () {
    const urlBase = `${environment.API_URL}`;

    $(".form-select").select2({
        placeholder: "Selecione...",
    });

    $("#models").prop("disabled", true);
    $("#years").prop("disabled", true);

    $("#brands").select2({
        ajax: {
            url: `${urlBase}/brands`,
            processResults: function (data) {
                return processResults(data);
            },
        },
    });

    $("#brands").on("select2:select", function (e) {
        const data = e.params.data;
        const brandId = data.codigo;
        const url = `${urlBase}/models/${brandId}`;

        brandsSelectOnChange(url);
    });

    $("#models").on("select2:select", function (e) {
        const brandId = $("#brands").find(":selected")[0].value;
        const modelId = e.params.data.codigo;
        const url = `${urlBase}/years/${brandId}/${modelId}`;

        modelsSelectOnChange(url);
    });

    $("#years").on("select2:select", function (e) {
        yearsSelectOnChange();
    });

    $("#filter").on("click", (e) => {
        e.preventDefault();
        const brandId = $("#brands").find(":selected")[0].value;
        const modelId = $("#models").find(":selected")[0].value;
        const yearCode = $("#years").find(":selected")[0].value;

        const url = `${urlBase}/vehicles/${brandId}/${modelId}/${yearCode}`;

        filter(url);
    });

    $("#xlsx_export").on("click", (e) => {
        e.preventDefault();
        const type = "xlsx";
        const url = `${urlBase}/vehicles/export/${type}`;
        exportData(url, type);
    });

    $("#pdf_export").on("click", (e) => {
        e.preventDefault();
        const type = "pdf";
        const url = `${urlBase}/vehicles/export/${type}`;
        exportData(url, type);
    });
});

function processResults(data) {
    var data = $.map(data, function (obj) {
        obj.id = obj.codigo || obj.pk;
        obj.text = obj.nome || obj.name;
        return obj;
    });

    return {
        results: data,
    };
}

function brandsSelectOnChange(url) {
    $("#models").prop("disabled", false);
    $("#models").select2({
        ajax: {
            url,
            processResults: function (data) {
                return processResults(data);
            },
        },
    });
}

function modelsSelectOnChange(url) {
    $("#years").prop("disabled", false);
    $("#years").select2({
        ajax: {
            url,
            processResults: function (data) {
                return processResults(data);
            },
        },
    });
}

function yearsSelectOnChange() {
    $("#filter").prop("disabled", false);
}

function filter(url) {
    $.ajax({
        url,
    }).done(function (data) {
        $("#vehicles tbody").html("");
        var tblRow = `<tr><td>${data.Valor}</td>
            <td>${data.Marca}</td>
            <td>${data.Modelo}</td>
            <td>${data.AnoModelo}</td>
            <td>${data.Combustivel}</td>
            </tr>`;
        $("#vehicles tbody").append(tblRow);
    });
}

function exportData(url, type) {
    if (validateFilledTable()) {
        const arraVehicles = getTableRowValuesIntoArray();

        $.ajax({
            url,
            method: "POST",
            xhrFields: {
                responseType: "blob",
            },
            data: { content: arraVehicles },
        }).done(function (data) {
            prepareDataToDownload(data, type);
        });
    }
}

function validateFilledTable() {
    const tbody = $("#vehicles tbody").html();
    if (!tbody) {
        alert("Não é possivel exportar tabela vazia");
        return false;
    }

    return true;
}

function getTableRowValuesIntoArray() {
    let arraVehicles = Array();

    $("#vehicles tr").each(function (i, row) {
        arraVehicles[i] = Array();
        $(this)
            .children("th")
            .each(function (j, columnHead) {
                arraVehicles[i][j] = $(this).text();
            });

        $(this)
            .children("td")
            .each(function (k, columnBody) {
                arraVehicles[i][k] = $(this).text();
            });
    });

    return arraVehicles;
}

function prepareDataToDownload(data, fileExtension) {
    var a = document.createElement("a");
    var url = window.URL.createObjectURL(data);
    a.href = url;
    a.download = `vehicles.${fileExtension}`;
    document.body.append(a);
    a.click();
    a.remove();
    window.URL.revokeObjectURL(url);
}
