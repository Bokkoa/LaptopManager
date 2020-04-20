// NEUTRAL
function neutral()
{
    $("#first").hide();
    $("#asset").val('');
    $(".waiting-section").children().show();
    $('#emp-name').text('');
    $("#employee-image").attr('src', '');
    $("#employee-image").hide();
    $( "#emp-name" ).hide();
    $( "#first" ).siblings().remove();
    $( "#emp-name" ).siblings().remove();
    window.pJSDom[0].pJS.fn.vendors.destroypJS();
    window["pJSDom"] = [];
    particlesJS.load('particles', 'assets/particles.json');
    $("body").css("background-color", "rgba(black, 0.5)");  
} 

// NOT MATCH PARTICLE LOADER
function fail(){
    $("#asset").val('');
    window.pJSDom[0].pJS.fn.vendors.destroypJS();
    window["pJSDom"] = [];
    $("body").css("background-color", "rgba(231, 121, 121, 0.219)");
    particlesJS.load('particles', 'assets/fail.json');
    
    $(".waiting-section").children().hide();
    $(".bad").slideDown("slow"); 
    setTimeout(function (){
       $(".bad").fadeOut("slow");
    }, 4000);   
    var audio = new Audio('sounds/Fail.mp3');
    audio.play();
    setTimeout(neutral, 5000);
}

//  MATCH PARTICLE LOADER
function success(){
    $("#first").show();
    $( "#emp-name" ).show();
    $("#asset").val('');
    window.pJSDom[0].pJS.fn.vendors.destroypJS();
    window["pJSDom"] = [];
    $("body").css("background-color", "rgba(152, 231, 121, 0.219)");
    particlesJS.load('particles', 'assets/success.json');

    $(".good").slideDown("slow"); 
    setTimeout(function (){
    $(".good").fadeOut("slow");
    }, 4000);   
    var audio = new Audio('sounds/Success.mp3');
    audio.play();
    $(".waiting-section").children().hide();
 
    setTimeout(neutral, 5000);
}



function getImage(strData, multi)
{
    // console.log(strData);
    $.ajax({
              type: 'GET',
              url: 'getimage',
              dataType: 'json',
              data: {
                "_token": "{{ csrf_token() }}",
                code: strData
              },
              success: function(data) {
                if(multi == 0){
                $("#employee-image").show();
                $("#employee-image").attr('src', 'data:image/jpeg;base64,' + data);
                }
                else{
                    $(".imgs-section").append('<div class="card"><img width="40%" id="employee-image'+multi+'" class="shadow-lg rounded " src=""></div>');
                    $("#employee-image"+multi).attr('src', 'data:image/jpeg;base64,' + data);        
                }
               
              },
              error: function(response)
              {
               var img_temporary = "https://upload.wikimedia.org/wikipedia/commons/thumb/d/da/Imagen_no_disponible.svg/1024px-Imagen_no_disponible.svg.png"
                if(multi == 0){
                $("#employee-image").show();
                $("#employee-image").attr('src', img_temporary);
                }
                else{
                    $(".imgs-section").append('<div class="card"><img width="40%" id="employee-image'+multi+'" class="shadow-lg rounded " src=""></div>');
                    $("#employee-image"+multi).attr('src', img_temporary);        
                }


            VanillaToasts.create({
              title: 'Imagen',
              text: 'No se encontro imagen',
              type: 'error', // success, info, warning, error   / optional parameter
              timeout: 3000 // hide after 5000ms, // optional parameter
            });
               }
          });
}

function createEvent(asset, user, uid){
    $.ajax({
            type: 'POST',
            url: 'createevent',
            dataType: 'json',
            data: {
                'asset': asset,
                'user': user,
                'uid': uid,
            },
    });
}

  $( document ).ready(function() {
    $( "#emp-name" ).hide();
    $("#employee-image").hide();
    $("#first").hide();
    
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                } 
             });

         // Animate loader off screen
         particlesJS.load('particles', 'assets/particles.json', function() {});
         $(".se-pre-con").fadeOut("slow");

            $( "#check" ).submit(function( event ) {
                event.preventDefault();
                $.ajax({
                        type: 'POST',
                        url: 'checking',
                        dataType: 'json',
                        data: $("form").serialize(),
                        success: function(data) { 
                            console.log(data); 
                            if(data == false)
                            {
                                $.ajax({
                                    type:'POST',
                                    url: 'checklaptops',
                                    dataType: 'json',
                                    data:$("form").serialize(),
                                    success: function(data){
                                        if(data == false)
                                        { 
                                            fail();
                                            
                                        }
                                        else{
                                            success();
                                            createEvent(data[0].Lap_Asset, data[0].Lap_Owner, 'N/A');
                                        }
                                    },
                                    error: function(){
                                        fail();
                                    }
                                });       
                            }
                            else{
                                
                                $('#emp-name').text(data.USERNAME+' ( '+data.USERFIRSTNAME+' )');

                                // if(Object.keys(data).length > 1)
                                // {
                                //         // console.log(data);
                                //         $('#emp-name').text(data.USERNAME+' ( '+data.USERFIRSTNAME+' )');
                                //         // getImage(data[0].AS_Emp_Number, 0);
                                //         // for( i = 1; i < Object.keys(data).length; i++)
                                //         // { 
                                //         //     var code = data[i].AS_Emp_Number;
                                //         //     // console.log(code);
                                //         //     $(".names-section").append('<label id="emp-name'+i+'" class="text-light list-group-item bg-oxford"></label>');
                                //         //     getImage(code, i);
                                //         //     $('#emp-name'+i).text(data[i].AS_Employee);
                                //         // }
                                //         // console.log(data[0].AS_Employee);
                                // }
                                // else{
                                //     $('#emp-name').text(data[0].AS_Employee);
                                //         getImage(data[0].AS_Emp_Number);
                                //         // console.log(data); //EC005498
                                      
                                // }
                                createEvent(data.INVENTORYLEASINGID, data.USERNAME+' ( '+data.USERFIRSTNAME+' )', data.USERLOGIN);
                                success();

                            }
                          
                        },
                        error: function(data)
                        {
                            fail();
                        
                        }
                });
            });  
});
