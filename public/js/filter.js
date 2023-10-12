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
                var data = $.map(data, function (obj) {
                    obj.id = obj.codigo || obj.pk;
                    obj.text = obj.nome || obj.name;
                    return obj;
                });
                return {
                    results: data,
                };
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
                    var data = $.map(data, function (obj) {
                        obj.id = obj.codigo || obj.pk;
                        obj.text = obj.nome || obj.name;
                        return obj;
                    });
                    return {
                        results: data,
                    };
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
                    var data = $.map(data, function (obj) {
                        obj.id = obj.codigo || obj.pk;
                        obj.text = obj.nome || obj.name;
                        return obj;
                    });
                    return {
                        results: data,
                    };
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
});
