<html>
    <head>
        <style>
            table {
                border-collapse: collapse;
            }
            td {
                border: 1px solid #c3c3c3; 
            }
        </style>
    </head>
    <body>

        <p>Новая заявка на заключение контракта:</p>

        <table>
            <tr>
                <td>Имя</td>
                <td><?php echo $name; ?></td>
            </tr>
            <tr>
                <td>Телефон или e-mail</td>
                <td><?php echo $contact; ?></td>
            </tr>
        </table>    

    </body>
</html>
