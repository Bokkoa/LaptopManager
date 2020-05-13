// NEUTRAL
function neutral() {
    $("#first").hide();
    $("#asset").val('');
    $(".waiting-section").children().show();
    $('#emp-name').text('');
    $("#employee-image").attr('src', '');
    $("#employee-image").hide();
    $("#emp-name").hide();
    $("#first").siblings().remove();
    $("#emp-name").siblings().remove();
    window.pJSDom[0].pJS.fn.vendors.destroypJS();
    window["pJSDom"] = [];
    particlesJS.load('particles', 'assets/particles.json');
}

// NOT MATCH PARTICLE LOADER
function fail() {
    $("#asset").val('');
    window.pJSDom[0].pJS.fn.vendors.destroypJS();
    window["pJSDom"] = [];
    $("body").css("background-color", "rgba(231, 121, 121, 0.219)");
    particlesJS.load('particles', 'assets/fail.json');

    $(".waiting-section").children().hide();
    $(".bad").slideDown("slow");
    setTimeout(function () {
        $(".bad").fadeOut("slow");
    }, 4000);
    var audio = new Audio('sounds/Fail.mp3');
    audio.play();
    setTimeout(neutral, 5000);
}

//  MATCH PARTICLE LOADER
function success() {
    $("#first").show();
    $("#emp-name").show();
    $("#asset").val('');
    window.pJSDom[0].pJS.fn.vendors.destroypJS();
    window["pJSDom"] = [];
    $("body").css("background-color", "rgba(152, 231, 121, 0.219)");
    particlesJS.load('particles', 'assets/success.json');

    $(".good").slideDown("slow");

    setTimeout(function () {
        $(".good").fadeOut("slow");
    }, 4000);
    var audio = new Audio('sounds/Success.mp3');
    audio.play();
    $(".waiting-section").children().hide();

    setTimeout(neutral, 5000);
}



function getImage(strData, multi) {
    // console.log(strData);
    $.ajax({
        type: 'GET',
        url: 'https://reqres.in/api/users/4',
        dataType: 'json',
        success: function (response) {

            if (response.data.avatar) {
                $("#employee-image").show();
                $("#employee-image").attr('src', response.data.avatar);
            }

        },
        error: function (response) {
            var img_temporary = "https://upload.wikimedia.org/wikipedia/commons/thumb/d/da/Imagen_no_disponible.svg/1024px-Imagen_no_disponible.svg.png"
            $("#employee-image").show();
            $("#employee-image").attr('src', img_temporary);

            VanillaToasts.create({
                title: 'Imagen',
                text: 'No se encontro imagen',
                type: 'error', // success, info, warning, error   / optional parameter
                timeout: 3000 // hide after 5000ms, // optional parameter
            });
        }
    });
}

function createEvent(employee, uid, asset, hostname) {
    //SETUP AJAX
    $.ajaxSetup({
        headers: {
            'X-CSRF-Token': $('meta[name="_token"]').attr('content')
        }
    });

    $.ajax({
        type: 'POST',
        url: 'api/event',
        dataType: 'json',
        data: {
            'entrance': hostname,
            'asset': asset,
            'employee': employee,
            'uid': uid,
        },
    });
}

$(document).ready(function () {

    var hostname = $("#entrancehost").text();

    $("#emp-name").hide();
    $("#employee-image").hide();
    $("#first").hide();


    // Animate loader off screen
    particlesJS.load('particles', 'assets/particles.json', function () { });
    $(".se-pre-con").fadeOut("slow");

    $("#check").submit(function (event) {
        event.preventDefault();
        let asset = $("#asset").val();
        $.ajax({
            type: 'GET',
            url: 'api/asignation/' + asset,
            dataType: 'json',
            success: function (response) {

                getImage();

                if (response.status == "200") {
                    success();

                    var data = response.data;
                    $("#emp-name").text(data[0].employee);

                    createEvent(data[0].employee, data[0].uid, data[0].laptop.asset, hostname);
                } else {
                    fail();
                }

            },
            error: function (error) {
                console.log(error);
                fail();
            }
        });
    });
});
