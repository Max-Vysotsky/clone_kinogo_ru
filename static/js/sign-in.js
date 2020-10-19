window.addEventListener('DOMContentLoaded', () => {
  document.getElementById('login-form').addEventListener('submit', logIn);
});

async function logIn(e) {
  e.preventDefault();
  let $loginName = document.getElementById('login_name').value;
  let $loginPass = document.getElementById('login_password').value;
  let $issubmit = document.getElementById('login').value;
  axios.get('/sign-in.php?loginName=' + $loginName + '&loginPass=' + $loginPass + '&issubmit=' + $issubmit).then(function (response) {
    // handle success
    if (response.data == 2) {
      location.reload();
    }

    if (response.data == 1) {
      document.querySelectorAll('.login-input')[0].style.backgroundColor = 'red';
      document.querySelectorAll('.login-input')[1].style.backgroundColor = 'red';
    }
  }).catch(function (error) {
    // handle error
    console.log(error);
  }).then(function () {// always executed
  });
}