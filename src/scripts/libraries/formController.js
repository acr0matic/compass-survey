'use strict';

class Form {
  constructor(form) {
    this.form = form;

    this.phone = form.querySelector('input[type=tel]');
    this.date = form.querySelector('input[name=user_date]');
    this.action = form.getAttribute('action');
    this.redirect = form.getAttribute('data-redirect');

    this.submit = form.querySelector('button[type=submit]');
    this.fields = form.querySelectorAll('.input__field');
    this.required = form.querySelectorAll('[data-required]');

    this.error = form.querySelector(".form__error");
    this.screenshot;

    this.buttonDefault = this.submit.innerHTML;

    this.ValidateExpression = {
      phone: /^(\s*)?(\+)?([- _():=+]?\d[- _():=+]?){11}(\s*)?$/,
      name: /^[a-zA-Zа-яА-ЯёЁ]+$/,
      message: /.{6,}/,
      date: /[0-9]{2}\.[0-9]{2}\.[0-9]{4}/,
      age: /(^[0-9]{0,3}$)/,
      email: /(?:[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*|"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])/,
    }

    this.Mask();
    this.Listener();
  }

  Mask() {
    // Маска для номера телефона
    if (this.phone) IMask(this.phone, {
      mask: '+{7} 000 000-00-00',
      prepare: (appended, masked) => ((appended === '8' && masked.value === '') ? '' : appended),
    });

    if (this.date) {
      IMask(this.date, {
        mask: Date,
        min: new Date(1990, 0, 1),
        max: new Date(),
      });
    }
  }

  Listener() {
    // Удалить стандартное поведение формы
    this.form.addEventListener('submit', (e) => {
      e.preventDefault();

      if (this.CheckAnswer() & this.CheckRequired() & this.InputValidate()) {
        this.submit.innerHTML = this.submit.getAttribute('data-sending');
        this.submit.setAttribute('disabled', 'disabled');
        this.form.classList.add('form--sending');

        const targetDiv = document.querySelector('.survey-result__wrapper');

        InitMap();
        SetArchetypes();

        setTimeout(() => {
          html2canvas(targetDiv, {
            width: targetDiv.scrollWidth,
            height: targetDiv.scrollHeight,

            onclone: function (clonedDoc) {
              clonedDoc.querySelector('body').style.overflowX = 'visible';

              clonedDoc.getElementById('map').style.opacity = '1';
              clonedDoc.getElementById('map').style.visibility = 'visible';
              clonedDoc.getElementById('map').style.maxHeight = 'initial';
              clonedDoc.getElementById('map').style.overflow = 'visible';

              clonedDoc.querySelector('.survey-result__wrapper').style.overflow = 'visible'
            }
          }).then(canvas => canvas.toBlob(blob => {
            const data = new FormData(this.form);

            data.append('screenshot', blob, "screenshot.png");
            data.append('result', JSON.stringify(surveyResult));

            saveButton.download = "Результат";
            saveButton.href = URL.createObjectURL(blob);

            this.Send(data);
          }));
        }, 500);
      }
    });

    // Убрать ошибку при клике
    this.fields.forEach(input => {
      input.addEventListener('click', this.RemoveError(input));
    });
  }

  CheckAnswer() {
    const missed = _.filter(survey.querySelectorAll('.survey__group'), group => group.dataset.value === undefined);
    _.forEach(missed, (item) => item.classList.add('survey__group--missed'))

    const result = document.querySelector('.survey__group--missed') === null;
    if (!result) {
      this.error.classList.add('form__error--visible');
      setTimeout(() => {
        this.error.classList.remove('form__error--visible');
      }, 3000);
    }
    return result;
  };

  CheckRequired() {
    let isValid = true;

    this.required.forEach(field => {
      if (field.value === '') {
        field.parentNode.classList.add('input--error');
        isValid = false;
      }
    });

    return isValid;
  }

  InputValidate() {
    let isValid = true;

    const input_phone = this.form.querySelectorAll('input[type=tel]');
    const input_name = this.form.querySelectorAll('input[name=user_name], input[name=user_child]')
    const input_age = this.form.querySelectorAll('input[name=user_age]');
    const input_email = this.form.querySelectorAll('input[name=user_email]');
    const input_message = this.form.querySelectorAll('input[name=user_message]')

    const Validate = (field, type) => {
      if (!field.value.match(this.ValidateExpression[type])) {
        this.AddError(field);
        isValid = false;
      }
    }

    input_phone.forEach(input => Validate(input, 'phone'));
    input_name.forEach(input => {
      if (input.hasAttribute('data-required')) Validate(input, 'name')
      else if (input.value !== '') Validate(input, 'name')
    });

    input_age.forEach(input => {
      if (input.value !== '') Validate(input, 'age')
    });

    input_email.forEach(input => {
      if (input.value !== '') Validate(input, 'email')
    });

    input_message.forEach(input => {
      if (input.value !== '') Validate(input, 'message')
    });

    return isValid;
  }

  // Функция: убрать ошибку при клике
  RemoveError(field) {
    return () => field.parentNode.classList.remove('input--error');
  }

  // Функция: Добавить ошибку
  AddError(field) {
    field.parentNode.classList.add('input--error');
  }

  // Функция: Отправляем письмо
  async Send(data) {
    // for (var pair of data.entries()) {
    //   console.log(pair[0] + ', ' + pair[1]);
    // }

    try {
      SetArchetypes();
      let response = await fetch(this.action, {
        method: 'POST',
        body: data,
      });

      if (response.ok) {
        if (this.redirect) window.location.href = this.redirect;
        this.ChangeContent();
      }

      let result = await response.json();
      console.log(result);

      this.Clear();
    }

    // Логируем ошибку, если возникла
    catch (error) {
      console.error('Ошибка: ' + error);
    }

    // В любом случае убрать стили "отправки"
    finally {
      this.submit.removeAttribute('disabled');
      this.submit.parentNode.classList.remove('form__action--sending');
      this.submit.innerHTML = this.buttonDefault;
    }
  }

  // Функция: Очистка формы
  Clear() {
    this.fields.forEach(field => field.value = '');
  }

  ChangeContent() {
    header.classList.add('justify-content-center');
    header.innerHTML = '<h1 class="survey__title">Результаты</h1>'
    slider.style.display = 'none';
    document.querySelector('.swiper__control').style.display = 'none';
    form.style.display = 'none';

    map.classList.add('survey-result--visible');
  }
}