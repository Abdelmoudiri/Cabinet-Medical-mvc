// BURGER MENU
function Menu(e){
    let list = document.querySelector('#links');

    e.name === 'menu' ? (e.name = "close", list.classList.add('left-0'), list.classList.add('opacity-100'), document.body.classList.add('overflow-hidden')) : (e.name = "menu" ,list.classList.remove('left-0'), list.classList.remove('opacity-100'), document.body.classList.remove('overflow-hidden'))
}

// alert('Hello');


// SIGNUP SWITCH ROLE
const selectRole = document.getElementById('role');
const infosAvocat = document.getElementById('infos-avocat-signup');
if(selectRole){
    selectRole.addEventListener('change', function(){
        let choixRole = selectRole.value;
        console.log(choixRole);

        if(choixRole === "Avocat"){
            infosAvocat.classList.remove('hidden');
        }else{
            infosAvocat.classList.add('hidden');
        }
    });
}


// REGEX VALIDATION
function validateName(name) {
    var regex = /^[a-zA-Z\s]{2,30}$/;
    return regex.test(name);
}

function validateEmail(email) {
    var regex = /^[a-zA-Z0-9._-]+@[a-zA-Z]+\.[a-zA-Z]{2,}$/;
    return regex.test(email);
}

function validatePassword(password) {
    var regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
    return regex.test(password);
}

function validateBiography(biography) {
    var regex = /^.{10,500}$/;
    return regex.test(biography);
}

function validateExperience(experience){
    if(experience<1 || experience>50){
        return false;
    }
    return true;
}


const signup = document.querySelector('#signup-form');

if(signup){
    signup.addEventListener('submit', function (e) {
        const nom = document.getElementById('nom').value.trim();
        const prenom = document.getElementById('prenom').value.trim();
        const email = document.getElementById('signup_email').value.trim();
        const password = document.getElementById('password').value.trim();
        const biography = document.getElementById('biography').value.trim();
        const experience = document.getElementById('experience').value;
        const role = document.getElementById('role').value;


        let isValid = true ;


        if(role === 'Client'){
            if (!validateName(nom)) {
                document.getElementById('invalid-nom').classList.remove('hidden');
                isValid = false;
            }
        
            if (!validateName(prenom)) {
                document.getElementById('invalid-prenom').classList.remove('hidden');
                isValid = false;
            }
        
            if (!validateEmail(email)) {
                document.getElementById('invalid-email').classList.remove('hidden');
                isValid = false;
            }
        
            if (!validatePassword(password)) {
                document.getElementById('invalid-password').classList.remove('hidden');
                isValid = false;
            }
        }else{
            if (!validateName(nom)) {
                document.getElementById('invalid-nom').classList.remove('hidden');
                isValid = false;
            }
        
            if (!validateName(prenom)) {
                document.getElementById('invalid-prenom').classList.remove('hidden');
                isValid = false;
            }
        
            if (!validateEmail(email)) {
                document.getElementById('invalid-email').classList.remove('hidden');
                isValid = false;
            }
        
            if (!validatePassword(password)) {
                document.getElementById('invalid-password').classList.remove('hidden');
                isValid = false;
            }
        
            if (!validateBiography(biography)) {
                document.getElementById('invalid-bio').classList.remove('hidden');
                isValid = false;
            }
        
            experienceIsValid = validateExperience(experience);
        
            if(!experienceIsValid){
                document.querySelector('#invalid-exp').classList.add('text-red-500');
                document.querySelector('#invalid-exp').classList.remove('text-white');
                isValid = false;
            }
        }

        if (!isValid) {
            e.preventDefault();
        }
    });
}



const bookingForm = document.getElementById('booking-form');
const bookingPopup = document.getElementById('booking-popup');
const openBookingPopup = document.getElementById('open-booking-popup')
const confirmBooking = document.getElementById('confirm-book');
const cancelBooking = document.getElementById('cancel-book');


openBookingPopup.addEventListener('click', function(){
    bookingPopup.classList.remove('hidden');
});

cancelBooking.addEventListener('click', function(){
    bookingPopup.classList.add('hidden');
    bookingForm.reset();
});