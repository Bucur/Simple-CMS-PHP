<!DOCTYPE HTML>
<html>
<head>
    <title>PDO ­ Create a Record ­ PHP CRUD Tutorial</title>
    <link rel="stylesheet" href="libs/bootstrap­3.3.6/css/bootstrap.min.css" />
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
   
</head>
<body>

<div class="container">
       
        <div class="page­header">
            <h1>Create Product</h1>
        </div>
   

<form action='create.php' method='post'>
    <table class='table table­hover table­responsive table­bordered'>
        <tr>
            <td>Name</td>
            <td><input type='text' name='name' class='form­control'/></td>
        </tr>
        <tr>
            <td>Description</td>
            <td><textarea name='description' class='form­control'></textarea></td>
        </tr>
        <tr>
            <td>Price</td>
            <td><input type='text' name='price' class='form­control'/> </td>
        </tr>
        <tr>
            <td></td>
            <td>
                <input type='submit' value='Save' class='btn btn­ primary' />
                <a href='read.php' class='btn btn ­danger'>Back to read products</a>
            </td>
        </tr>
    </table>
</form>

</div>

<script src="libs/jquery­3.0.0.min.js"></script>
<script src="libs/bootstrap­3.3.6/js/bootstrap.min.js"></script>
</body>
</html>