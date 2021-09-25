const survey = document.getElementById('survey');
const surveyResult = {
  'completed': 0,
}

const percentage = (partialValue, totalValue) => (100 * partialValue) / totalValue;


if (survey) {
  const progressBar = survey.querySelector('.survey-progress');
  const progressTitle = progressBar.querySelector('.survey-progress__count');
  const progressFill = progressBar.querySelector('.survey-progress__fill')

  const groups = survey.querySelectorAll('.survey__group');
  const items = _.invokeMap(groups, 'querySelectorAll', '.survey-item');

  // Проходимся по группам кнопок
  _.forEach(items, (item) => {
    let isSelected = false;

    // Проходимся по элементам каждоый группы кнопок
    _.forEach(item, (button) => {
      button.addEventListener('click', (event) => {
        button.classList.add('survey-item--selected');
        if (!isSelected) {
          surveyResult.completed++;
          UpdateProgress();
        }

        isSelected = true;

        // Убираем класс "выбран" у других кнопок
        _.forEach(item, (other) => {
          if (other !== event.currentTarget) {
            other.classList.remove('survey-item--selected');
          }
        });
      })
    });
  });

  const UpdateProgress = () => {
    if (surveyResult.completed + 1 <= groups.length)
      progressTitle.innerHTML = `${surveyResult.completed + 1}/${groups.length}`;

    progressFill.style.width = `${percentage(surveyResult.completed, groups.length)}%`;
  }

  UpdateProgress();
}