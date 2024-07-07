import "./bootstrap";


window.data = function (elemen, attr_name) {
    return elemen.getAttribute("data-" + attr_name);
};

document.querySelectorAll('img').forEach(element => {
    element.setAttribute('draggable', false);
});

