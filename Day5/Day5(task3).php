<!DOCTYPE html>
<html>
    <head>
        <title>Task 3</title>
        <link href="css/bootstrap.css" rel="stylesheet">
    </head>
    <body class="bg-success">
        <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
            <form class="mx-auto p-4 border rounded bg-white p-3" style="width: 400px;" method="GET" action="Day5(task3-part2).php">
                <h4 class="text-center mb-4">User Information</h4>
                <div class="mb-3">
                    <label for="fullname" class="form-label" >Full Name</label>
                    <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Jane Doe" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="example@gmail.com" required>
                </div>
                
                <div class="mb-3">
                    <label for="age" class="form-label">Age</label>
                    <input type="number" class="form-control" id="age" name="age" placeholder="20" required min="1">
                </div>
                <div class="mb-3">
                    <label for="city" class="form-label">City</label>
                    <input type="text" class="form-control" id="city" placeholder="City" name="city" aria-label="City" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Submit</button>
            </form>         
        </div>
    </body>
</html>
