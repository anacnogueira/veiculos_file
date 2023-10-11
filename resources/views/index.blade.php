<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabela Fipe Veículos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
</head>
<body>
    <div class="container">
        <h1>Pesquisa de veiculos</h1>
        <form>
            <div class="row mb-3">
                <label for="brands" class="col-sm-2 col-form-label">Marca</label>
                <div class="col-sm-10">
                    <select class="form-select" id="brands">                        
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <label for="models" class="col-sm-2 col-form-label">Modelo</label>
                <div class="col-sm-10">
                    <select class="form-select" id="models">                       
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <label for="year" class="col-sm-2 col-form-label">Marca</label>
                <div class="col-sm-10">
                    <select class="form-select" id="year">
                    </select>
                </div>
            </div>
             <button id="send" type="submit" class="btn btn-primary" disabled>Pesquisar</button>
        </form>
        <br>
        <div class="d-grid gap-2 d-md-block">
            <button class="btn btn-success" type="button" id="xlsx_export"> Exportar XLSX</button>
            <button class="btn btn-danger" type="button" id="pdf_export">Exportar PDF</button>
        </div>

        <table id="vehicles" class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Tipo</th>
                    <th scope="col">Valor</th>
                    <th scope="col">Marca</th>
                    <th scope="col">Modelo</th>
                    <th scope="col">Ano</th>
                    <th scope="col">Comnustível</th>
                </tr>
            </thead>
            <tbody class="table-group-divider"></tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script   src="https://code.jquery.com/jquery-3.7.1.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="{{ asset('js/filter.js') }}"></script>
    </body>
</html>