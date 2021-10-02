const survey = document.getElementById('survey');
let surveyForm = null;
const surveyResult = {
  'completed': 0,
  'parameters': {},
}

const percentage = (partialValue, totalValue) => (100 * partialValue) / totalValue;

const surveySlider = new Swiper('.survey-slider', {
  slidesPerView: 1,
  spaceBetween: 60,
  effect: 'fade',
  fadeEffect: {
    crossFade: true,
  },

  autoHeight: true,
  allowTouchMove: false,

  navigation: {
    nextEl: '.survey-slider__next',
    prevEl: '.survey-slider__prev',
  },

  on: {
    slideChangeTransitionStart: () => {
      window.scrollTo({
        top: 0,
        behavior: 'smooth',
      });

      if (surveySlider.isEnd) surveyForm.classList.add('form-survey--visible')
      else surveyForm.classList.remove('form-survey--visible')
    },
  }
});

if (survey) {
  surveyForm = survey.querySelector('.form-survey');

  const progressBar = survey.querySelector('.survey-progress');
  const progressTitle = progressBar.querySelector('.survey-progress__count');
  const progressFill = progressBar.querySelector('.survey-progress__fill')

  const groups = survey.querySelectorAll('.survey__group');
  const items = _.invokeMap(groups, 'querySelectorAll', '.survey-item');

  if (window.matchMedia("(max-width: 768px)").matches) {
    console.log('test');
    _.forEach(items, (item) => {
      _.forEach(item, (button, index) => {
        const text = button.querySelector('span');
        if (index === 0) text.innerHTML = "Точно <br> Нет";
        if (index === 1) text.innerHTML = "Нет";
        if (index === 3) text.innerHTML = "Да";
        if (index === 4) text.innerHTML = "Точно <br> Да";
      });
    });
  }

  // Проходимся по группам кнопок
  _.forEach(items, (item, groupIndex) => {
    const currentGroup = groups[groupIndex];
    const currentParameter = currentGroup.dataset.parameter;
    let isSelected = false;

    // Проходимся по элементам каждой группы кнопок
    _.forEach(item, (button, buttonIndex) => {
      button.addEventListener('click', (event) => {
        button.classList.add('survey-item--selected');
        if (!isSelected) {
          surveyResult.completed++;
          UpdateProgress();

          isSelected = true;
          button.closest('.survey__group').classList.remove('survey__group--missed')
        }

        SetParameter(currentGroup, buttonIndex);
        UpdateParameter(groups, currentParameter);

        // Убираем класс "выбран" у других кнопок
        _.forEach(item, (other) => {
          if (other !== event.currentTarget)
            other.classList.remove('survey-item--selected');
        });
      })
    });
  });

  // Обновление шкалы отвеченных вопросов
  const UpdateProgress = () => {
    if (surveyResult.completed + 1 <= groups.length)
      progressTitle.innerHTML = `${surveyResult.completed + 1}/${groups.length}`;

    progressFill.style.width = `${percentage(surveyResult.completed, groups.length)}%`;

    // TODO Сделать обновление кнопки отправки результатов
  }

  // Установка дата-атрибута для групп вопросов
  const SetParameter = (group, value) => {
    let points = (value + 1) * 3;
    group.dataset.value = points;
  };

  // Обновление значений параметров глобальном объекте
  const UpdateParameter = (groups, param) => {
    let points = 0;

    _.forEach(groups, group => {
      const value = group.dataset.value;
      if (value && group.dataset.parameter === param) points += parseInt(value);
    });

    if (!(param in surveyResult.parameters)) surveyResult.parameters[param] = 0;
    surveyResult.parameters[param] = points;
  }

  UpdateProgress();
}