function checkpass()
{
    if(document.signup.pass.value!=document.signup.confirmpass.value)
    {
        alert('Passwords must match');
        document.signup.repeatpassword.focus();
        return false;
    }
    return true;
} 