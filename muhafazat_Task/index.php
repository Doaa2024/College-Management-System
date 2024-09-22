<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Country Selection</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-4 col-sm-12">
            <div class="form-group">
                <label for="country">Country</label>
                <select id="country" class="form-control">
                    <option>Select a country</option>
                </select>
            </div>
        </div>

        <div class="col-md-4 col-sm-12">
            <div class="form-group">
                <label for="governorate">Governorate</label>
                <select id="governorate" class="form-control" disabled>
                    <option>Select a governorate</option>
                </select>
            </div>
        </div>

        <div class="col-md-4 col-sm-12">
            <div class="form-group">
                <label for="judiciary">Judiciary</label>
                <select id="judiciary" class="form-control" disabled>
                    <option>Select a judiciary</option>
                </select>
            </div>
        </div>
    </div>
</div>


    <script src="script.js"></script>
</body>

</html>