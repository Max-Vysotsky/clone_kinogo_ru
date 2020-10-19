let $checklogin;
let $result;
let $signUpform;
let $logininput;
let $errors;
window.addEventListener('DOMContentLoaded', () => {
  $checklogin = document.querySelector('.checklogin');
  $signUpform = document.getElementById('sign-up');
  $logininput = document.querySelector('#login-input');
  $errors = document.querySelector('#errors');
  $result = document.querySelector('#result');
  $checklogin.addEventListener('click', checklogin);
  $signUpform.addEventListener('submit', checkSignup);
});

function checklogin($el) {
  $el.preventDefault();
  sendlogin();
}

function sendlogin() {
  let $data = $logininput.value;

  if ($data.length == 0) {
    $result.innerText = 'Ведите логин';
    $result.style.color = 'red';
  } else {
    axios.get('ajax/checklogin.php?login=' + $data).then(function (response) {
      let $resdata = parseInt(response.data);

      if ($resdata === 1) {
        $result.innerText = 'Вы можете использовать данное имя для регистрации';
        $result.style.color = 'green';
        return 1;
      }

      if ($resdata === 2) {
        $result.innerText = 'Данное имя уже зарегистрировано';
        $result.style.color = 'red';
        return 2;
      }

      if ($resdata === 3) {
        $result.innerText = 'введите логин';
        $result.style.color = 'red';
        return 3;
      }
    }).catch(function (error) {
      // handle error
      console.log(error);
    }).then(function () {// always executed
    });
  }
}

function checkSignup(event) {
  event.preventDefault();
  $iserror = false;
  let $message;
  let $email = document.querySelector('#check-email').value;
  let $loginname = document.querySelector('#login-input').value;
  let $nickname = document.querySelector('#nickname').value;
  let $pass = document.querySelector('#password').value;
  let $repeat_pass = document.querySelector('#password_repeat').value;

  if ($pass != $repeat_pass) {
    $message = 'Оба введенных пароля должны быть идентичны!';
    $iserror = true;
  }

  if (!$pass) {
    $message = 'Введите пароль';
    $iserror = true;
  }

  if ($pass.length <= 6) {
    $message = 'пароль должен содеражать не меньше 6 симовлов';
    $iserror = true;
  }

  if (!$nickname) {
    $message = 'введите свой ник';
    $iserror = true;
  }

  if ($nickname.length > 13) {
    $message = 'ник больше чем 13 символов';
    $iserror = true;
  }

  if (!$loginname) {
    $message = 'not loginname';
    $iserror = true;
  }

  if ($loginname.length > 255) {
    $message = 'логин больше чем 255 символов';
    $iserror = true;
  }

  if ($loginname) {
    if (sendlogin() == 2) {
      $iserror = true;
      $message = 'Данное имя уже зарегистрировано';
    }
  }

  if (!$email) {
    $message = 'not email';
    $errors.style.color = 'red';
    $iserror = true;
  }

  if ($iserror) {
    $errors.innerText = $message;
  } else {
    $errors.innerText = 'all OK';
    $errors.style.color = 'green';
    console.log('ok');
    event.target.submit();
  }
}