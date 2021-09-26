const survey = document.getElementById('survey');
const surveyResult = {
  'completed': 0,
  'parameters': {},
}

const percentage = (partialValue, totalValue) => (100 * partialValue) / totalValue;

if (survey) {
  const progressBar = survey.querySelector('.survey-progress');
  const progressTitle = progressBar.querySelector('.survey-progress__count');
  const progressFill = progressBar.querySelector('.survey-progress__fill')

  const groups = survey.querySelectorAll('.survey__group');
  const items = _.invokeMap(groups, 'querySelectorAll', '.survey-item');

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