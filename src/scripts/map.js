const map = document.getElementById('map');
const icons = map.querySelectorAll('.survey-result__parameter');

const InitMap = () => {
  _.forEach(icons, (icon) => {
    new CircleType(icon.querySelector('span')).radius(60);
  });
};

const SetArchetypes = () => {
  _.forEach(surveyResult.parameters, (value, key) => {
    const active = _.find(icons, ['dataset.parameter', key]);

    const percentage = active.querySelector('.survey-result__percentage');
    percentage.innerHTML = `${value}%`;

    if (value <= 60) active.classList.add('survey-result__parameter--low')
    else if (value <= 80) active.classList.add('survey-result__parameter--medium')
    else if (value > 80) active.classList.add('survey-result__parameter--high')
  });
}
