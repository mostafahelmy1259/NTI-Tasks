<!DOCTYPE html>
<html>
    <head>
        <title>Task 1</title>
        <link href="css/bootstrap.css" rel="stylesheet">
    </head>
    <body class="container bg-dark">
        <div class="contaier">
            <div class="row mt-5">
                <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">Key</th>
                        <th scope="col">Value</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                        <td><?= "PHP_SELF"?></td>
                        <td><?= $_SERVER['PHP_SELF'] ?></td>
                        </tr>
                        <tr>
                        <td><?= "SERVER_NAME" ?></td>
                        <td><?= $_SERVER['SERVER_NAME']?></td>
                        </tr>
                        <tr>
                        <td><?= "HTTP_HOST"?></td>
                        <td><?= $_SERVER['HTTP_HOST']?></td>
                        </tr>
                        <tr>
                        <td><?= "USER_AGENT"?></td>
                        <td><?= $_SERVER['HTTP_USER_AGENT']?></td>
                        </tr>
                        <tr>
                        <td><?= "REQUEST_METHOD"?></td>
                        <td><?= $_SERVER['REQUEST_METHOD']?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </body>
</html>