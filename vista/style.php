<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Calendario de Imágenes</title>

    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .barra-meses {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-bottom: 20px;
        }

        .barra-meses a {
            text-decoration: none;
        }

        .btn-mes {
            padding: 8px 14px;
            border: 1px solid #ccc;
            background: #f2f2f2;
            cursor: pointer;
        }

        .btn-activo {
            background: #333;
            color: #fff;
        }

        .galeria {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(160px, 1fr));
            gap: 10px;
        }

        .item img {
            width: 100%;
            border-radius: 6px;
        }

        .fecha {
            font-size: 12px;
            text-align: center;
            margin-top: 5px;
        }
    </style>
</head>