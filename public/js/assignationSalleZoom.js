const csrfToken = document.head.querySelector(
    "[name~=csrf-token][content]"
    ).content;
/*
var roof = null;
var roofSave = null;
var roofPoints = [];

var lines = [];
var lineCounter = 0;
var drawingObject = {};
drawingObject.type = "";
drawingObject.background = "";
drawingObject.border = "";
var remove = false;
var idsBatDrawn = [];
// canvas Drawing
var canvas = new fabric.Canvas('canvas-tools',
    {
        backgroundImage: "./plan/0PlanGeneral.png",
    }
);
var x = 0;
var y = 0;
*/
function Point(x, y) {
this.x = x;
this.y = y;
}
function disableAll(etat){
    console.log("dans grise");
    canvas.forEachObject(function (obj) {

    obj.set("fill", 'rgba(50,50,50,0.2)');

        if (etat)
        {
            obj.set('lockMovementX', true);
            obj.set('lockMovementY', true);

            obj.set('lockScalingX', true);
            obj.set('lockScalingY', true);

            obj.set('lockRotation', true);
            obj.set('hasControls', false);
            obj.set('hasBorders', false);
            obj.set('evented',false);
            obj.set('selectable', false);

        }
        else
        {
            obj.set('lockMovementX', false);
            obj.set('lockMovementY', false);

            obj.set('lockScalingX', false);
            obj.set('lockScalingY', false);

            obj.set('lockRotation', false);
            obj.set('hasControls', true);
            obj.set('hasBorders', true);
            obj.set('evented',true);
            obj.set('selectable', true);

        }
    });

}

$("#draw").click(function () {
    disableAll(true);
if (drawingObject.type == "roof") {
    drawingObject.type = "";
    lines.forEach(function (value, index, ar) {
        canvas.remove(value);
    });
    //canvas.remove(lines[lineCounter - 1]);
    roof = makeRoof(roofPoints);
    canvas.add(roof);
    canvas.renderAll();
} else {
    drawingObject.type = "roof"; // roof type
}
});



fabric.util.addListener(window, 'dblclick', function () {
    disableAll(false);

    drawingObject.type = "";
    lines.forEach(function (value, index, ar) {
        canvas.remove(value);
    });
    //canvas.remove(lines[lineCounter - 1]);
    roof = makeRoof(roofPoints);


    //canvas.add(roof);
    console.log(roofPoints);
    console.log(roof.points);
    console.log("first : " + roof.points[0].x + "," + roof.points[0].y);
    var nom = prompt("nom de la salle ? ");
    ajouterLimiteSalle(nom);
    //$("#modal").toggle();
    console.log("double click");
    //clear arrays
    roofPoints = [];
    lines = [];
    lineCounter = 0;

});
function disableMove(obj)
{
obj.set('lockMovementX', true);
obj.set('lockMovementY', true);

obj.set('lockScalingX', true);
obj.set('lockScalingY', true);

obj.set('lockRotation', true);
obj.set('hasControls', false);
obj.set('hasBorders', false);




}
canvas.on('mouse:down', function (options) {
if (drawingObject.type == "roof") {
    canvas.selection = false;
    setStartingPoint(options); // set x,y
    roofPoints.push(new Point(x, y));
    var points = [x, y, x, y];
    lines.push(new fabric.Line(points, {
        strokeWidth: 3,
        selectable: false,
        stroke: 'red'
    }).setOriginX(x).setOriginY(y));
    canvas.add(lines[lineCounter]);
    lineCounter++;
    canvas.on('mouse:up', function (options) {
        canvas.selection = true;
    });
}
});
canvas.on('mouse:move', function (options) {
if (lines[0] !== null && lines[0] !== undefined && drawingObject.type == "roof") {
    setStartingPoint(options);
    lines[lineCounter - 1].set({
        x2: x,
        y2: y
    });
    canvas.renderAll();
}
});

function setStartingPoint(options) {
var offset = $('#canvas-tools').offset();
x = options.e.pageX - offset.left;
y = options.e.pageY - offset.top;
}

function makeRoof(roofPoints) {

var left = findLeftPaddingForRoof(roofPoints);
var top = findTopPaddingForRoof(roofPoints);
roofPoints.push(new Point(roofPoints[0].x, roofPoints[0].y))
var roof = new fabric.Polyline(roofPoints, {
    fill: 'rgba(255,0,0,0.2)',
    //stroke:'#58c'
    stroke: 'red'
});
roof.set({

    left: left,
    top: top,

});


return roof;
}

