const fileName = [
    "1rdc.png",
    "2Brahms.png",
    "3Debussy.png",
    "4Gershwin.png",
    "5Haendel.png",
    "6Pape.png",
    "7Sax.png",
    "8Torres.png",
];

const csrfToken = document.head.querySelector("[name~=csrf-token][content]").content;

const storeInSessionStorage = (key, element) =>
    sessionStorage.setItem(key, JSON.stringify(element));

const getInSessionStorage = (key) => JSON.parse(sessionStorage.getItem(key));

const getData = async (url) => {
    const request = await fetch(url).catch((err) => console.log(err));
    if (request.status === 200) {
        return request.json();
    } else return null;
};


const generateID = () => {
    let arrayId = new Uint32Array(1);
    window.crypto.getRandomValues(arrayId);
    return parseInt(arrayId.join(""), 10);
};

const populateSelect = (select,arr)=>{
    while (select.firstChild) {
        select.removeChild(select.firstChild);
    }
    arr.forEach(element=>{
        let option = document.createElement('option');
        option.setAttribute('value', element);
        option.appendChild(document.createTextNode(element));
        select.appendChild(option);
    })
}

const saveCanvas = ()=> {
    canvases[fileIndex] = canvas.toJSON(["id",'salleID']);
        storeInSessionStorage("canvasesZone",canvases)
        matchObjectSalleAll[fileIndex] = matchObjectSalle;
        storeInSessionStorage("matchSalle",matchObjectSalleAll);
        canvasesPng[fileIndex] = canvas.getObjects().map(el =>{
            fabricObject.push(el.toJSON(['id','salleID']));
            canvas.getObjects().forEach(el => el.visible = false);
            el.visible = true;
            canvas.renderAll();
            return canvas.toDataURL({
                width: canvas.width,
                height: canvas.height,
                left: 0,
                top: 0,
                format: 'png',
           });
        })
        FabricObjectsAll[fileIndex] = fabricObject;
        storeInSessionStorage("objectZone",FabricObjectsAll)
        storeInSessionStorage('pngZone',canvasesPng);
}


const fileIndex = parseInt(window.location.href.split("/").pop(),10) -1;
const closePoly = document.querySelector(".closePoly");
const CheckBoxToggleDrawOrErase = document.querySelector(".inputToggleDraw");
const CheckBoxToggleDrawMode = document.querySelector(".inputToggleDrawMode");
const saveButton = document.querySelector(".enregistrer");
const arrowNext = document.querySelector("#arrowNext");
const arrowPrevious = document.querySelector("#arrowPrevious");
const selectZone = document.querySelector('#select-salle');
const modal = new bootstrap.Modal(document.getElementById('modal'))
const modalBtn = document.querySelector('#modalBtn');
const salle = await getData('../../salle/nom/'+ (fileIndex +1));
const nomSalle = salle.map((el)=>el.nom);
const canvas = new fabric.Canvas("canvasDessin");
const canvases = await getInSessionStorage("canvasesZone") ?? [];
const FabricObjectsAll = await getInSessionStorage("objectZone") ?? [];
const canvasesPng = await getInSessionStorage("pngZone") ?? [];
const matchObjectSalle= [];
const matchObjectSalleAll = await getInSessionStorage("matchSalle") ?? [];

populateSelect(selectZone,nomSalle);



let rect,
    polygone,
    isDown,
    origX,
    origY,
    pointer,
    line,
    originPointer,
    modeDessin = "rect",
    polygonMode,
    pointArray = [],
    circleObjectArray = [],
    lineObjectArray = [],
    fabricObject = FabricObjectsAll[fileIndex] ?? [],
    isDrawingPolygon = false,
    deleteModeEnable = false,
    isObjectSelected = false,
    bgIMGCanvas;

if (canvases[fileIndex] === undefined || canvases[fileIndex]===null){
    fabric.Image.fromURL(`../plan/${fileName[fileIndex]}`, function (oImg) {
        canvas.setBackgroundImage(oImg, canvas.renderAll.bind(canvas), {
            scaleX: canvas.width / oImg.width,
            scaleY: canvas.height / oImg.height
            });

    });
}
else{
    canvas.loadFromJSON(canvases[fileIndex], ()=>canvas.renderAll())
}

if(arrowNext){
    arrowNext.addEventListener("click",()=>{
        saveCanvas();
        window.location.href= `./${(fileIndex+2)}`;

    })
}

if(arrowPrevious){
    arrowPrevious.addEventListener("click",()=>{
        saveCanvas();
        window.location.href= `./${(fileIndex)}`

    })
}

closePoly.addEventListener("click", () => drawPolygon());

CheckBoxToggleDrawOrErase.addEventListener(
    "change",
    (e) => (deleteModeEnable = e.target.checked ? true : false)
);

CheckBoxToggleDrawMode.addEventListener(
    "change",
    (e) => (modeDessin = e.target.checked ? "poly" : "rect")
);

