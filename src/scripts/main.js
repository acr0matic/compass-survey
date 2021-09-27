const header = document.querySelector('.survey__header');
const slider = document.querySelector('.survey__slider');
const form = document.querySelector('.form-survey')

new Form(form);

tippy('.input__warning[data-tippy-content]', {
  placement: 'top',
  allowHTML: true,
  maxWidth: 250,
});
