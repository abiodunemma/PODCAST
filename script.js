const effect = document.querySelector('.effect');
const buttons = document.querySelectorAll('.navbar button:not(.plus)');

buttons.forEach(button => {

    button.addEventListener('click', e => {

        const x = e.target.offsetLeft;

        buttons.forEach(btn => {
            btn.classList.remove('active');
        })

        e.target.classList.add('active');

        anime({
            targets: '.effect',
            left: `${x}px`,
            opacity: '1',
            duration: 600
        })

    })

})

let navbar = document.querySelector('.header .navbar');

document.querySelector('#menu-btn').onclick = () =>{
    navbar.classList.toggle('active');
}

window.onscroll = () =>{
    navbar.classList.remove('active');
}

document.querySelectorAll('input[type="number"]').forEach(inputNumber =>{
  inputNumber.oninput = () =>{
    if(inputNumber. value.length > inputNumber.maxLength) inputNumber.Value
    = inputNumber.Value.slice(0, inputNumber.maxLength);
};
});