function findTopPaddingForRoof(roofPoints) {
var result = 999999;
for (var f = 0; f < lineCounter; f++) {
    if (roofPoints[f].y < result) {
        result = roofPoints[f].y;
    }
}
return Math.abs(result);
}

function findLeftPaddingForRoof(roofPoints) {
var result = 999999;
for (var i = 0; i < lineCounter; i++) {
    if (roofPoints[i].x < result) {
        result = roofPoints[i].x;
    }
}
return Math.abs(result);
}
function sauvegardeImageSalle(idSalle,coordonnees,offset,idBat)
{
    let can = document.getElementById('canvas-tools');
    let ctx = can.getContext('2d');
    let canvasUrl = can.toDataURL("image/jpeg", 0.9);
    $.ajax({
        url: '../storeCoordSalle',
        data: {
            "id": idSalle,
            "offset": offset,
            "coordonnees": coordonnees,
            "idBat" : idBat,
            "monImageBase64": canvasUrl

        },
        headers: {
            "Content-Type": "application/json",
            Accept: "application/json, text-plain, */*",
            "X-CSRF-Token": csrfToken,
            "X-Requested-With": "XMLHttpRequest",
        },
        type: 'POST',
        dataType: 'json',
        success:
                function (donnees, status, xhr) {
                    console.log("ok upload img");

                },
        error:
                function (xhr, status, error) {
                    console.log("param : " + JSON.stringify(xhr));
                    console.log("status : " + status);
                    console.log("error : " + error);
                }
    });

}
function supprimeSalle(id)
{
    //var offset = JSON.stringify({"top": top, "left": left});
    $.ajax({
        url: '../removeSalle',
        data: {
            "id": id
        },
        headers: {
            "Content-Type": "application/json",
            Accept: "application/json, text-plain, */*",
            "X-CSRF-Token": csrfToken,
            "X-Requested-With": "XMLHttpRequest",
        },
        type: 'POST',
        dataType: 'json',
        success:
                function (donnees, status, xhr) {
                    console.log("ok supp");
                },
        error:
                function (xhr, status, error) {
                    console.log("param : " + JSON.stringify(xhr));
                    console.log("status : " + status);
                    console.log("error : " + error);
                }
    });

}

function ajouterLimiteSalleBDD(poly,nom,coordonnees, top, left)
{
    var offset = JSON.stringify({"top": top, "left": left});
    $.ajax({
        url: '../storeCoordSalle',
        data: {
            "nom": nom,
            "offset": offset,
            "coordonnees": JSON.stringify(coordonnees),
            "idBat" : $("#idBat").val()
        },
        headers: {
            "Content-Type": "application/json",
            Accept: "application/json, text-plain, */*",
            "X-CSRF-Token": csrfToken,
            "X-Requested-With": "XMLHttpRequest",
        },
        type: 'POST',
        dataType: 'json',
        success:
                function (donnees, status, xhr) {
                    console.log("ok");
                    poly.set({
                        'id':donnees.id
                    });
                    sauvegardeImageSalle(donnees.id,JSON.stringify(coordonnees),offset,$("#idBat").val());
                },
        error:
                function (xhr, status, error) {
                    console.log("param : " + JSON.stringify(xhr));
                    console.log("status : " + status);
                    console.log("error : " + error);
                }
    });

}



