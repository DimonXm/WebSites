AOS.init();

document.getElementById("burgerButton").addEventListener("click", function() {
    document.querySelector(".main").classList.toggle("open")
});

function deleteClass() {
    document.querySelector(".main").classList.remove("open");
}