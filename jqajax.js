//insert data
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
        console.log(msgtext);
        mydata = { msgtext: msgtext }
         console.log(mydata);
         
        $.ajax({
            type: "POST",
            url: "insert.php",
            data:JSON.stringify(mydata),
            success: function (data) {
                // alert("sucess");
                showdata();
                $("#myform")[0].reset();
            }
        });




    }
});