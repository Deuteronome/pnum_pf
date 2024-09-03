let alertBox = document.querySelector('.alert-custom');
if(alertBox!==null){
    setTimeout(()=>{
        alertBox.style.width = '0';
        setTimeout(()=>{
            alertBox.style.display = 'none';
        }, 2000)
    }, 5000);
}
