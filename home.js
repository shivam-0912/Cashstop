$("#updateinfoform").submit(function(event){
    // console.log("working");
    //prevents the default php evaluation
    event.preventDefault();
    //collecting data
    var datatopost=$(this).serializeArray();
    // console.log(datatopost);
    //ajax call
    $.ajax({
        url:"updateinfo.php",
        type:"POST",
        data:datatopost,
        success:function(data){
            $("#updateinfomessage").html(data);
        },
        error:function(){
            $("#updateinfomessage").html("<div class='alert alert-danger'>There was an error with the ajax call.Please try again later.</div>");
        }
    });

});
$("#newconnectform").submit(function(event){
    // console.log("working");
    //prevents the default php evaluation
    event.preventDefault();
    //collecting data
    var datatopost=$(this).serializeArray();
    // console.log(datatopost);
    //ajax call
    $.ajax({
        url:"newconnect.php",
        type:"POST",
        data:datatopost,
        success:function(data){
            $("#newconnectmessage").html(data);
        },
        error:function(){
            $("#newconnectmessage").html("<div class='alert alert-danger'>There was an error with the ajax call.Please try again later.</div>");
        }
    });

});



 $(".acceptc").click(function(){
            
            var acceptcButton = $(this);
            //console.log(acceptcButton.parent().attr("id"));
            //send ajax call to delete note
            $.ajax({
                url: "acceptconnection.php",
                type: "POST",
                //we need to send the id of the note to be deleted
                data: {id:acceptcButton.parent().attr("id")},
                success: function (data){
                    if(data == 'error'){
                        alert("An error occured.Please try again!");
                    
                    }else{
                        //remove containing div
                        // console.log("delete workking");
                        acceptcButton.parent().parent().remove();
                    }
                },
                error: function(){
                    alert("There was an error with the Ajax Call. Please try again later.");
                    
                }

            });
            
        });
 $(".rejectc").click(function(){
            
            var rejectcButton = $(this);
            //console.log(acceptcButton.parent().attr("id"));
            //send ajax call to delete note
            $.ajax({
                url: "rejectconnection_ok.php",
                type: "POST",
                //we need to send the id of the note to be deleted
                data: {id:rejectcButton.parent().attr("id")},
                success: function (data){
                    if(data == 'error'){
                        alert("An error occured.Please try again!");
                    
                    }else{
                        //remove containing div
                        // console.log("delete workking");
                        rejectcButton.parent().parent().remove();
                    }
                },
                error: function(){
                    alert("There was an error with the Ajax Call. Please try again later.");
                    
                }

            });
            
        }); 
        
        
 $(".ok").click(function(){
            
            var okButton = $(this);
            //console.log(acceptcButton.parent().attr("id"));
            //send ajax call to delete note
            $.ajax({
                url: "rejectconnection_ok.php",
                type: "POST",
                //we need to send the id of the note to be deleted
                data: {id:okButton.parent().attr("id")},
                success: function (data){
                    if(data == 'error'){
                        alert("An error occured.Please try again!");
                    
                    }else{
                        //remove containing div
                        // console.log("delete workking");
                        okButton.parent().parent().remove();
                    }
                },
                error: function(){
                    alert("There was an error with the Ajax Call. Please try again later.");
                    
                }

            });
            
        });         
$("#transactform").submit(function(event){
    // console.log("working");
    //prevents the default php evaluation
    event.preventDefault();
    //collecting data
    var datatopost=$(this).serializeArray();
    // console.log(datatopost);
    //ajax call
    $.ajax({
        url:"transactamount.php",
        type:"POST",
        data:datatopost,
        success:function(data){
            $("#transactmessage").html(data);
        },
        error:function(){
            $("#transactmessage").html("<div class='alert alert-danger'>There was an error with the ajax call.Please try again later.</div>");
        }
    });

});





 $(".acceptp").click(function(){
            
            var acceptpButton = $(this);
            //console.log(acceptcButton.parent().attr("id"));
            //send ajax call to delete note
            $.ajax({
                url: "acceptpay.php",
                type: "POST",
                //we need to send the id of the note to be deleted
                data: {id:acceptpButton.parent().attr("id")},
                success: function (data){
                    if(data == 'error'){
                        alert("An error occured.Please try again!");
                    
                    }else{
                        //remove containing div
                        // console.log("delete workking");
                        acceptpButton.parent().parent().remove();
                    }
                },
                error: function(){
                    alert("There was an error with the Ajax Call. Please try again later.");
                    
                }

            });
            
        });
 $(".rejectp").click(function(){
            
            var rejectpButton = $(this);
            //console.log(acceptcButton.parent().attr("id"));
            //send ajax call to delete note
            $.ajax({
                url: "rejectpay.php",
                type: "POST",
                //we need to send the id of the note to be deleted
                data: {id:rejectpButton.parent().attr("id")},
                success: function (data){
                    if(data == 'error'){
                        alert("An error occured.Please try again!");
                    
                    }else{
                        //remove containing div
                        // console.log("delete workking");
                        rejectpButton.parent().parent().remove();
                    }
                },
                error: function(){
                    alert("There was an error with the Ajax Call. Please try again later.");
                    
                }

            });
            
        }); 
        