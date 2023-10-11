//1. Adiciona empty optin to selects
var selects = document.getElementsByTagName("select");

for (i = 0; i < selects.length; i++) {
    var option = document.createElement("option");
    option.text = "Selecione...";
    selects[i].add(option);
}
