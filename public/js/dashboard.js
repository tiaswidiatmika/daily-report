document.getElementById('arrival-option').style.display = 'none';
document.getElementById('departure-option').style.display = 'none';
const arrivalSection = document.getElementById('arrival-section');
const departureSection = document.getElementById('departure-section');

arrivalSection.addEventListener('click',  e => toggle(e, 'arrival-option', 'departure-option') );
departureSection.addEventListener('click',  e => toggle(e, 'departure-option', 'arrival-option') );

document.addEventListener('click', clickOutsideBlock);

function clickOutsideBlock (e) {
    if ( e.target.className !== 'single-section-container' && e.target.className !== 'section-option' ){
        document.querySelectorAll('.section-option').forEach(element => element.style.display = 'none');
    }
}

function toggle(e, activeBlock, inactiveBlock) {
    e.stopPropagation();
    activeBlock = document.getElementById(activeBlock);
    inactiveBlock = document.getElementById(inactiveBlock);
    inactiveBlock.style.display = 'none';
    if (activeBlock.style.display === 'block') {
        activeBlock.style.display = 'none';
        return;
    }
    activeBlock.style.display = 'block';
}