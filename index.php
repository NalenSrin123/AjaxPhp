<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <div class="container-fluid">
        <h1>Employee</h1>
        <button class="btn btn-primary float-end" id="addEmp">Add Employee</button>
        <table class="table table-hover text-center align-middle mt-5" style="table-layout: fixed;">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Sex</th>
                    <th>Position</th>
                    <th>Salary</th>
                    <th>Rate</th>
                    <th>Hour</th>
                    <th>Income</th>
                    <th>Profile</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                include 'connection.php';
                global $connection;
                    $select="SELECT * FROM `employee`";
                    $data=$connection->query($select);
                    while($row=$data->fetch_assoc()){
                       echo '<tr>
                            <td>'.$row['employee_id'].'</td>
                            <td>'.$row['name'].'</td>
                            <td>'.$row['sex'].'</td>
                            <td>'.$row['position'].'</td>
                            <td>'.$row['salary'].'</td>
                            <td>'.$row['rate'].'</td>
                            <td>'.$row['hour'].'</td>
                            <td>'.$row['income'].'</td>
                            <td>
                                <img width="80px" src="./Image/'.$row['profile'].'" alt="">
                            </td>
                            <td>
                                <button class="btn btn-warning me-1">Edit</button>
                                <button class="btn btn-danger">Delete</button>
                            </td>
                        </tr>';
                    }
                ?>
            </tbody>
        </table>
    </div>
    <div class="modals">
        <form action="" method="post" enctype="multipart/form-data">
            <h3 class="text-center">Add Employee</h3>
            <div class="form-group">
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" id="name" class="form-control">
            </div>
            <div class="form-group">
                <label for="sex" class="form-label">Sex</label>
                <select name="sex" id="sex" class="form-control">
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Other">Other</option>
                </select>
            </div>
            <div class="form-group">
                <label for="position" class="form-label">Position</label>
                <select name="position" id="position" class="form-control">
                    <option value="Web Front-end">Web Front-end</option>
                    <option value="Web Back-end">Web Back-end</option>
                    <option value="Mobile App">Mobile App</option>
                    <option value="Design">Design</option>
                    <option value="Network">Network</option>
                    <option value="DevOp">DevOp</option>
                </select>
            </div>
            <div class="form-group">
                <label for="salary" class="form-label">Salary</label>
                <input type="text" name="salary" id="salary" class="form-control">
            </div>
            <div class="form-group">
                <label for="rate" class="form-label">Rate</label>
                <input type="text" name="rate" id="rate" class="form-control">
            </div>
            <div class="form-group">
                <label for="hour" class="form-label">Hour</label>
                <input type="text" name="hour" id="hour" class="form-control">
            </div>
            <div class="form-group">
                <label for="profile" class="form-label">Profile</label>
                <input type="file" name="profile" id="profile" class="form-control d-none"> <br>
                <img id="image" style="cursor: pointer;" width="100px" src="https://media.istockphoto.com/id/1324356458/vector/picture-icon-photo-frame-symbol-landscape-sign-photograph-gallery-logo-web-interface-and.jpg?s=612x612&w=0&k=20&c=ZmXO4mSgNDPzDRX-F8OKCfmMqqHpqMV6jiNi00Ye7rE=" alt="">
               <input type="text" name="" id="images" class="d-none">
            </div>
            <div class="form-group d-flex justify-content-end">
                <button type="button" class="btn btn-primary mt-4 me-2" id="btnSave">Save</button>
                <button class="btn btn-danger mt-4" id="btnCancel">Cancel</button>
            </div>
        </form>
    </div>
</body>
</html>
<script>
    $(document).ready(function(){
        $('#addEmp').click(function(){
            $('.modals').fadeIn();
        })
        $('#btnCancel').click(function(){
            $('.modals').fadeOut();
        })
        $('#image').click(function(){
            $('#profile').click();
        })
        $('#profile').change(function(){
            form_data=new FormData(); // create object FormData
            file=$('#profile')[0].files;
            form_data.append('profile',file[0]); // append file to object FormData
            $.ajax({
                url:'moveFile.php',// send file to moveFile.php
                method:'post',// method post (form post)
                data:form_data,// send object FormData
                contentType:false, // set contentType to false
                processData:false,
                cache:false,
                success:function(image){
                    $('#image').attr('src','./Image/'+image); //change attribute src of image
                    $('#images').val(image)
                }
            })    
        })
        $('#btnSave').click(function(){
            $('.modals').fadeOut()
            const name=$('#name').val();
            const sex=$('#sex').val();
            const position=$('#position').val();
            const salary=$('#salary').val();
            const rate=$('#rate').val();
            const hour=$('#hour').val();
            const profile=$('#images').val();
            const income=Number(salary)+Number(rate*hour);
            $.ajax({
               url:'insert.php',
               method:'post',
               data:{
                  emp_name:name,
                  emp_sex:sex,
                  emp_position:position,
                  emp_salary:salary,
                  emp_rate:rate,
                  emp_hour:hour,
                  emp_profile:profile  
               },
               cache:false,
               success:function(respone){
                    $('tbody').append(`
                        <tr>
                            <td>${respone}</td>
                            <td>${name}</td>
                            <td>${sex}</td>
                            <td>${position}</td>
                            <td>${salary}</td>
                            <td>${rate}</td>
                            <td>${hour}</td>
                            <td>${income}</td>
                            <td>
                                <img width="80px" src="./Image/${profile}" alt="">
                            </td>
                            <td>
                                <button class="btn btn-warning me-1">Edit</button>
                                <button class="btn btn-danger">Delete</button>
                            </td>
                        </tr>
                    `);
               } 
            })
        })      
    })
</script>