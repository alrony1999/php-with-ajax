<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Php With Ajax</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <table id="main" cellspacing="0">
        <tr>
            <td id="header">
                <h1>PHP & Ajax Curd</h1>
                <div id="search-bar">
                    <input type="text" id="search" placeholder="Search" autocomplete="off">
                </div>
            </td>
        </tr>
        <tr>
            <td id="table-form">
                <form id="addForm">
                    <div class="group">
                        First Name <input type="text" name="fname" id="fname"><br>
                    </div>
                    <div class="group">
                        Last Name <input type="text" name="lname" id="lname"><br>
                    </div>

                    <input type="submit" class="group" id="save-button" value="save">
                </form>
            </td>
        </tr>
        <tr>
            <td id="table-data">

            </td>

        </tr>

    </table>

    <div id="error-message"></div>
    <div id="success-message"></div>
    <div id="modal">
        <div id="modal-form">
            <h2>Edit Form</h2>
            <table cellpading="10px" width="100%">

            </table>
            <div id="close-btn">X</div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="js/app.js"></script>
</body>

</html>