let select = document.querySelector('#ric_applicationType');
let prescriberFields = document.querySelectorAll('.prescriber');

//console.log(select, prescriberFields);

function showFields() {
    if(select.value === "prescrite") {
        prescriberFields.forEach((element) => element.classList.remove('d-none'));
    } else {
        prescriberFields.forEach((element) => element.classList.add('d-none'));
    }
}

select.addEventListener('change', showFields);