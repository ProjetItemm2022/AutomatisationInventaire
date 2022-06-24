const csrfToken = document.head.querySelector(
    "[name~=csrf-token][content]"
    ).content;
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
/*var canvas = new fabric.StaticCanvas('canvas-tools',
    {
        backgroundImage: "./plan/0PlanGeneral.png",
    }
);*/
var x = 0;
var y = 0;

function Point(x, y) {
this.x = x;
this.y = y;
}


$("#draw").click(function () {
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


fabric.util.addListener(window, 'click', function (options) {

    console.log("click");
    if (options.target) {
        console.log('an object was clicked! ', options.target.type);
    }


});

fabric.util.addListener(window, 'dblclick', function () {
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
    //var nom = prompt("nom ? ");
    $("#modal").toggle();
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
    obj.set('hasBorders', true);




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
            console.log("mouse up canvas");
            if (options.target) {
                console.log('an object was clicked! ', options.target.type);
            }
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


function uploadimg(id, coordonnees, top, left)
{
//nomFichier = "img" + Date.now();
//console.log("nom du fichier : " + nomFichier);

let can = document.getElementById('canvas-tools');
let ctx = can.getContext('2d');
console.log("id : " + id);
console.log("coordonnees : " + JSON.stringify(coordonnees));

let canvasUrl = can.toDataURL("image/jpeg", 0.5);
var nom = $("#select-batiment option[value=" + id + "]").text();
var offset = JSON.stringify({"top": top, "left": left});
$.ajax({
    url: '../assignation/storeCoordBatiment',
    data: {
        "id": id,
        "nom": nom,
        "offset": offset,
        "coordonnees": JSON.stringify(coordonnees),
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
                console.log("ok");
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

function ajoutAreaMap(id,offsetX,offsetY,tabpoints)
{
    var points="";
    var i=0;
    console.log("offsetX : "+offsetX);
    console.log("offsetY : "+offsetY);
    console.log("tabpoints : "+JSON.stringify(tabpoints));
    console.log("id : "+id);
    tabpoints.forEach(point => {
        var x=Math.round(parseFloat(point.x)+parseFloat(offsetX));
        var y=Math.round(parseFloat(point.y)+parseFloat(offsetY));
        if (i==0)
        {
            points=points+x+","+y;
        }
        else
        {
            points=points+","+x+","+y

        }
        i++;
    });
    console.log(points);


}

function afficherBatiments()
{
$.getJSON('../batiment/nom',
        {

        })
        .done(function (donnees, stat, xhr) {

            $.each(donnees, function (index, ligne) {

                if (ligne.coordPoint != null && ligne.coordPoint != "null" && ligne.offset != null && ligne.offset != "null")
                {
                    console.log(JSON.parse(ligne.coordPoint));
                    var tabpoints = JSON.parse(ligne.coordPoint);
                    var offset = JSON.parse(ligne.offset);
                    var poly = new fabric.Polyline(tabpoints, {
                        stroke: 'red',
                        fill: 'rgba(50,50,50,0.2)',
                        left: offset.left,
                        top: offset.top,
                        id: ligne.id,
                        evented:true

                    });
                    var legende = new fabric.Text(ligne.nom, {
                        /*    fontFamily: 'Delicious_500',
                         left: 10,
                         top: 10,*/
                        fontSize: 20,
                        //  textAlign:"left",
                        fill: "#000000"
                    });
                    legende.set({

                        left: poly.left,
                        top: poly.top,

                    });

                    poly.on('mouseup', function () {
                       console.log(this.id);
                    });
                    disableMove(legende);
                    disableMove(poly);
                    canvas.add(legende);
                    canvas.add(poly);
                    ajoutAreaMap(ligne.id,offset.left,offset.top,tabpoints);

                } else {
                    console.log("coord est null");
                }

            });

        })
        .fail(function (xhr, text, error) {
            console.log("param : " + JSON.stringify(xhr));
            console.log("status : " + text);
            console.log("error : " + error);
        });



}

function ajouterLimiteBatiment() {


var nom = $("#select-batiment :selected").text();
var idBat = $("#select-batiment :selected").val();
if (idBat != "-1" && idBat != -1)
{
    console.log("nom : " + nom + " id : " + idBat);
    //idsBatDrawn.push(idBat);
    $("#select-batiment option[value=" + idBat + "]").hide();
    // on se repositionne sur le 1er element de la liste
    //$("#select-batiment").prop("selectedIndex",-1);
    $("#select-batiment").val("-1");

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



    uploadimg(idBat, roof.points, roof.top, roof.left);
    roof.set({id: idBat});


    griseAll();

    roof.on('mouseup', function () {
        console.log("supp : " + remove);
        if (remove)
        {

            var supp = confirm("voulez vous supprimer cet zone :" + $("#select-batiment option[value=" + this.id + "]").text() + "?");
            if (supp)
            {
                $("#select-batiment option[value=" + this.id + "]").show();
                uploadimg(this.id, null, 0, 0);
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
        canvas.renderAll();
        console.log(JSON.stringify(this.points))
        uploadimg(this.id, this.points, this.top, this.left);
        }
    });
    //canvas.add(group);

    canvas.add(legende);
    canvas.add(roof);
    canvas.renderAll();
    $("#modal").toggle();
}

}
$(document).ready(function () {


// $("#saveimg").click(sauvegadeImg);
//$("#saveimg").click(uploadimg);
//$("#grise").click(griseAll);
//$("#supprimer").click(supprimer);

    afficherBatiments();

//$("#modalBtn").click(ajouterLimiteBatiment);

});