modalBtn.addEventListener("click", () => {
    let obj = salle.find(e=>e.nom === selectZone.value);
    switch (modeDessin) {
        case 'rect':
            matchObjectSalle.push({objID : rect.id,salleID: obj.id})
            break;
        case 'poly':
            matchObjectSalle.push({objID : polygone.id,salleID: obj.id})
            break
        default:
            break;
    }
    console.log(matchObjectSalle);
    canvas.renderAll();
    modal.toggle();

});

if (saveButton){
    saveButton.addEventListener("click", () => {
        saveCanvas();
        let data = canvasesPng.map((el,i)=>{
            return el.map((el,index)=>{
                console.log(matchObjectSalleAll)

                let obj = {'png' : el, 'json' : FabricObjectsAll[i][index],'id' : matchObjectSalleAll[i][index].salleID}
                return obj;
            })
        })
        fetch('../store/zone',{
            method:'PUT',
            body:JSON.stringify(data),
            headers:{
                'Content-Type': 'application/json',
                "Accept": "application/json, text-plain, */*",
                "X-CSRF-Token": csrfToken,
                "X-Requested-With": "XMLHttpRequest",
            }
        }).finally(response => location.href = '../').catch(err=>console.log(err))
    })


}


const addPoint = (o) => {
    let pointer = canvas.getPointer(o.e);
    let circle = new fabric.Circle({
        radius: 6,
        fill: "rgba(255,0,0,0.5)",
        opacity: 0.4,
        stroke: "#333333",
        strokeWidth: 0.5,
        left: pointer.x,
        top: pointer.y,
        selectable: false,
        hasBorders: false,
        hasControls: false,
        originX: "center",
        originY: "center",
    });
    circleObjectArray.push(circle);
    canvas.add(circle);
    if (pointArray.length != 0) {
        let linePoint = [
            pointer.x,
            pointer.y,
            pointArray.at(-1).x,
            pointArray.at(-1).y,
        ];
        line = new fabric.Line(linePoint, {
            strokeWidth: 2,
            fill: "#999999",
            stroke: "#999999",
            class: "line",
            originX: "center",
            originY: "center",
            selectable: false,
            hasBorders: false,
            hasControls: false,
            evented: false,
        });
        canvas.add(line);
        lineObjectArray.push(line);
    }

    pointArray.push({ x: pointer.x, y: pointer.y });
};

const drawPolygon = () => {
    if (pointArray.length > 2){
        polygone = new fabric.Polygon(pointArray, {
            stroke: "#333333",
            strokeWidth: 1,
            fill: "rgba(255,0,0,0.5)",
            hasControls: false,
            id:generateID(),
        });
        canvas.add(polygon);

        circleObjectArray.forEach((element) => {
            canvas.remove(element);
        });
        lineObjectArray.forEach((element) => {
            canvas.remove(element);
        });

        circleObjectArray = [];
        lineObjectArray = [];
        pointArray = [];
        modal.toggle();
    }


};

canvas.on("before:transform", () => {
    isObjectSelected = true;
    if (deleteModeEnable) {
        canvas.getActiveObjects().forEach((obj) => {
            console.log(matchObjectSalle);
            canvas.remove(obj)
            let id = obj.id;
            let i = matchObjectSalle.findIndex(e=>e.objID = id);
            matchObjectSalle.splice(i,1);
            console.log(matchObjectSalle);
          });
          canvas.discardActiveObject().renderAll()
    }
});

canvas.on("before:selection:cleared", () => {
    isObjectSelected = false;
});

canvas.on("mouse:down", (o) => {
    if (!isObjectSelected && !deleteModeEnable) {
        if (modeDessin === "rect") {

            originPointer = canvas.getPointer(o.e);
            origX = originPointer.x;
            origY = originPointer.y;
            isDown = true;
            rect = new fabric.Rect({
                left: origX,
                top: origY,
                originX: "left",
                originY: "top",
                width: 0,
                height: 0,
                angle: 0,
                stroke: "#333333",
                strokeWidth: 1,
                fill: "rgba(255,0,0,0.5)",
                transparentCorners: false,
                id: generateID(),
            });
            canvas.add(rect);
        } else {
            addPoint(o);
        }
    }
});

canvas.on("mouse:move", (o) => {
    if (!isObjectSelected && !deleteModeEnable && modeDessin === "rect") {
        if (!isDown) return;

        pointer = canvas.getPointer(o.e);

        if (origX > pointer.x) {
            rect.set({ left: Math.abs(pointer.x) });
        }
        if (origY > pointer.y) {
            rect.set({ top: Math.abs(pointer.y) });
        }

        rect.set({ width: Math.abs(origX - pointer.x) });
        rect.set({ height: Math.abs(origY - pointer.y) });

        canvas.renderAll();
    }
});

canvas.on("mouse:up", () => {
    if (!isObjectSelected && !deleteModeEnable && modeDessin === "rect") {
        isDown = false;
        if (rect.width < 20 && rect.height < 20){
            canvas.remove(rect);
        }
        else{
            modal.toggle();
        }
    }
});
