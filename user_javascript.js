    let userProfile = document.querySelector('.user_profile');
    let userInfo = document.querySelector('.user_info')
    userProfile.addEventListener('click', () => {
        
        userInfo.classList.toggle('active');
    })

    let alertBtn = document.querySelector('.alert');
    let clostBtn = document.querySelector('.close_btn');
    clostBtn.addEventListener('click',() => {
        alert.style.display = "none";
    })

   