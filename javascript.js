$("#registerform").submit(function(event){
    // console.log("working");
    //prevents the default php evaluation
    event.preventDefault();
    //collecting data
    var datatopost=$(this).serializeArray();
    // console.log(datatopost);
    //ajax call
    $.ajax({
        url:"signup.php",
        type:"POST",
        data:datatopost,
        success:function(data){
            $("#registermessage").html(data);
        },
        error:function(){
            $("#registermessage").html("<div class='alert alert-danger'>There was an error with the ajax call.Please try again later.</div>");
        }
    });

});
$("#loginform").submit(function(event){
    // console.log("working");
    //prevents the default php evaluation
    event.preventDefault();
    //collecting data
    var datatopost=$(this).serializeArray();
    // console.log(datatopost);
    //ajax call
    $.ajax({
        url:"login.php",
        type:"POST",
        data:datatopost,
        success:function(data){
            if(data=="success")
            {
                window.location="home.php";
            }else{
            $("#loginmessage").html(data);
            }
        },
        error:function(){
            $("#loginmessage").html("<div class='alert alert-danger'>There was an error with the ajax call.Please try again later.</div>");
        }
});
});