function griseAll()
{
console.log("dans grise");
canvas.forEachObject(function (obj) {
    //canvas.remove(obj) ;
    console.log(obj);
    console.log(obj.type);
    if (obj.type == "polyline")
    {
        obj.set("fill", 'rgba(50,50,50,0.2)');
    }
    if (obj.type == "text")
    {
        obj.set("fill", 'rgba(0,0,0,1)');
    }

    // disableMove(obj);
});
canvas.renderAll();
}
function supprimer()
{
remove = true;
}
//http://192.168.1.45/CodeLouche/Site/AutomatisationInventaire/public/salle/nom/5
function afficherSalles()
{

    var idBat=$("#idBat").val();
    var urlsalles='../../salle/nom/'+idBat;
    console.log("afficher salle  "+idBat);
  //  $.getJSON('../../../salle/nom/'.idBat,
  $.getJSON(urlsalles,
        {

        })
        .done(function (donnees, stat, xhr) {
            $.each(donnees, function (index, ligne) {

                console.log(ligne.coordPoint);
                if (ligne.coordPoint != null && ligne.coordPoint != "null" && ligne.offset != null && ligne.offset != "null")
                {
                    console.log(JSON.parse(ligne.coordPoint));
                    var tabpoints = JSON.parse(ligne.coordPoint);
                    var offset = JSON.parse(ligne.offset);
                    var poly = new fabric.Polyline(tabpoints, {
                        stroke: 'red',
                        fill: 'rgba(255,0,0,0.2)',
                        left: offset.left,
                        top: offset.top,
                        id: ligne.id
                    });
                    var legende = new fabric.Text(ligne.nom, {
                        /*    fontFamily: 'Delicious_500',
                         left: 10,
                         top: 10,*/
                        fontSize: 20,
                        //  textAlign:"left",
                        fill: "#ff0000"
                    });
                    legende.set({

                        left: poly.left,
                        top: poly.top,

                    });

                    poly.on('mouseup', function () {
                        if (remove)
                        {

                            var supp = confirm("voulez vous supprimer cette zone ?");
                            if (supp)
                            {
                                supprimeSalle(this.id);
                                canvas.remove(this);
                                canvas.remove(legende);
                            }

                            remove = false;

                        }
                        else
                        {
                            legende.left = this.left;
                            legende.top = this.top;
                            console.log(this.left + " , " + this.top);
                            legende.setCoords();
                            disableAll(true);
            legende.set({
                fill: "#ff0000"
            });
            this.set({
                fill: 'rgba(255,0,0,0.2)'
            });
                            canvas.renderAll();
                            console.log(JSON.stringify(this.points))
                            sauvegardeImageSalle(this.id,JSON.stringify(this.points),JSON.stringify({"top":this.top,"left":this.left}),$("#idBat").val());
                            disableAll(false);
                            griseAll();
                        }

                    });
                    canvas.add(legende);
                    canvas.add(poly);

                } else {
                    console.log("coord est null");
                }

            });
            griseAll();

        })
        .fail(function (xhr, text, error) {
            console.log("param : " + JSON.stringify(xhr));
            console.log("status : " + text);
            console.log("error : " + error);
        });



}

function ajouterLimiteSalle(nom) {
    griseAll();

    var legende = new fabric.Text(nom, {
        /*    fontFamily: 'Delicious_500',
         left: 10,
         top: 10,*/
        fontSize: 20,
        //  textAlign:"left",
        fill: "#ff0000"
    });
    legende.set({

        left: roof.left,
        top: roof.top,

    });








    roof.on('mouseup', function () {
        console.log("supp : " + remove);
        if (remove)
        {

            var supp = confirm("voulez vous supprimer cette zone ?");
            if (supp)
            {
                //sauvegardeImageSalle(idSalle,nom,coordonnees,offset,idBat)
                //uploadimg(this.id, null, 0, 0);
                supprimeSalle(this.id);
                canvas.remove(this);
                canvas.remove(legende);
            }

            remove = false;

        }
       else
        {
            legende.left = this.left;
            legende.top = this.top;
            console.log(this.left + " , " + this.top);
            legende.setCoords();
            disableAll(true);
            legende.set({
                fill: "#ff0000"
            });
            this.set({
                fill: 'rgba(255,0,0,0.2)'
            });
            canvas.renderAll();
            console.log(JSON.stringify(this.points))
            sauvegardeImageSalle(this.id,JSON.stringify(this.points),JSON.stringify({"top":this.top,"left":this.left}),$("#idBat").val());
            disableAll(false);
            griseAll();
            //uploadimg(this.id, this.points, this.top, this.left);
        }
    });
    //canvas.add(group);

    roof.set({
        fill: 'rgba(255,0,0,0.2)'
    });
    canvas.add(legende);
    canvas.add(roof);
    canvas.renderAll();
    ajouterLimiteSalleBDD(roof,nom,roof.points,roof.top,roof.left);//poly,nom,coordonnees, top, left
    //griseAll();
}


$(document).ready(function () {

// $("#saveimg").click(sauvegadeImg);
//$("#saveimg").click(uploadimg);

$("#supprimer").click(supprimer);
//$("#tst").click(afficherSalles);
afficherSalles();
$("#grise").click(griseAll);
//$("#modalBtn").click(ajouterLimiteBatiment);

});
