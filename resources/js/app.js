const flashMsgElement = document.querySelector(".flash");
if (flashMsgElement) {
    setTimeout(() => flashMsgElement.remove(), 4000);
}

const pswrdInputElements = document.querySelectorAll(
        "form input[type='password']"
    ),
    pwToggler = document.querySelector(".password-toggler");

if (pswrdInputElements && pwToggler) {
    pwToggler.onclick = () => {
        pswrdInputElements.forEach((elem) => {
            elem.type = elem.type == "password" ? "text" : "password";
        });

        let eyeIcon = pwToggler.firstElementChild;
        let eyeOffIcon = pwToggler.lastElementChild;

        if (eyeOffIcon.classList.contains("hidden")) {
            eyeIcon.classList.add("hidden");
            eyeOffIcon.classList.remove("hidden");
        } else {
            eyeIcon.classList.remove("hidden");
            eyeOffIcon.classList.add("hidden");
        }
    };
}

const imgInputElement = document.querySelector("form input[type='file']#image");
if (imgInputElement) {
    imgInputElement.addEventListener("change", function () {
        let files = imgInputElement.files;

        let previewer = document.getElementById("image-preview-container");
        previewer.innerHTML = "";

        for (let i = 0; i < files.length; i++) {
            let img = document.createElement("img");
            img.className =
                "w-24 h-14 p-1 text-[10px] text-red-600 border border-dashed border-emerald-600";

            let parser = document.createElement("p");
            if (files[i].size > 1024 * 1024) {
                parser.innerHTML = "* Image size must be less than (&le;) 1 MB";
                img.alt = parser.textContent;
            } else if (
                !["jpeg", "jpg", "png", "gif", "bmp", "webp"].includes(
                    files[i].type.split("/")[1]
                )
            ) {
                parser.innerHTML = "* Invalid image format";
                img.alt = parser.textContent;
            } else {
                img.src = URL.createObjectURL(files[i]);
            }
            previewer.appendChild(img);
        }
    });
}
const backToTopBtn = document.querySelector("#back-to-top");
if (backToTopBtn) {
    window.onscroll = () => {
        if (
            document.body.scrollTop > 20 ||
            document.documentElement.scrollTop > 20
        ) {
            backToTopBtn.classList.remove("hidden");
        } else {
            backToTopBtn.classList.add("hidden");
        }
    };
    backToTopBtn.addEventListener("click", () => {
        window.scrollTo({ top: 0, behavior: "smooth" });
    });
}

const drpdwnWrpAll = document.querySelectorAll(".dropdown");
if (drpdwnWrpAll) {
    drpdwnWrpAll.forEach((elem) => {
        let drpdwnbtn = elem.querySelector(".dropdown-toggle");
        let drpdwnMenu = elem.querySelector(".dropdown-menu");
        if (drpdwnbtn && drpdwnMenu) {
            drpdwnbtn.addEventListener("click", () => {
                if (drpdwnMenu.classList.contains("hidden")) {
                    drpdwnMenu.classList.remove("hidden");
                } else {
                    drpdwnMenu.classList.add("hidden");
                }
            });
            window.addEventListener("load", () => {
                document.addEventListener("click", (e) => {
                    if (
                        e.target != drpdwnbtn &&
                        e.target.parentElement != drpdwnbtn
                    ) {
                        drpdwnMenu.classList.add("hidden");
                    }
                });
            });
        }
    });
}
