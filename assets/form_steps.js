document.addEventListener("DOMContentLoaded", function(){

    const addTagFormDeleteLink = (item) => {
        const removeFormButton = document.createElement('button');
        removeFormButton.innerText = 'Delete this tag';

        item.append(removeFormButton);

        removeFormButton.addEventListener('click', (e) => {
            e.preventDefault();
            // remove the li for the tag form
            item.remove();
        });
    }

    const addFormToCollection = (e) => {
        const collectionHolder = document.querySelector('.' + e.currentTarget.dataset.collectionHolderClass);

        const item = document.createElement('li');
        item.innerHTML = collectionHolder.dataset.prototype.replace(/__name__/g,collectionHolder.dataset.index);

        collectionHolder.appendChild(item);
        addTagFormDeleteLink(item);

        collectionHolder.dataset.index++;
    };

    document.querySelectorAll('ul.documents li').forEach((document) => {
        addTagFormDeleteLink(document)
    })

    document.querySelectorAll('.add_item_link')
    .forEach(btn => {
        btn.addEventListener("click", addFormToCollection)
    });
})


const prevBtns = document.querySelectorAll(".btn-prev");
const nextBtns = document.querySelectorAll(".btn-next");
const progress = document.getElementById("progress");
const formSteps = document.querySelectorAll(".form-step");
const progressSteps = document.querySelectorAll(".progress-step");
const secondNext = document.querySelector(".secondNext");
let formStepsNum = 0;
nextBtns.forEach((btn) => {
    btn.addEventListener("click", () => {
        formStepsNum++;
        updateFormSteps();
        updateProgressbar();
  
});
});
    prevBtns.forEach((btn) => {
    btn.addEventListener("click", () => {
        formStepsNum--;
        updateFormSteps();
        updateProgressbar();
    });
    });
    function updateFormSteps() {
    formSteps.forEach((formStep) => {
        formStep.classList.contains("form-step-active") &&
        formStep.classList.remove("form-step-active");
    });
    formSteps[formStepsNum].classList.add("form-step-active");
    }
    function updateProgressbar() {
    progressSteps.forEach((progressStep, idx) => {
        if (idx < formStepsNum + 1) {
        progressStep.classList.add("progress-step-active");
        } else {
        progressStep.classList.remove("progress-step-active");
        }
    });
    const progressActive = document.querySelectorAll(".progress-step-active");
    progress.style.width =
        ((progressActive.length - 1) / (progressSteps.length - 1)) * 100 + "%";
    }