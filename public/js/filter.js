$(document).ready(function () {
    var url = `${environment.API_URL}`;

    $(".form-select").select2({
        placeholder: "Selecione...",
    });

    $("#models").prop("disabled", true);
    $("#years").prop("disabled", true);

    $("#brands").select2({
        ajax: {
            url: `${url}/brands`,
            processResults: function (data) {
                return processResults(data);
            },
        },
    });

    $("#brands").on("select2:select", function (e) {
        var data = e.params.data;
        var brandId = data.codigo;

        $("#models").prop("disabled", false);
        $("#models").select2({
            ajax: {
                url: `${url}/models/${brandId}`,
                processResults: function (data) {
                    return processResults(data);
                },
            },
        });
    });

    $("#models").on("select2:select", function (e) {
        var brandId = $("#brands").find(":selected")[0].value;
        var modelId = e.params.data.codigo;

        $("#years").prop("disabled", false);
        $("#years").select2({
            ajax: {
                url: `${url}/years/${brandId}/${modelId}`,
                processResults: function (data) {
                    return processResults(data);
                },
            },
        });
    });

    $("#years").on("select2:select", function (e) {
        $("#filter").prop("disabled", false);
    });

    $("#filter").on("click", (e) => {
        e.preventDefault();
        var brandId = $("#brands").find(":selected")[0].value;
        var modelId = $("#models").find(":selected")[0].value;
        var yearCode = $("#years").find(":selected")[0].value;

        $.ajax({
            url: `${url}/vehicles/${brandId}/${modelId}/${yearCode}`,
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
    });

    $("#xlsx_export").on("click", (e) => {
        e.preventDefault();
        if (validateFilledTable()) {
            const arraVehicles = getTableRowValuesIntoArray();

            $.ajax({
                url: `${url}/vehicles/export/xlsx`,
                method: "POST",
                xhrFields: {
                    responseType: "blob",
                },
                data: { content: arraVehicles },
            }).done(function (data) {
                prepareDataToDownload(data, "xlsx");
            });
        }
    });

    $("#pdf_export").on("click", (e) => {
        e.preventDefault();
        if (validateFilledTable()) {
            const arraVehicles = getTableRowValuesIntoArray();

            $.ajax({
                url: `${url}/vehicles/export/pdf`,
                method: "POST",
                xhrFields: {
                    responseType: "blob",
                },
                data: { content: arraVehicles },
            }).done(function (data) {
                prepareDataToDownload(data, "pdf");
            });
        }
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
