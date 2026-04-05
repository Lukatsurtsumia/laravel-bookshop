     const book = document.getElementById("book");
    const cover = document.getElementById("cover");
    const pageContent = document.getElementById("pageContent");

    let isOpen = false;

    book.addEventListener("click", function () {
        isOpen = !isOpen;

        if (isOpen) {
            cover.style.transform = "rotateY(-165deg)";
            pageContent.style.opacity = "1";
        } else {
            cover.style.transform = "rotateY(0deg)";
            pageContent.style.opacity = "0";
        }
    });
 