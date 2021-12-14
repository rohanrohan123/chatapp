<?php
session_start();

// $_SESSION["name"] = "Rohan";
// echo $_SESSION["name"];

include('./conection.php');
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<style>
body {
  margin: 0 auto;
  max-width: 800px;
  padding: 0 20px;
}

.container {
  border: 2px solid #dedede;
  background-color: #f1f1f1;
  border-radius: 5px;
  padding: 10px;
  margin: 10px 0;
}

.darker {
  border-color: #ccc;
  background-color: #ddd;
}

.container::after {
  content: "";
  clear: both;
  display: table;
}

.container img {
  float: left;
  max-width: 60px;
  width: 100%;
  margin-right: 20px;
  border-radius: 50%;
}

.container img.right {
  float: right;
  margin-left: 20px;
  margin-right:0;
}

.time-right {
  float: right;
  color: #aaa;
}

.time-left {
  float: left;
  color: #999;
}
</style>
</head>
<body>

<h2>Chat Messages</h2>

<div id="mydatashow">



<div>

</div>
</div>  


<form action="" method="post" id="myform">
<div class="mb-3">
  <label for="exampleFormControlTextarea1" class="form-label">Enter Messages</label>
  <textarea class="form-control" id="msginput" rows="3" style="white-space: pre-wrap;"></textarea>
</div>



  <input type="submit" value="Submit" id="btn" name="btn" class="btn btn-primary mb-5">


</form>
 


  <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script> -->


<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

 <!-- <script src="jqajax.js"></script>  -->
<script type ="text/JavaScript">
$(document).ready(function () {

//data retrive
function showdata() {
    output = "";
    $.ajax({
        url: "retrieve.php",
        method: "GET",
        dataType: "json",
        success: function (data) {
            // console.log(data);
            if (data) {
                x = data;
            } else {
                x = "";
            }
            for (i = 0; i < x.length; i++) {

                output += '<div class="container">';
                if (x[i].name == "Rohan") {
                    output += '<img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/195612/chat_avatar_01.jpg" alt="Avatar" style="width:100%;" />';
                } else {
                    output += '<img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/195612/chat_avatar_02.jpg" alt="Avatar" class="right" style="width:100%;"></img>';
                }
                if (x[i].active == 1) {
                    output += '<span class="link-primary">Active</span>';
                } else {
                    output += '<span class="link-secondary">Offline</span>';
                }
                output += '<h4>' + x[i].name + '</h4><p>' + x[i].msg + '</p><span class="time-right">' + x[i].time + '</span></div>';


                // output += '<div class="container darker"><h4>' + x[i].name + '</h4><p>' + x[i].msg + '</p><span class="time-left">' + x[i].time + '</span></div>';



                // console.log(x[i].name);

            }
            $("#mydatashow").html(output);



        }
    })
}


setInterval(function () {
    showdata() // this will run after every 1 seconds
}, 1000);


$("#btn").click(addmsg);



function addmsg(e) {

    e.preventDefault();
    let msgtext = $("#msginput").val();
    //console.log(msgtext);
    msgtext = msgtext.replace(/\n/g, '<br/>');
    // console.log("str2="+str2);
    mydata = { msgtext: msgtext }


    $.ajax({
        type: "POST",
        url: "insert.php",
        data: JSON.stringify(mydata),
        success: function (data) {
            // alert("sucess");
            console.log(data);
            showdata();
            $("#myform")[0].reset();
        }
    });




}
});
window.onbeforeunload = function () {
  let id=12;
  mydata={sid:id};
  $.ajax({
            type: "POST",
            url: "update.php",
            data: JSON.stringify(mydata),
            
        });
       //return alert("Do you really want to close?");
// return "Do you really want to close?";
}
</script>

</body>
</html>
<!-- window.onbeforeunload = function () {
    return "Do you really want to close?";
}; -->