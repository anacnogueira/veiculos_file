$(document).ready(function () {
    $(".form-select").select2();
});

var selects = document.getElementsByTagName("select");

for (i = 0; i < selects.length; i++) {
    var option = document.createElement("option");
    option.text = "Selecione...";
    selects[i].add(option);
}

//2. Alimenta
